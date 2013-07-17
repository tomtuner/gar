<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'IndexController' => 'Applicant\Controller\IndexController',
            'ApplicationController' => 'Applicant\Controller\ApplicationController',
            'UserController' => 'Applicant\Controller\UserController',
            'AuthenticationController' => 'Applicant\Controller\AuthenticationController',
        ),
        'factories' => array(
        ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'SessionValidator' => 'Applicant\Controller\Plugin\SessionValidator',
        )
    ),
    /**
     * @todo Make Routes More Generic
     */
    'router' => array(
        'routes' => array(
            'Applicant-root' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/gar/',
                    'defaults' => array(
                        'controller' => 'IndexController',
                        'action' => 'index',
                    ),
                ),
            ),
            'Applicant-no-trailing-slash' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/gar',
                    'defaults' => array(
                        'controller' => 'IndexController',
                        'action' => 'index',
                    ),
                ),
            ),
            'Applicant-index' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/gar/index[/:action]',
                    'defaults' => array(
                        'controller' => 'IndexController',
                        'action' => 'index',
                    ),
                ),
            ),
            'Applicant-application' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/gar/application[/:action]',
                    'defaults' => array(
                        'controller' => 'ApplicationController',
                        'action' => 'index',
                    ),
                ),
            ),
            'Applicant-user' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/gar/user[/:action]',
                    'defaults' => array(
                        'controller' => 'UserController',
                    ),
                ),
            ),
            'Applicant-authentication' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/gar/authentication[/:action]',
                    'defaults' => array(
                        'controller' => 'AuthenticationController',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'applicant\applicant' => __DIR__ . '/../view', //must have a unique key (usually modulename/modulename)
        ),
        'template_map' => array(
            'layout/applicant' => __DIR__ . '/../view/layout/applicant.phtml', //layout initializer refers to this key
            'layout/no-header' => __DIR__ . '/../view/layout/no-header.phtml', //layout initializer refers to this key
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
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
		'baseUrl' => '/gar',
        'modules' => array(
            'applicant' => array(
                'root_path' => __DIR__ . '/../../Applicant/assets',
                'collections' => array(
                    'application_js' => array(
                        'assets' => array(
                            'js/tiny_mce/jquery.tinymce.js',
                            'js/application.js',
                        )
                    ),
                    'application_css' => array(
                        'assets' => array(
                            'css/application.css'
                        )
                    ),
                    'applicant_index_css' => array(
                        'assets' => array(
                            'css/applicant-index.css'
                        )
                    ),
                    'applicant_index_js' => array(
                        'assets' => array(
                            'js/applicant-index.js'
                        )
                    ),
                    'jquery_validation_js' => array(
                        'assets' => array(
                            'js/jquery.validate.js',
                            'js/additional-methods.js'
                        )
                    ),
                    'authentication_css' => array(
                        'assets' => array(
                            'css/authentication.css'
                        )
                    ),
                    'bootstrap_fileupload_plugin_css' => array(
                        'assets' => array(
                            'css/bootstrap-fileupload.min.css',
                        )
                    ),
                    'bootstrap_fileupload_plugin_js' => array(
                        'assets' => array(
                            'js/bootstrap-fileupload.min.js',
                        )
                    ),
                )
            ),
        ),
        'routes' => array(
            'Applicant-index' => array(
                '@base_css',
                '@base_js',
                '@jquery_validation_js',
                '@applicant_index_js',
                '@applicant_index_css',
            ),
            'Applicant-root' => array(
                '@base_css',
                '@base_js',
                '@jquery_validation_js',
                '@applicant_index_js',
                '@applicant_index_css',
            ),
            'Applicant-no-trailing-slash' => array(
                '@base_css',
                '@base_js',
                '@jquery_validation_js',
                '@applicant_index_js',
                '@applicant_index_css',
            ),
            'Applicant-application' => array(
                '@base_css',
                '@base_js',
                '@bootstrap_fileupload_plugin_js', //order matters
                '@application_js',
                '@application_css',
                '@bootstrap_fileupload_plugin_css',
                '@jquery_validation_js',
            ),
            'Applicant-authentication' => array(
                '@base_css',
                '@base_js',
                '@authentication_css',
            ),
            'Applicant-user' => array(
                '@base_css',
                '@base_js',
                '@authentication_css',
            ),
        ),
    ),
);
?>