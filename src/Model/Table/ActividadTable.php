<?php
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class ActividadTable extends AppTable{

  public function initialize(array $config){
    parent::initialize($config);

    $this->table('actividad');
    $this->displayField('actividad_nombre');
    $this->primaryKey('actividad_id');

    $this->hasMany('ActividadUsuario', [
        'className' => 'ActividadUsuario',
        'foreignKey' => 'actividad_id',
    ]);
  }

  /**
   * Metodo que obtiene la informacion de las actividades
   *
   * @param int $idNivelEducativoId  identificador del nivel educativo
   * @param int $usuarioId  identificador del usuario
   * @author Cristian Vargas
   */
  public function getListadoActividades($idNivelEducativoId, $usuarioId){
    return $this->find()
                ->select([
                  'actividad_id',
                  'actividad_nombre',
                  'actividad_nombre_archivo',
                  'url',
                  'escuela_emision',
                  'fecha'
                ])

                ->join([
                  'ActividadUsuario' => [
                    'table' => 'actividad_usuario',
                    'type' => 'LEFT',
                    'conditions' => [
                      'ActividadUsuario.actividad_id = Actividad.actividad_id'
                    ]
                  ]
                ])
                ->where([
                  'ActividadUsuario.usuario_id' => $usuarioId,
                  'ActividadUsuario.niv_edu_id' => $idNivelEducativoId['niv_edu_id'],
                  'Actividad.actividad_estado' => ESTADO_ACTIVO
                ])
                ->toArray();
  }

  /**
   * Metodo que obtiene la informacion de las actividades
   *
   * @param int $id identificador de la actividad
   * @author Cristian Vargas
   */
  public function getActividad($id){
    return $this->find()
                ->select([
                  'actividad_id',
                  'actividad_nombre',
                  'actividad_nombre_archivo',
                  'fecha',
                  'url',
                  'comentario',
                  'escuela_emision'
                ])
                ->where(['actividad_id' => $id])
                ->toArray();
  }

  /**
   * Metodo que guarda la informacion de la actividad
   *
   * @param array $datos informacion de la actividad
   * @param array $usuarioId identificador del usuario
   * @author Cristian Vargas
   */
  public function guardar($datos,$usuarioId){
    $actividad = $this->newEntity();
    $archivo = [];
    $datos['actividad_estado'] = ESTADO_ACTIVO;
    if (isset($datos['actividad_id']) && !empty($datos['actividad_id'])) {
      $actividad = $this->get($datos['actividad_id']);
    }
    if ($datos['actividad_nombre_archivo']['size'] > SIN_ARCHIVO) {
      $archivo = $datos['actividad_nombre_archivo'];
      unset($datos['actividad_nombre_archivo']);
      $datos['actividad_nombre_archivo'] = $this->limpiarNombre($archivo['name']);
    }else{
      unset($datos['actividad_nombre_archivo']);
    }
    if (isset($datos['fecha']) && !empty($datos['fecha'])) {
       $datos['fecha'] = $this->getDateFormated($datos['fecha']);
    }
    $idNivelEducativoId = $datos['niv_edu_id'];
    unset($datos['niv_edu_id']);
    $actividad = $this->patchEntity($actividad, $datos);
    $response['estatus'] = $this->connection()->transactional(
      function() use ($actividad, $usuarioId,$archivo,$idNivelEducativoId) {
          if (!$this->save($actividad)) {
              return false;
          }
          $this->ActividadUsuario->guardar($actividad->actividad_id, $usuarioId, $idNivelEducativoId);
          if ($archivo['size'] > SIN_ARCHIVO) {
            $this->__guardarArchivo($archivo,$usuarioId,$actividad->actividad_id);
          }
          return true;
      }
      );
    return $response;

  }

  /**
   * Metodo que cambia el estado de la actividad (borrado)
   *
   * @param array $datos informacion de la actividad
   * @author Cristian Vargas
   */
  public function cambiarEstadoActividad($datos){
    $actividad = $this->get($datos['actividad_id']);
    $actividad->actividad_estado = ESTADO_INACTIVO;

    $response['estatus'] = $this->connection()->transactional(
      function() use ($actividad) {
          if (!$this->save($actividad)) {
              return false;
          }
          return true;
      }
      );

    return $response;
  }

  /**
   * Metodo para guardar el archivo
   *
   * @param array $archivo informacion del archivo
   * @param array $usuario identificador del usuario
   * @param array $actividad identificador de la actividad
   * @author Cristian Vargas
   */
  private function __guardarArchivo($archivo,$usuario,$actividad){
    $path = ARCHIVOS . $usuario . DS . $actividad . DS;
    $this->saveFile($path,$archivo);
  }


}
