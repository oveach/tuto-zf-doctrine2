<?php
class Application_Bootstrap_Resource_Doctrine extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        require 'Doctrine/ORM/Tools/Setup.php';
        \Doctrine\ORM\Tools\Setup::registerAutoloadDirectory(ROOT_PATH . "/library");
        
        $options = $this->getOptions();
        $paths = array($options['entities']['path']);
        $isDevMode = true;
        
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        
        $classLoader = new \Doctrine\Common\ClassLoader('Entities', $options['entities']['path']);
        $classLoader->register();
        //         $autoloader = Zend_Loader_Autoloader::getInstance();
        //         $autoloader->pushAutoloader(array($classLoader, 'loadClass'), 'Entities');
        
        $em = \Doctrine\ORM\EntityManager::create($options['conn'], $config);
        Zend_Registry::set('em', $em);
        return $em;
    }
}
