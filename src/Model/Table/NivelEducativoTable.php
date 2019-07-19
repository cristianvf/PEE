<?php
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class NivelEducativoTable extends AppTable{

  public function initialize(array $config){
    parent::initialize($config);

    $this->table('nivel_educativo');
    $this->displayField('niv_edu_nombre');
    $this->primaryKey('niv_edu_id');

    $this->hasMany('ActividadUsuario', [
        'className' => 'ActividadUsuario',
        'foreignKey' => 'niv_edu_id',
    ]);
  }


  /**
   * Método que obtiene un listado de los niveles educativos llave => valor
   *
   * @author Cristian Vargas
   */
    public function getListNivelEducativo(){
        return $this->find('list',[
            'keyField' => 'niv_edu_id',
            'valueField' => function($row){
                return $row['niv_edu_nombre'];
            }
        ])->toArray();
    }
}
