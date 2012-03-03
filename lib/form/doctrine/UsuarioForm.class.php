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
        $this->widgetSchema['contrasena'] = new sfWidgetFormInputPassword();
        $this->widgetSchema['emailPadrino'] = new sfWidgetFormInput();

        //validaciones

        $this->validatorSchema['email'] = new sfValidatorEmail(array(),
                        array('required' => $this->mensajesError['obligatorio'],
                            'invalid' => $this->mensajesError['emailInvalido']));

        $this->validatorSchema['emailPadrino'] = new sfValidatorEmail(array('required' => false),
                        array('invalid' => $this->mensajesError['emailInvalido']));

        $this->validatorSchema['contrasena'] = new sfValidatorString(array('min_length' => 3),
                        array('required' => $this->mensajesError['obligatorio'],
                            'min_length' => 'Contrasena muy corta (min 4 caracteres)'));


        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Usuario', 'column' => array('email')), 
                        array('invalid' => 'Email ya registrado')));
    }

}
