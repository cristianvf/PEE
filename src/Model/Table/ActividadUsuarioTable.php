<?php
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class ActividadUsuarioTable extends AppTable{

  public function initialize(array $config){
    parent::initialize($config);

    $this->table('actividad_usuario');
    $this->primaryKey('actividad_usu_id');

    $this->belongsTo('Usuario', [
	    'className' => 'Usuario',
	    'foreignKey' => 'usuario_id',
	  ]);

    $this->belongsTo('NivelEducativo', [
	    'className' => 'NivelEducativo',
	    'foreignKey' => 'niv_edu_id',
	  ]);

    $this->belongsTo('Actividad', [
	    'className' => 'Actividad',
	    'foreignKey' => 'actividad_id',
	  ]);
  }

  /**
   * Metodo que guarda la informacion en la tabla actividad_usuario
   *
   * @param int $actividadId identificador de la actividad
   * @param int $usuarioId identificador del usuario
   * @param int $nivelEducativoId identificador del nivel educativo
   * @author Cristian Vargas
   */
  public function guardar($actividadId,$usuarioId,$nivelEducativoId){
    $actividadUsuario = $this->newEntity();
    $actividadUsuario->usuario_id = $usuarioId;
    $actividadUsuario->actividad_id = $actividadId;
    $actividadUsuario->niv_edu_id = $nivelEducativoId;
    $guardado = $this->connection()->transactional(
        function() use($actividadUsuario){
            if(!$this->save($actividadUsuario)){
                return false;
            }
            return true;
        }
    );
    return $guardado;

  }


}
