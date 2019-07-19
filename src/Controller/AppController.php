<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Exception\InvalidCsrfTokenException;


/* Controlador que contiene funciones generales
 *
 * @author Cristian Vargas
 */

class AppController extends Controller
{

  /* Método para cargar configuración.
   *
   * @author Cristian Vargas
   */
    public function initialize()
    {
        parent::initialize();


        $this->loadComponent('RequestHandler');
        $this->loadComponent('Csrf');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Aut',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Aut', 
                'action' => 'login',
                'home'
            ]
        ]);
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
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['login']);
    }
}
