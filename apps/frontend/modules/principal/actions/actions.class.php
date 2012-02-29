<?php

/**
 * principal actions.
 *
 * @package    tiendaonline
 * @subpackage principal
 * @author     2GE Developers
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class principalActions extends sfActions {

    /**
     * Vista inicial de la pagina web
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->form = new UsuarioForm();

        if ($request->isMethod('post')) {
            $this->procesarRegistro($request, $this->form);
        }
    }

    public function procesarRegistro(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter('usuario'));

        if ($form->isValid()) {

            //TODO encriptar la contrasena
            //TODO crear variables de sesion
            //TODO cambiar el save del usuario al final
            $usuario = $form->save();
            $postForm = $request->getParameter('usuario');
            
            if (isset($postForm['emailPadrino'])) {
                //validar que el padrino este registrado

                $padrino = Doctrine_Core::getTable('Usuario')->findOneBy('email', $postForm['emailPadrino']);

                if (count($padrino) > 0) {
                  
                    //verificar si existe la dupla padrino - apadrinado
                    $apadrinados = $padrino->getApadrinado();

                    //si es padrino de alguien
                    if (count($apadrinados) > 0) {
                        $encontrado = false;
                        foreach ($apadrinados as $apadrinado) {
                            //si es padrino del usuario que se esta registrando
                            if ($apadrinado->getEmailApadrinado() == $usuario->getEmail()) {
                                $encontrado = true;
                                break;
                            }
                        }
                        //si existe la dupla padrino-apadrinado actualizarla como efectiva
                        if ($encontrado) {
                            $apadrinado->setEstado(1);
                            $apadrinado->save();
                        } else {
                            //agregar al usuario recien registrado como apadrinado del usuario que lo recomendo
                            $apadrinado = new Apadrinado();
                            $apadrinado->setUsuarioId($padrino->getId());
                            $apadrinado->setEmailApadrinado($usuario->getEmail());
                            $apadrinado->setEstado(1);
                            $apadrinado->save();
                        }
                    } else {

                        //agregar al usuario recien registrado como apadrinado del usuario que lo recomendo
                        $apadrinado = new Apadrinado();
                        $apadrinado->setUsuarioId($padrino->getId());
                        $apadrinado->setEmailApadrinado($usuario->getEmail());
                        $apadrinado->setEstado(1);
                        $apadrinado->save();
                    }
                } else {

                    //TODO error padrino no registrado
                }
            }
        } else {
            //TODO majerar errores del form de registro
        }
    }

}
