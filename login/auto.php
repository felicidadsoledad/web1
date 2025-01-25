<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración de Automóviles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
    <!-- Menú con submenús basado en JSON -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Simulador de Autos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav" id="menu-dynamic">
            <!-- Contenido generado dinámicamente -->
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div class="container mt-5">
    <h1 class="mb-4">Administración de Automóviles</h1>

    <!-- Formulario para agregar autos -->
    <form id="car-form" method="POST" action="bas.php" class="mb-4">
      <div class="mb-3">
        <label for="car-model" class="form-label">Modelo</label>
        <input type="text" class="form-control" id="car-model" name="modelo">
      </div>
      <div class="mb-3">
        <label for="car-price" class="form-label">Precio</label>
        <input type="number" class="form-control" id="car-price" name="precio" step="0.01">
      </div>
      <div class="mb-3">
        <label for="car-brand" class="form-label">Marca</label>
        <input type="text" class="form-control" id="car-brand" name="marca">
      </div>
      <input type="submit" value="Agregar Auto">
    </form>

    <?php
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "base1";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        if (isset($_GET["id"])) {
        // Consultar los datos guardados
        $sql = "SELECT * FROM auto where id='".$_GET["id"]."'";
        $result = $conn->query($sql);
        $car = $result->fetch_assoc();
      
      ?>

    <form method="POST" action="edit.php">
      <input type="hidden" name="id" value="<?php echo $car['id']; ?>">
      <label>Modelo</label>
      <input type="text" name="modelo" value="<?php echo $car['modelo']; ?>">
      <label>Precio</label>
      <input type="number" name="precio" value="<?php echo $car['precio']; ?>">
      <label>Marca</label>
      <input type="text" name="marca" value="<?php echo $car['marca']; ?>">
      <!--<button type="submit">Guardar cambios</button> -->
      <input type="submit" value="Guardar" >
    </form>
    <?php 
    }
    ?>
    <!-- Tabla para mostrar los autos guardados -->
    <h2>Lista de Automóviles</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Modelo</th>
          <th>Precio</th>
          <th>Marca</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "base1";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consultar los datos guardados
        $sql = "SELECT * FROM auto";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar cada fila de la tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['modelo']}</td>
                        <td>\${$row['precio']}</td>
                        <td>{$row['marca']}</td>
                        <td>
                          <a href='index.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                          <a href='eliminar.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de eliminar este auto?\")'>Eliminar</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>No hay autos registrados</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <div class="container">
        <p>Contactos: info@turismo.com | Tel: +591-123-456</p>
        <p>Redes Sociales: <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Instagram</a></p>
        <p>Feedback: <a href="#">Envíanos tus comentarios</a></p>
    </div>
    <p>&copy; 2025 Simulador de Compra de Autos. Todos los derechos reservados.</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const menuData = {
      "menu": [
        {
          "id": 1,
          "title": "Inicio",
          "items": [
            "Descripción del simulador de compra de autos",
            "Beneficios de comparar autos y opciones de compra",
            "Cómo funciona el simulador",
            "Preguntas frecuentes"
          ]
        },
        {
          "id": 2,
          "title": "Selección del Auto",
          "items": [
            "Tipo de vehículo (SUV, sedán, deportivo, etc.)",
            "Marca y modelo",
            "Opciones de personalización (color, accesorios)",
            "Configuración de características (motor, transmisión)"
          ]
        },
        {
          "id": 3,
          "title": "Financiamiento y Pagos",
          "items": [
            "Métodos de pago disponibles",
            "Cálculo de financiamiento",
            "Comparación de tasas de interés",
            "Opciones de pago inicial y mensualidades"
          ]
        },
        {
          "id": 4,
          "title": "Accesorios y Opciones Adicionales",
          "items": [
            "Accesorios para personalizar el auto",
            "Opciones de seguro",
            "Garantía extendida",
            "Evaluación de costos adicionales"
          ]
        },
        {
          "id": 5,
          "title": "Comunidad",
          "items": [
            "Foros sobre experiencias con autos",
            "Recomendaciones sobre marcas y modelos",
            "Comparación de precios entre concesionarios",
            "Encuentros de usuarios con experiencias de compra"
          ]
        },
        {
          "id": 6,
          "title": "Extras",
          "items": [
            "Artículos sobre tendencias automotrices",
            "Videos de reseñas de autos populares",
            "Guías sobre cómo elegir un auto nuevo",
            "Consejos sobre la compra de autos de segunda mano"
          ]
        },
        {
          "id": 7,
          "title": "FAQ",
          "items": [
            "¿Cómo modificar mi selección de auto?",
            "¿Puedo guardar mi simulación de compra?",
            "¿Puedo cambiar el plan de financiamiento?",
            "Contactar soporte"
          ]
        },
        {
          "id": 8,
          "title": "Contacto",
          "items": ["Formulario de contacto"]
        }
      ]
    };

    const menuContainer = document.getElementById('menu-dynamic');

    menuData.menu.forEach((menuItem) => {
      const li = document.createElement('li');
      li.className = 'nav-item dropdown';
      const a = document.createElement('a');
      a.className = 'nav-link dropdown-toggle';
      a.href = `#${menuItem.title.toLowerCase().replace(/ /g, '-')}`;
      a.id = `dropdown-${menuItem.id}`;
      a.setAttribute('role', 'button');
      a.setAttribute('data-bs-toggle', 'dropdown');
      a.setAttribute('aria-expanded', 'false');
      a.textContent = menuItem.title;

      const dropdownMenu = document.createElement('ul');
      dropdownMenu.className = 'dropdown-menu';
      menuItem.items.forEach((subItem) => {
        const subLi = document.createElement('li');
        const subA = document.createElement('a');
        subA.className = 'dropdown-item';
        subA.href = `#${subItem.toLowerCase().replace(/ /g, '-')}`;
        subA.textContent = subItem;
        subLi.appendChild(subA);
        dropdownMenu.appendChild(subLi);
      });

      li.appendChild(a);
      li.appendChild(dropdownMenu);
      menuContainer.appendChild(li);
    });

    const carForm = document.getElementById('car-form');
    const carList = document.getElementById('car-list');
    let cars = [];

    carForm.addEventListener('submit', (event) => {
      event.preventDefault();

      const model = document.getElementById('car-model').value;
      const price = document.getElementById('car-price').value;
      const brand = document.getElementById('car-brand').value;

      const car = { model, price, brand };
      cars.push(car);
      updateCarList();

      carForm.reset();
    });

    function updateCarList() {
      carList.innerHTML = '';
      cars.forEach((car, index) => {
        const tr = document.createElement('tr');

        const tdModel = document.createElement('td');
        tdModel.textContent = car.model;
        tr.appendChild(tdModel);

        const tdPrice = document.createElement('td');
        tdPrice.textContent = `$${car.price}`;
        tr.appendChild(tdPrice);

        const tdBrand = document.createElement('td');
        tdBrand.textContent = car.brand;
        tr.appendChild(tdBrand);

        const tdActions = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-danger btn-sm';
        deleteButton.textContent = 'Eliminar';
        deleteButton.addEventListener('click', () => {
          cars.splice(index, 1);
          updateCarList();
        });
        tdActions.appendChild(deleteButton);
        tr.appendChild(tdActions);

        carList.appendChild(tr);
      });
    }
  </script>
</body>
</html>
