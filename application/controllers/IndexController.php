<?php

// use \Entities;

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
        // test de connexion basique
        $em = Zend_Registry::get('em');
        
        $user = new Entities\User;
//         $user->login = 'toto';
//         $user->password = 'test';
        $user->fromArray(
            array(
                'login'    => 'toto',
                'password' => 'test',
            )
        );
        
//         Zend_Debug::dump($user);
        
//         try {
//             $em->persist($user);
//             $em->flush();
//         } catch (Exception $e) {
//             echo $e->getMessage() . "<br>" . nl2br($e->getTraceAsString());
//         }
        
        $users = $em->getRepository('Entities\User')->findAll();
        Zend_Debug::dump($users, "entités :");
        
        foreach ($users as $user) {
            Zend_Debug::dump($user->toArray(), "tableau :");
        }
    }

}

