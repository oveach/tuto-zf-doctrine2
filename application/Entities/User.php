<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="user")
 * @HasLifecycleCallbacks
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
    
    /**
     * @var DateTime
     * 
     * @Column(name="dateCreated", type="datetime", nullable=false)
     */
    protected $dateCreated;
    
    
    /**
     * @var DateTime
     * 
     * @Column(name="dateModified", type="datetime", nullable=false)
     */
    protected $dateModified;
    
    
    /**
     * Hash le mot de passe en SHA-1 automatiquement
     * @param string $password
     * @return \Entities\User
     */
    public function setPassword($password)
    {
        $this->password = sha1($password);
        return $this;
    }
    
    /**
     * Initialise le timestamp de création automatiquement
     * @param \DateTime $datetime Datetime de création, par défaut null donc datetime du moment
     * @return \Entities\User
     */
    public function setDateCreated(\DateTime $datetime = null)
    {
        if (is_null($datetime)) {
            $datetime = new \DateTime();
        }
        $this->dateCreated = $datetime;
        return $this;
    }
    
    /**
     * Initialise le timestamp de modification automatiquement
     * @param \DateTime $datetime Datetime de modification, par défaut null donc datetime du moment
     * @return \Entities\User
     */
    public function setDateModified(\DateTime $datetime = null)
    {
        if (is_null($datetime)) {
            $datetime = new \DateTime();
        }
        $this->dateModified = $datetime;
        return $this;
    }
    
    /**
     * @PrePersist
     * @return \Entities\User
     */
    public function preInsert()
    {
        $this->setDateCreated();
        return $this;
    }
    
    /**
     * @PreUpdate @PrePersist
     * @return \Entities\User
     */
    public function preUpdate()
    {
        $this->setDateModified();
        return $this;
    }
}