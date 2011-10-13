<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="user")
 *
 */
class User
{
    /**
     * @var int
     * 
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * 
     * @Column(name="login", type="string", length="50", nullable=false)
     */
    private $login;
    
    /**
     * @var string
     * 
     * @Column(name="password", type="string", length="40", nullable=false)
     */
    private $password;
    
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function getLogin()
    {
        return $this->login;
    }
    
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPassword($password)
    {
        $this->password = sha1($password);
        return $this;
    }
}