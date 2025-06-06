<?php
require_once '../../modelo/conexion.php';
require_once '../../modelo/alumno.php';

class AlumnoController {
    private $db;
    private $alumno;

    public function __construct() {
        $conexion = new conexion();
        $this->db = $conexion->conectar();
        $this->alumno = new Alumno($this->db);
    }

    public function crear($nombre, $apellido, $email) {
        $this->alumno->nombre = $nombre;
        $this->alumno->apellido = $apellido;
        $this->alumno->email = $email;
        return $this->alumno->crear();
    }

    public function leerTodos() {
        return $this->alumno->leerTodos();
    }

    public function actualizar($id, $nombre, $apellido, $email) {
        $this->alumno->id = $id;
        $this->alumno->nombre = $nombre;
        $this->alumno->apellido = $apellido;
        $this->alumno->email = $email;
        return $this->alumno->actualizar();
    }

    public function eliminar($id) {
        $this->alumno->id = $id;
        return $this->alumno->eliminar();
    }
}
?>
