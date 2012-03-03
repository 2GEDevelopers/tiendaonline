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


            //TODO edward: crear variables de sesion

            $postForm = $request->getParameter('usuario');

            if ($postForm['emailPadrino']) {
                //validar que el padrino este registrado

                $padrino = Doctrine_Core::getTable('Usuario')->findOneBy('email', $postForm['emailPadrino']);

                if ($padrino) {

                    //salvar al usuario actual
                    $usuario = $form->save();
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
                            $this->getUser()->setFlash('200', 'Registro exitoso');
                            
                        } else {
                            //agregar al usuario recien registrado como apadrinado del usuario que lo recomendo
                            Apadrinado::crearUsuarioApdrinado($padrino->getId(), $usuario->getEmail());
                            $this->getUser()->setFlash('200', 'Registro exitoso');
                        }
                    } else {

                        //agregar al usuario recien registrado como apadrinado del usuario que lo recomendo
                        Apadrinado::crearUsuarioApdrinado($padrino->getId(), $usuario->getEmail());
                        $this->getUser()->setFlash('200', 'Registro exitoso');
                    }
                } else {
                    //padrino no encontrado
                    $this->getUser()->setFlash('401', 'Este email no esta registrado');
                }
            } else {
                //No coloco al usuario que lo recomendo
                //salvar al usuario actual
                $usuario = $form->save();
                $this->getUser()->setFlash('200', 'Registro exitoso');
            }
        }
    }
    

}