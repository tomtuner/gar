<?php
return array(
    /**
     * Load App Modules and Vendor Modules First
     */
    'modules' => array(
        'Application',
        'AppCore',
        'AppDatabase',
        'AppMail',
        'AppLDAP',
        'AppHTTP',
        'AppSecurity',
        'AppFileUpload',
        'Propel',
        'AsseticBundle',
		'Solarium',
        'Applicant',
		'Search',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(    
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
