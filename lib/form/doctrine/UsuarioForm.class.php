<?php

/**
 * Usuario form.
 *
 * @package    tiendaonline
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UsuarioForm extends BaseUsuarioForm {

    public function configure() {
        unset($this['updated_at'], $this['created_at']);

        //campos
        $this->widgetSchema['emailPadrino'] = new sfWidgetFormInput();
        $this->widgetSchema['contrasena'] = new sfWidgetFormInputPassword();


        //validaciones
        $this->validatorSchema['emailPadrino'] = new sfValidatorEmail(array('required' => false));
    }

}

