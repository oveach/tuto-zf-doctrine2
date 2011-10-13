<?php

// use \Entities;

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
        // test de connexion basique
        $em = Zend_Registry::get('em');
        
//         $user = new \Entities\User;
//         $user->setLogin('toto');
//         $user->setPassword('test');
//         $em->persist($user);
//         $em->flush();
        
        $users = $em->getRepository('Entities\User')->findAll();
        Zend_Debug::dump($users);
    }

}

