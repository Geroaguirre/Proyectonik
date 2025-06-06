<?php
require_once '../../modelo/conexion.php';
require_once '../../modelo/profesor.php';

class ProfesorController {
    private $db;
    private $profesor;

    public function __construct() {
        $conexion = new conexion();
        $this->db = $conexion->conectar();
        $this->profesor = new Profesor($this->db);
    }

    public function crear($nombre, $apellido, $email) {
        $this->profesor->nombre = $nombre;
        $this->profesor->apellido = $apellido;
        $this->profesor->email = $email;
        return $this->profesor->crear();
    }

    public function leerTodos() {
        return $this->profesor->leerTodos();
    }

    public function actualizar($id, $nombre, $apellido, $email) {
        $this->profesor->id = $id;
        $this->profesor->nombre = $nombre;
        $this->profesor->apellido = $apellido;
        $this->profesor->email = $email;
        return $this->profesor->actualizar();
    }

    public function eliminar($id) {
        $this->profesor->id = $id;
        return $this->profesor->eliminar();
    }
}
?>
