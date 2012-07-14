<?php
class Application_Helper_Em extends Zend_Controller_Action_Helper_Abstract
{
    public function __call($name, $args)
    {
        if (method_exists($this, $name)) {
            $class = $this;
        } else {
            $class = Zend_Registry::get('em');
        }
        return call_user_func_array(array($class, $name), $args);
    }
}
