<?php
namespace Entities;

/**
 * Classe de base pour toutes les entités offrant quelques méthodes utiles
 *
 */
class Entity {
    
    protected $_em = null;
    
    public function __construct()
    {
        $this->_em = $this->getEntityManager();
    }
    
    /**
     * Méthode intelligente pour récupérer un champ
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            return $this->$name;
        }
    }
    
    /**
     * Méthode intelligente pour valoriser un champ
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method($value);
        } else {
            $this->$name = $value;
            return $this;
        }
    }
    
    /**
     * Récupère l'em commun au projet
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return \Zend_Registry::get('em');
    }
    
    /**
     * Valorise les propriétés sur base d'un tableau associatif
     * @param array $data
     * @return Entity
     */
    public function fromArray(array $data)
    {
        foreach ($data as $key => $value) {
            $this->__set($key, $value);
        }
        return $this;
    }
    
    /**
     * Construit un tableau associatif avec les propriétés de l'entité en utilisant l'introspection de Doctrine
     * @return array
     */
    public function toArray()
    {
        $result = array();
        $metadata = $this->getEntityManager()->getClassMetadata(get_class($this));
        foreach ($metadata->fieldNames as $property) {
            $result[$property] = $this->__get($property);
        }
        return $result;
    }
    
}