<?php

/**
 * Usuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    tiendaonline
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Usuario extends BaseUsuario
{
    
    /**
     * sobreescribiendo el metodo setContrasena para guardar la contrasena cifrada
     * @param type $contrasena 
     */
    public function setContrasena($contrasena) {
        //set the hashed password
        $this->_set('contrasena', md5($contrasena));
    }
}
