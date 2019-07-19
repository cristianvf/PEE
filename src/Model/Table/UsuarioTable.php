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
  /* Metodo que encuentra la información de usuario en la base.
     * @param $query
     * @author Efrén Pérez
     */
  public function findAuth(\Cake\ORM\Query $query, array $options){
    $query
      ->select(['usuario_id',
                'usuario_nombre',
                'usuario_ap_pat',
                'usuario_ap_mat',
                'usuario_edad',
                'usuario_correo',
                'usuario_password']);
      return $query;
  }


}
