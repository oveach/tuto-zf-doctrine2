<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initConfig()
    {
        $config = new Zend_Config($this->getOptions());
        Zend_Registry::set('config', $config);
    }
    
    protected function _initDoctrine()
    {
        require 'Doctrine/ORM/Tools/Setup.php';
        \Doctrine\ORM\Tools\Setup::registerAutoloadDirectory(ROOT_PATH . "/library");
        
        $options = $this->getOption('doctrine');
        $paths = array($options['entities']['path']);
        $isDevMode = true;
        
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        
        $classLoader = new \Doctrine\Common\ClassLoader('Entities', $options['entities']['path']);
        $classLoader->register();
//         $autoloader = Zend_Loader_Autoloader::getInstance();
//         $autoloader->pushAutoloader(array($classLoader, 'loadClass'), 'Entities');
        
        $em = \Doctrine\ORM\EntityManager::create($options['conf'], $config);
        Zend_Registry::set('em', $em);
    }

}
