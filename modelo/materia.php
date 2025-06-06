<?php

class Materia {
    private $conn;
    private $table_name = "materia";

    public $id;
    public $nombre;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear nueva materia
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (nombre) VALUES (?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->nombre);
        return $stmt->execute();
    }

    // Leer todas las materias
    public function leerTodas() {
        $query = "SELECT id, nombre FROM " . $this->table_name . " ORDER BY nombre ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    // Actualizar materia
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET nombre = ? WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $this->nombre, $this->id);
        return $stmt->execute();
    }

    // Eliminar materia
    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}

?>
