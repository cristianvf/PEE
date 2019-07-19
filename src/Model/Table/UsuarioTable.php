<?php
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class UsuarioTable extends AppTable{

  public function initialize(array $config){
    parent::initialize($config);

    $this->table('usuario');
    $this->displayField('usuario_nombre');
    $this->primaryKey('usuario_id');

    $this->hasMany('ActividadUsuario', [
        'className' => 'ActividadUsuario',
        'foreignKey' => 'usuario_id',
    ]);
  }


}
