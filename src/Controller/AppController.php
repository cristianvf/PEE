<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Exception\InvalidCsrfTokenException;
use App\Controller\Security;


/* Controlador que contiene funciones generales
 *
 * @author Cristian Vargas
 * @author Efrén Pérez
 */

class AppController extends Controller
{

  /* Método para cargar configuración.
   *Autenticación y redireccionamiento .
   *login/logout.
   * @author Cristian Vargas
   * @author Efrén Pérez
   */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'finder' => 'auth',
                    'userModel' => 'Usuario',
                    'fields' => [
                        'username' => 'usuario_correo',
                        'password' => 'usuario_password'
                    ],
                ],
            ],
            'loginAction' => [
                'controller' => 'Aut',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'Home',
                'action' => 'index',NIVEL_EDUCATIVO_SECUNDARIA
            ],
            'logoutRedirect' => [
                'controller' => 'Aut', 
                'action' => 'login',
            ],
            'authError' => FALSE,
        ]);

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Csrf');
        $this->loadComponent('Flash');
    }

    /* Metodo que se ejecuta antes de cargar el controlador.
     *
     * @author Cristian Vargas
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

    }

    /* Metodo que se ejecuta antes de cargar el controlador.
     *
     * @param array $archivo información del archivo a guardar
     * @param string $redirectUrl url a redireccionar
     * @author Cristian Vargas
     */
    public function leerArchivo($archivo,$redirectUrl){
        try{
            $pathArchivo   = $archivo['path'];
            $nombreArchivo = $archivo['name'];

            $fullPathArchivo = $archivo['path'].$archivo['name'];
            $this->response->file($fullPathArchivo ,array('download'=> true, 'name'=> $nombreArchivo));

            return $this->response;
        }
        catch (\Exception $ex) {
            $mensaje = str_replace('[ARCHIVO]', '', ERROR_ARCHIVO_NO_ENCONTRADO);
            if($archivo['name'] != null){
                $mensaje = str_replace('[ARCHIVO]',
                        '<b><i class="no-spaces">'.h($archivo['name']).'</i></b>',
                        ERROR_ARCHIVO_NO_ENCONTRADO
                );
            }
            $this->Flash->error($mensaje, ['escape' => false]);
            return $this->redirect($redirectUrl);
        }
    }
    /*Método para indicar que no necesita loggin para la vista
     * @param array $event 
     * @author Efrén Pérez
     */
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['login']);
    }
}
