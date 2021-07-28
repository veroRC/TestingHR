<?php
class Respuesta {
    private $respuesta;

    public function __construct(){
        $this->respuesta = null;
    }

    /** FUNCIONES */
    public function generarError($error_code,$error_msg){
        $this->respuesta['error'] = 1;
        $this->respuesta['error_code'] = $error_code;
        $this->respuesta['error_msg'] = $error_msg;
        $this->respuesta['ok'] = 0;
        $this->respuesta['ok_msg'] = null;
        $this->respuesta['data'] = null;
    }

    public function generarOk($ok_msg,$data){
        $this->respuesta['ok'] = 1;
        $this->respuesta['ok_msg'] = $ok_msg;
        $this->respuesta['data'] = $data;
        $this->respuesta['error'] = 0;
        $this->respuesta['error_code'] = null;
        $this->respuesta['error_msg'] = null;
    }

    public function get () {
        return $this->respuesta;
    }

    public function getString() {
        return print_r($this->respuesta);
    }

    public function getJsonString() {
        return json_encode($this->respuesta);
    }

    public function isError() {
        if ($this->respuesta['error'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isOk() {
        if ($this->respuesta['ok'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
?>