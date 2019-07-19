<?php

namespace App\Controller;
use App\Controller\AppController;

class UsuarioController extends AppController {
  /**
   * Metodo de inicializacion
   *
   * Metodo para cargar componentes  o modelos.
   *
   * @return void
   */
    public function initialize() {
        parent::initialize();

        $this->loadModel('Usuario');
    }
}