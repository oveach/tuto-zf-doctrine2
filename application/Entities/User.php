<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="user")
 *
 */
class User extends Entity
{
    /**
     * @var int
     * 
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * 
     * @Column(name="login", type="string", length=50, nullable=false)
     */
    protected $login;
    
    /**
     * @var string
     * 
     * @Column(name="password", type="string", length=40, nullable=false)
     */
    protected $password;
    
    
    public function setPassword($password)
    {
        $this->password = sha1($password);
        return $this;
    }
}