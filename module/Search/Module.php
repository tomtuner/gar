<?php

namespace Search;

use Zend\ModuleManager\ModuleManager;
use Zend\EventManager\EventInterface;

class Module
{

    /**
     * Init
     * 
     * Attach Module Specific Layout
     * 
     * @param \Zend\ModuleManager\ModuleManager $moduleManager
     */
    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch',
                function($e)
                {
                    // This event will only be fired when an ActionController under the MyModule namespace is dispatched.
                    $controller = $e->getTarget();
                    $controller->layout('layout/no-header');
                }, 100);
    }
    
    /**
     * Iniitialize Autoload Configuration
     * 
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                ),
            ),
        );
    }

    /**
     * Initialize Module Configuration
     * 
     * @return mixed 
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

}

?>
