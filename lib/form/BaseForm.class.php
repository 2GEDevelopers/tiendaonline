<?php

/**
 * Base project form.
 * 
 * @package    tiendaonline
 * @subpackage form
 * @author     Your name here 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class BaseForm extends sfFormSymfony
{
    
    public $mensajesError = array(
            'obligatorio' => 'Campo Obligatorio',
            'emailInvalido' => 'Email Invalido'
            );
}
