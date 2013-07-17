<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Search\Controller\IndexController' => 'Search\Controller\IndexController',
        ),
        'factories' => array(
            'Search\Controller\ApplicantController' => 'Search\ControllerFactory\ApplicantControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'Search-root' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/gar/search/',
                    'defaults' => array(
                        'controller' => 'Search\Controller\IndexController',
                        'action' => 'index',
                    ),
                ),
            ),
            'Search-index' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/gar/search[/:action]',
                    'defaults' => array(
                        'controller' => 'Search\Controller\IndexController',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'query' => array(
                        'type' => 'Query',
                    ),
                ),
            ),
			'Search-applicant' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/gar/admin/applicant[/:action]',
                    'defaults' => array(
                        'controller' => 'Search\Controller\ApplicantController',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
         'solrUrl' => function($sm)
          {
            $h = new \Search\View\Helper\SolrUrl(new \Solr\Url\SolrUrl());
            // do stuff with $sm or the $helper
            return $h;
          },
        ),
        'invokables' => array(
            //'solrUrl' => 'Search\View\Helper\SolrUrl',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'search\search' => __DIR__ . '/../view', //must have a unique key (usually modulename/modulename)
        ),
        'template_map' => array(
            'layout/no-header' => __DIR__ . '/../view/layout/no-header.phtml', //layout initializer refers to this key
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'search/search-result-row' => __DIR__ . '/../view/search/index/search-result-row.phtml',
            'search/search-result-container' => __DIR__ . '/../view/search/index/search-result-container.phtml',
            'search/search-result-flat-facet' => __DIR__ . '/../view/search/index/search-result-flat-facet.phtml',
            'search/pagination-control.phtml' => __DIR__ . '/../view/search/index/pagination-control.phtml'
        ),
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'assetic_configuration' => array(
        'modules' => array(
            'search' => array(
                'root_path' => __DIR__ . '/../../Search/assets',
                'collections' => array(
                    'search_index_css' => array(
                        'assets' => array(
                            'css/search-index.css'
                        )
                    ),
                    'search_index_js' => array(
                        'assets' => array(
                            'js/search-index.js'
                        )
                    ),
					'search_applicant_index_css' => array(
                        'assets' => array(
                            'css/applicant-index.css'
                        )
                    ),
                    'search_applicant_index_js' => array(
                        'assets' => array(
                            'js/tiny_mce/jquery.tinymce.js',
                            'js/applicant-index.js'
                        )
                    ),
                )
            ),
        ),
        'routes' => array(
            'Search-root' => array(
                '@base_css',
                '@base_js',
                '@search_index_css',
                '@search_index_js',
            ),
            'Search-index' => array(
                '@base_css',
                '@base_js',
                '@search_index_css',
                '@search_index_js',
            ),
            'Search-index/query' => array(
                '@base_css',
                '@base_js',
                '@search_index_css',
                '@search_index_js',
            ),
            'Search-applicant' => array(
                '@base_css',
                '@base_js',
                '@search_applicant_index_css',
                '@search_applicant_index_js'
            ),
        ),
    ),
);
?>