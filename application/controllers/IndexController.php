<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
//         $user = new Entities\User;
//         $user->login = 'toto';
//         $user->password = 'test';
//         $user->fromArray(
//             array(
//                 'login'    => 'toto',
//                 'password' => 'test',
//             )
//         );
//         $user = $this->_helper->em->find('Entities\User', 4);
//         $user->login = 'toto2';
        
//         try {
//             $this->_helper->em->persist($user);
//             $this->_helper->em->flush();
//         } catch (Exception $e) {
//             echo $e->getMessage() . "<br>" . nl2br($e->getTraceAsString());
//         }
        
        $users = $this->_helper->em->getRepository('Entities\User')->findAll();
        Zend_Debug::dump($users, "entités :");
        
        foreach ($users as $user) {
            Zend_Debug::dump($user->toArray(), "user->toArray():");
            echo "user->dateModified: " . $user->dateModified->format("d/m/Y H:i:s");
        }
        
    }

}

