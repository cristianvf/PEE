<?php

namespace App\Controller;
use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;

class AutController extends AppController {
  /**
   * Metodo de inicializacion
   *
   * Metodo para cargar componentes  o modelos.
   *
   * @return void
   */
    public function initialize() {
        parent::initialize();
    }

/**
     * Metodo para mostrar la pagina de autenticación.
     * @author Efrén Pérez
*/
public function login()
{
    if($this->request->session()->check('Auth.User.usuario_id')){
        return $this->redirect(['controller'=> 'home','action'=>'index',NIVEL_EDUCATIVO_SECUNDARIA]);
    }
    if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl());
        }
        //$this->Flash->error(__('Correo electrónico o constraseña incorrecto'));
    }
    $this->layout = false;
}

/**
     * Metodo para cierre de sesión.
     *
     * @author Efrén Pérez
*/
public function logout()
{

    return $this->redirect($this->Auth->logout());
}

}
