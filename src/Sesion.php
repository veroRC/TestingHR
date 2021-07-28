<?php
include_once('Respuesta.php');
include_once('Pgsql.php');

class Sesion {
    
    private $respuesta;
    private $sql;

    public function __construct(){
        $this->respuesta = new Respuesta();
        $this->sql = new Pgsql();
    }

    /** FUNCIONES */
    public function iniciarSesion($params){
        if ($params == null) {
            $this->respuesta->generarError(null,'Debe ingresar un usuario y/o contraseña válidos');
        } else {
            $usuario = $params['usuario'];
            $clave = $params['clave'];
            $query = "SELECT id_usuario, nombre FROM usuarios WHERE usuario = '$usuario' and clave = md5('$clave');";
            $this->sql->conectar();
            $data = $this->sql->select($query);
            $this->sql->cerrarConexion();
            if (!$data || $data == null) {
                $this->respuesta->generarError(null,'El usuario o contraseña son inválidos');
            } else {
                $this->respuesta->generarOk('Inicio de sesión exitoso',$data);
            }
        }
        return $this->respuesta;
    }

}
?>