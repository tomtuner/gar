<?php

namespace Applicant;

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
    
    public function onBootstrap(EventInterface $e)
    {
        //move to module.config.php
        $c = new \Zend\Session\Config\SessionConfig();
        $c->setHashFunction('sha512');
        $c->setHashBitsPerCharacter(5);
        $c->setName('GAR'); //prevent namespace conflict
        $c->setCookieHttpOnly(true); //prevent javascript access
        $c->setUseCookies(true); //prevent passing session id in url
        $c->setSavePath(__DIR__ . '/session_tmp');
        $c->setRememberMeSeconds(3600);
        
        $sM = new \Zend\Session\SessionManager($c);
        $sM->start(); 
        
        \Zend\Session\Container::setDefaultManager($sM);
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
