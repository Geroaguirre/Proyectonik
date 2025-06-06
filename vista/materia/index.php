<?php
require_once __DIR__ . '/../../controlador/materia/MateriaController.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Escolar</title>
    <!-- Include bootstrap 4.5.2 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include bootstrap 5.1.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include jQuery 3.5.1 -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include fontawesome 5.15.1 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <!-- Include bootstrap 5.1.3 JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/vista/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/Proyectonik/vista/dashboard.php">Gestión Escolar</a>
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="/Proyectonik/vista/dashboard.php">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a class="nav-item nav-link" href="/Proyectonik/vista/alumno/index.php">
                    <i class="fas fa-user-graduate"></i> Alumnos
                </a>
                <a class="nav-item nav-link" href="/Proyectonik/vista/profesor/index.php">
                    <i class="fas fa-chalkboard-teacher"></i> Profesores
                </a>
                <a class="nav-item nav-link" href="/Proyectonik/vista/materia/index.php">
                    <i class="fas fa-book"></i> Materias
                </a>
            </div>
        </div>
    </nav>
    <main class="container mt-4">

<?php
$controller = new MateriaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear'])) {
        $controller->crear($_POST['nombre']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['actualizar'])) {
        $controller->actualizar($_POST['id'], $_POST['nombre']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['eliminar'])) {
        $controller->eliminar($_POST['id']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

$materias = $controller->leerTodas();
?>

<div class="container">
    <div class="row mt-5">
        <div class="col col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Crear Materia</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required class="form-control">
                        </div>
                        <!-- Removed descripcion field as per user request -->
                        <button type="submit" name="crear" class="btn btn-success">
                            <i class="fas fa-send"></i> Crear
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Lista de Materias</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $materias->fetch_assoc()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['nombre']) ?></td>
                            <td class="actions">
                                <form method="post" action="" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="text" name="nombre" value="<?= htmlspecialchars($row['nombre']) ?>" required class="form-control form-control-sm d-inline-block" style="width: 150px;">
                                    <button type="submit" name="actualizar" class="btn btn-primary btn-sm ms-2">
                                        <i class="fas fa-edit"></i> Actualizar
                                    </button>
                                </form>
                                <form method="post" action="" class="d-inline ms-2">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="eliminar" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta materia?');">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
</body>
</html>
