<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="main.css" />
    <link rel="stylesheet" href="estab.css" />
    <!-- Boxicons CSS -->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-4">
                    <div class="card-body">
                        <h2>Alumnos</h2>
                        <hr>
                        <table class="table">
                            <thead>
                                <th>Nombre(s)</th>
                                <th>Apellido(s)</th>
                                <th>Fecha</th>
                                <th>Estatus</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>Carrera</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $imprimirA ->nombre; ?></td>
                                    <td><?php echo $imprimirA ->apellidos; ?></td>
                                    <td><?php echo $imprimirA ->fecha_nac; ?></td>
                                    <td><?php echo $imprimirA ->estatus; ?></td>
                                    <td><?php echo $imprimirA ->email; ?></td>
                                    <td><?php echo $imprimirA ->telefono; ?></td>
                                    <td><?php echo $imprimirA ->direccion; ?></td>
                                    <td><?php echo $imprimirA ->carrera; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button id="volver-btn"> Volver</button>
        <script>
          document.getElementById("volver-btn").onclick = function () {
            location.href = "main.php";
            exit();
          };
        </script>
</body>
</html>