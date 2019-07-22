<?php

namespace App\Controller;
use App\Controller\AppController;

class HomeController extends AppController {

    public function initialize() {
      parent::initialize();
      $this->loadModel('Usuario');
      $this->loadModel('NivelEducativo');
      $this->loadModel('Actividad');
      $this->loadComponent('Paginator');

    }

    /**
     * Metodo que se ejecute antes de cargar las acciones del controlador
     * @author Cristian Vargas
     */
    public function beforeFilter(\Cake\Event\Event $event){
        parent::beforeFilter($event);
        $actions = ["listar","eliminar"];
        if (in_array($this->request->param('action'), $actions)) {
            $this->eventManager()->off($this->Csrf);
        }
    }

    /**
     * Metodo para mostrar la pagina de inicio.
     *
     * @param int $idNivelEducativo identificador del nivel educativo
     * @author Cristian Vargas
     */
    public function index($idNivelEducativo = null){
      $titulo = "";
      switch ($idNivelEducativo) {
        case NIVEL_EDUCATIVO_SECUNDARIA:
          $titulo = TITULO_SECUNDARIA;
          break;
        case NIVEL_EDUCATIVO_BACHILLERATO:
          $titulo = TITULO_BACHILLERATO;
          break;
        case NIVEL_EDUCATIVO_UNIVERSIDAD:
          $titulo = TITULO_UNIVERSIDAD;
          break;
      }
      $this->set(compact('titulo','idNivelEducativo'));
    }


    /**
     * Metodo para listar las actividades registradas
     *
     * @author Cristian Vargas
     */
    public function listar(){
      $idNivelEducativoId = $this->request->data;
      $usuarioId = $this->request->session()->read('Auth.User.usuario_id');
      $listadoActividades = $this->Actividad->getListadoActividades($idNivelEducativoId, $usuarioId);
      $countListado = count($listadoActividades);
      $this->set(compact('listadoActividades','countListado','idNivelEducativoId'));
      $this->render("listar", "ajax");
    }

    /**
     * Metodo para mostrar el formulario de registro de una actividad
     *
     * @param int $id identificador de la actividad
     * @author Cristian Vargas
     */
    public function editar($idNivelEducativoId = null, $id = null){
      $datos = [];
      $this->viewBuilder()->layout('ajax');
      $usuarioId = $this->request->session()->read('Auth.User.usuario_id');
      if(isset($id) && !empty($id)){
        $datos = $this->Actividad->getActividad($id);
        $datos = $datos[0];
      }
      $this->set(compact('datos','usuarioId','idNivelEducativoId'));
    }

    /*
    * Metodo para guardar la informacion de una actividad.
    *
    * @author Cristian Vargas
    */
    public function guardar(){
      $this->viewBuilder()->className('Json');
      $datos = $this->request->data;
      $usuarioId = $this->request->session()->read('Auth.User.usuario_id');
      $response = $this->Actividad->guardar($datos,$usuarioId);
      $this->set(compact('response'));
    }

    /**
     * Metodo para mostrar el detalle de la actividad
     *
     * @param int $id identificador de la actividad
     * @author Cristian Vargas
     */
    public function detalle($id = null){
      $this->viewBuilder()->layout('ajax');
      $usuarioId = $this->request->session()->read('Auth.User.usuario_id');
      $datos = $this->Actividad->getActividad($id);
      $this->set(compact('datos','usuarioId'));

    }

    /**
     * Metodo para descargar el archivo de la actividad
     *
     * @param int $usuarioId identificador del usuario
     * @param int $actividadId identificador de la actividad
     * @param String $nombreArchivo nombre del archivo
     * @author Cristian Vargas
     */
    public function descargarArchivo($usuarioId,$actividadId,$nombreArchivo){
      $archivo['path'] = ARCHIVOS . $usuarioId . DS . $actividadId . DS;
      $archivo['name'] = $nombreArchivo;
      $redirectUrl = array('controller' => 'Home', 'action' => 'index',1);
      return $this->leerArchivo($archivo, $redirectUrl);
    }


    /**
     * Metodo para cambiar el estado de la actividad
     *
     * @author Cristian Vargas
     */
    public function eliminar(){
      $this->viewBuilder()->className('Json');
      $actividad = $this->request->data;
      $response = $this->Actividad->cambiarEstadoActividad($actividad);
      $this->set(compact('response'));
    }


}
