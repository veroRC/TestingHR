<?php
include_once('Respuesta.php');
include_once('Pgsql.php');

class Ventas {
    
    private $respuesta;
    private $sql;

    public function __construct(){
        $this->respuesta = new Respuesta();
        $this->sql = new Pgsql();
    }

    /** FUNCIONES */
    public function registrarVenta($params){    
        if ($params == null) {
            $this->respuesta->generarError(null,'Debe ingresar los datos de la venta');
        } else {
            $nombre = $params['nombre'];
            $dni = $params['dni'];
            $celular = $params['celular'];
            $correo = $params['correo'];
            $profesion = $params['profesion'];
            $labores = $params['labores'];
            $ciudad = $params['ciudad'];
            $origen = $params['origen'];
            $producto = $params['producto'];
            $certificado = $params['certificado'];
            $asesor = $params['asesor'];
            $query = "INSERT INTO ventas (nombre,dni,celular,correo,profesion,labores,ciudad,origen,producto,certificado,asesor) 
                      VALUES ('$nombre','$dni','$celular','$correo','$profesion','$labores','$ciudad','$origen','$producto',$certificado,'$asesor');";
            $this->sql->conectar();
            $result = $this->sql->insert($query);
            $this->sql->cerrarConexion();
            if ($result) {
                $this->respuesta->generarOk('Venta ingresada correctamente',null);
            } else {
                $this->respuesta->generarError(null,'Error al registrar la venta, informar al administrador');
            }
        }
        return $this->respuesta;
    }

    /** REPORTES */
    public function reporteVentas($params){
        try {
            $desde = $params['fecha_desde'];
            $hasta = $params['fecha_hasta'];
            $query = "SELECT * FROM ventas WHERE DATE(fecha) >= DATE('$desde') and DATE(fecha) <= DATE('$hasta');";
            $this->sql->conectar();
            $data = $this->sql->select($query);
            $this->sql->cerrarConexion();
            if (!$data || $data == null) {
                $this->respuesta->generarError(null,'El usuario o contraseña son inválidos');
            } else {
                $this->respuesta->generarOk('Inicio de sesión exitoso',$data);
            }
        } catch (Exception $e) {
            $this->respuesta->generarError(null,$e->getMessage());
        }
        return $this->respuesta;
    }

}
?>