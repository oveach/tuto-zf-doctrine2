<?php
namespace Entities;

/**
 * Classe de base pour toutes les entités offrant quelques méthodes utiles
 *
 */
abstract class Entity
{
    
    /**
     * Méthode intelligente pour récupérer la valeur d'un champ
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
     * @return Entities\Entity
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
     * Construit un tableau associatif avec les propriétés de l'entité
     * @return array
     */
    public function toArray()
    {
        $properties = get_object_vars($this);
        foreach ($properties as $name => $value) {
            //  supprime les propriétés de type objet pour éviter d'avoir trop de niveaux de sérialisation
            if (is_object($this->$name)) {
                unset($properties[$name]);
            }
        }
        return array_merge($properties);
    }
    
}