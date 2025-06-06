<?php
require_once '../../modelo/conexion.php';
require_once '../../modelo/materia.php';

class MateriaController {
    private $db;
    private $materia;

    public function __construct() {
        $conexion = new conexion();
        $this->db = $conexion->conectar();
        $this->materia = new Materia($this->db);
    }

    public function crear($nombre) {
        $this->materia->nombre = $nombre;
        return $this->materia->crear();
    }

    public function leerTodas() {
        return $this->materia->leerTodas();
    }

    public function actualizar($id, $nombre) {
        $this->materia->id = $id;
        $this->materia->nombre = $nombre;
        return $this->materia->actualizar();
    }

    public function eliminar($id) {
        $this->materia->id = $id;
        return $this->materia->eliminar();
    }
}
?>
