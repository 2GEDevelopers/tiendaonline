<?php

/**
 * usuario actions.
 *
 * @package    tiendaonline
 * @subpackage usuario
 * @author     2GE Developers
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usuarioActions extends sfActions {

    /**
     * recibe peticion ajax y chequea si el email existe
     * @param sfWebRequest $request 
     */
    public function executeBuscarEmail(sfWebRequest $request) {
        
        $this->setLayout(false);
        $this->setTemplate(false);
        
        $email = $request->getPostParameter('email');
        
        if(Validacion::esEmail($email)){
            
            $encontrado = Doctrine_Core::getTable('Usuario')->findOneByEmail($email);
            
            if($encontrado){
                
                $this->redirect('@homepage');
            }else{
                
                $this->forward404('email no encotnrado');
            }
  
        }else{
            
            //TODO edward: email invalido
            $this->forward404('email invalido');
        }
        
    }

}
