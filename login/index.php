<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
        session_start();

        $users = [
            ["usuario" => "felicidad", "clave" => "admin", "cargo" => "administrador"],
            ["usuario" => "emily", "clave" => "cliente", "cargo" => "cliente"],
            ["usuario" => "roberto", "clave" => "invi", "cargo" => "invitado"]
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            foreach ($users as $user) {
                if ($user['usuario'] === $username && $user['clave'] === $password) {
                    $_SESSION['user'] = $user;
                    break;
                }
            }

            if (!isset($_SESSION['user'])) {
                $error = "Credenciales incorrectas";
            }
        }

        if (isset($_GET['logout'])) {
            session_destroy();
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    ?>

    <div id="menu">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <?php if (isset($_SESSION['user'])): ?>
                    <a class="navbar-brand" href="#">Bienvenido, <?= htmlspecialchars($_SESSION['user']['usuario']) ?></a>
                    <a class="btn btn-outline-danger" href="?logout=1">CERRAR SESION</a>
                <?php else: ?>
                    <a class="navbar-brand" href="#">APLICACION</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>

    <div class="container mt-5">
        <?php if (!isset($_SESSION['user'])): ?>
            <h2>Login</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Clave</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        <?php else: ?>
            <?php if ($_SESSION['user']['cargo'] === 'administrador'): ?>
                <h2>Formulario Administrador</h2>
                <?php		
                include('auto.php');
                
                ?>

                
            <?php else: ?>
                <h2>Informacion de Usuario</h2>
                <p>Cargo: <?= htmlspecialchars($_SESSION['user']['cargo']) ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
