<?php

namespace App\Controller;
use App\Controller\AppController;

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
     * Metodo para mostrar la pagina de inicio.
*/    
    
//--logs

public function login()
{
    if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Flash->error(__('Correo electrónico o constraseña incorrecto'));
    }
    $this->layout = false;
}

public function logout()
{
    return $this->redirect($this->Auth->logout());
}

}