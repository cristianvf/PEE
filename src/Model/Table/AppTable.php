<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\ORM\TableRegistry;


class AppTable extends Table{
    /**
     * Método para limpiar el nombre de los archivos.
     *
     * @param string $cadena Cadena original
     * @author Cristian Vargas
     */
    public function limpiarNombre($cadena) {
        $info = pathinfo($cadena);
        $nombre = str_replace(["\n", "\t", "\r"], ' ', $info['filename']);
        $nombre = $this->sustituirCaracteres($nombre);
        $nombre = preg_replace(['/[\s]+/', '/[^A-Za-z0-9\.\_\/\-\~]+/', '/[-]+/', '/[_]+/', '/[.]+/'], ['_', '', '_', '_', '.'], $nombre);
        $nombre = preg_replace(['/[-]+/', '/[_]+/'], ['_', '_'], $nombre);
        $nombre = rtrim($nombre, ".");
        $nombre = trim(strtoupper($nombre) . '.' . $info['extension']);
        return $nombre;
    }

    /**
     * Método para sustituir ciertos caracteres.
     *
     * @param string $cadena Cadena original
     * @author Cristian Vargas
     */
    public function sustituirCaracteres($cadena) {
        $reemplazar = array( '/[áàâãªä]/u' => 'a', '/[ÁÀÂÃÄ]/u' => 'A', '/[ÍÌÎÏ]/u' => 'I','/[íìîï]/u' => 'i',
            '/[éèêë]/u' => 'e','/[ÉÈÊË]/u' => 'E','/[óòôõºö]/u' => 'o','/[ÓÒÔÕÖ]/u' => 'O','/[úùûü]/u' => 'u',
            '/[ÚÙÛÜ]/u' => 'U','/ç/' => 'c', '/Ç/' => 'C', '/ñ/' => 'n', '/Ñ/' => 'N', '/–/' => '-','/[’‘‹›‚]/u' => ' ',
            '/[“”«»„]/u' => ' ', '/ /' => ' ',
        );
        return preg_replace(array_keys($reemplazar), array_values($reemplazar), $cadena);
    }

    /**
     * Método guardar los archivos cargados, si hay archivos con el mismo nombre son reemplazados
     *
     * @param string $path Ruta donde se guardará el archivo
     * @param array $archivo nombre del archivo
     * @author Cristian Vargas
     */
    public function saveFile($path = '', $archivo = []) {
        if ($archivo['error'] == UPLOAD_ERR_OK) {
            if(!file_exists($path)){
                $oldMask = umask(PERMISOS_UNMASK);
                mkdir($path, PERMISOS_FOLDER, true);
                chmod($path, PERMISOS_FOLDER);
                umask($oldMask);
            }
            $dirLoad = new Folder($path);
            $dirTemp = new Folder(TMP);
            if(isset($archivo["size"]) && !empty($archivo["size"])){
                $fileLoadPath = $dirLoad->pwd();
                $fileLoadName = $this->limpiarNombre($archivo['name']);
                $fileLoad = new File($fileLoadPath . DS . $fileLoadName);
                $fileTemp = new File($archivo['tmp_name']);

                if($fileLoad->exists()){
                    $fecha = date('dmyHi');
                    $infoArchivo = pathinfo($fileLoadName);
                    $nombreArchivo = substr($fileLoadName, INICIO_CADENA, FIN_CADENA_NEG);
                    $numeroArchivos = count(glob($path. DS. $infoArchivo['filename'] . "*"));
                    $fileLoadCopy = new File($fileLoadPath . DS . $infoArchivo['filename'] . "_" . $numeroArchivos . "_" . $fecha .  '.' . $infoArchivo['extension']);
                    $fileLoadCopy->write($fileLoad->read());
                    $fileLoadCopy->close();
                }
                $fileLoad->write($fileTemp->read());
                $fileTemp->close();
                $fileLoad->close();
            }
        }
    }

    /**
     *
     * Metodo para darle formato a la fecha.
     *
     * @param type string $fecha Fecha ingresada
     * @author Cristian Vargas
     */
    public function getDateFormated($fecha = ''){
     return date("Y-m-d", strtotime(str_replace('/', '-', $fecha)));
    }
}
