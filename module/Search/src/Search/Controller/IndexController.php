<?php

namespace Search\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use AppCore\Exception\ControllerException;

class IndexController extends AbstractActionController
{

    /**
     * Index Action
     * 
     * Graduate Assistant Recruiting Homepage
     */
    public function indexAction()
    {
		if(!isset($_SERVER['REDIRECT_uid'])) 
		{
			$this->redirect()->toUrl('https://campuslife.rit.edu/Shibboleth.sso/Login?target=' . 'https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
		}
		
        try
        {
            $c = new \Solr\SolrClient('127.0.0.1', '8080', '/solr/');
            $client = $c->getSolrClient();
            
            // get a select query instance
            $q = $client->createSelect();
          
            $q->setStart($this->params()->fromQuery('start', 0));
            $q->setRows(10);
            
            $dismax = $q->getDisMax();
            $dismax->setQueryParser('edismax');
            $dismax->setQueryFields('applicant_resume_text applicant_essay_personal_qualities applicant_essay_prior_experiences');
            $dismax->setQueryAlternative('*:*');
            //$dismax->setMinimumMatch('100');
            $dismax->setPhraseFields('applicant_resume_text applicant_essay_personal_qualities applicant_essay_prior_experiences');
            
            $hl = $q->getHighlighting();
            $hl->setFields('*'); //fix me
            $hl->setUseFastVectorHighlighter('true');
            $hl->setBoundaryScannerType('breakIterator');
            $hl->setBoundaryScannerType('SENTENCE');
            $hl->setFragSize('350'); //change me - must be less than preview cut-off
            
            //fix frag size issue tag getting cut off at             
            $hl->setMergeContiguous('true');
            $hl->setRequireFieldMatch('true');
            
            $q->setQuery($this->params()->fromQuery('q', '*:*'));

            $nSU = new \Solr\Url\SolrSearchUrl();
            $nSU->importQueryString($_SERVER['QUERY_STRING']);
            // error_log("STRING QUERY: " + $_SERVER['QUERY_STRING']);
            $q->addSorts($nSU->getSort());

            foreach($nSU->getFilterQueries() as $fqText)
            {
                    $fq = $q->createFilterQuery();
                    $fq->setKey($fqText);
                    $fq->setQuery($fqText);
                    $q->addFilterQuery($fq);
            }

            // get the facetset component
            $facetSet = $q->getFacetSet();

            // create a facet query instance and set options
            $facetSet->createFacetField('applicant_position_name')
                     ->setField('applicant_position_name')
                     ->setMinCount('1');

            // this executes the query and returns the result
      	  	// error_log("Query\n");
			// error_log(print_r($q), true);
            $resultSet = $client->select($q);
      	  	// error_log("Result Set\n");
			// error_log(print_r($resultSet), true);
            $facet =  $resultSet->getFacetSet()->getFacet('applicant_position_name');
            
            $flatFacet = new \Solr\Facet\SolrFlatFacet('applicant_position_name', $facet);
            
            $breadCrumbs = new \Solr\BreadCrumb\SolrBreadCrumb($nSU);
                                                
            $r = new \Solr\GAR\Search\SearchResultCollection($resultSet);
            
                        //construct pager with result count only
            $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\Null($r->getNumberOfDocumentsFound()));
            
            //set the maximum number of items to display per page
            $paginator->setItemCountPerPage(10);

            //set the current page number
            $paginator->setCurrentPageNumber($this->params()->fromQuery('page', 1));

            return new ViewModel(
                            array(
                                'numberOfDocumentsFound' => $r->getNumberOfDocumentsFound(),
                                'searchDocuments' => $r->getSearchResultCollection(),
                                'testFacet' => $flatFacet,
                                'q' => $this->params()->fromQuery('q'),
                                'breadCrumbs' => $breadCrumbs->getBreadCrumbs(),
                                'paginator' => $paginator,
                                'rows' => $q->getRows()
                            )
            );
        } catch(\Exception $e)
        {
            throw new ControllerException('Error Loading Search', $e);
        }
    }
	
	public function downloadFileAction()
	{
		$fileBasePath = '/home/cclweb/docs/default/gar/uploads/';
		$fileName = $this->params()->fromQuery('filename');
		
		$fileLocation = $fileBasePath . $fileName;
		
		$fileContents = file_get_contents($fileLocation);

		/**
		 * You must use the Zend response object in order to
		 * properly trigger a file download dialog. If you do not
		 * then you will have a Zend view error message appended at
		 * the end of your downloaded file corrupting your download
		 */
		$response = $this->getResponse();
		$response->setContent($fileContents);
		
		$headers = $response->getHeaders();

		$headers->clearHeaders()
			->addHeaderLine("Content-Description: File Transfer")
			->addHeaderLine("Content-Type: ". mime_content_type($fileLocation))
			->addHeaderLine('Content-Disposition', 'attachment; filename="' . $fileName . '"')
			->addHeaderLine("Content-Transfer-Encoding: binary");
		
        $response->setStatusCode(200);
		
        return $response;
	}

}

?>