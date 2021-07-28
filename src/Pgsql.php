<?php

class Pgsql {

    private $conexion;

    public function __construct(){

    }

    function __destruct() {
        if ($this->conexion != false && $this->conexion != null) {
            pg_close($this->conexion);
        }
    }

    public function conectar() {
        $this->conexion = pg_connect("host=localhost dbname=hrdb user=postgres password=postgres");
    }
    
    public function begin() {
        pg_query($this->conexion, "BEGIN;");
    }

    public function commit() {
        pg_query($this->conexion, "COMMIT;");
    }

    public function rollback() {
        pg_query($this->conexion, "ROLLBACK;");
    }

    public function cerrarConexion () {
        if ($this->conexion != false && $this->conexion != null) {
            pg_close($this->conexion);
        }
        $this->conexion = null;
    }

    public function insert ($query) {
        try {
            if (strpos($query, "INSERT INTO") === false) {
                return false;
            }
            $this->begin();
            $result = pg_query($this->conexion, $query);
            if (!$result) {
                throw new Exception('Error en la ejecución de la sentencia.');
            }
            $this->commit();
            return true;
        } catch (Exception $e) {
            $this->rollback();
            return false;
        }
    }

    public function delete ($query) {
        try {
            if (strpos($query, "DELETE FROM") === false) {
                return false;
            }
            $this->begin();
            $result = pg_query($this->conexion, $query);
            if (!$result) {
                throw new Exception('Error en la ejecución de la sentencia.');
            }
            $this->commit();
            return true;
        } catch (Exception $e) {
            $this->rollback();
            return false;
        }
    }

    public function select ($query) {
        try {
            if (strpos($query, "SELECT ") === false) {
                return false;
            }
            $result = pg_query($this->conexion, $query);
            if (!$result) {
                throw new Exception('Error en la ejecución de la sentencia.');
            }
            $data = pg_fetch_all($result);
            return $data;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

}
?>