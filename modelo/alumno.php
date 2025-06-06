<?php

class Alumno {
    private $conn;
    private $table_name = "alumno";

    public $id;
    public $nombre;
    public $apellido;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear nuevo alumno
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (nombre, apellido, email) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $this->nombre, $this->apellido, $this->email);
        return $stmt->execute();
    }

    // Leer todos los alumnos
    public function leerTodos() {
        $query = "SELECT id, nombre, apellido, email FROM " . $this->table_name . " ORDER BY nombre ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    // Actualizar alumno
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET nombre = ?, apellido = ?, email = ? WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $this->nombre, $this->apellido, $this->email, $this->id);
        return $stmt->execute();
    }

    // Eliminar alumno
    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}

?>
