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
    <?php
        require_once "./test.php"; 
        $Data = new Datos();
        $datos = $Data -> mostrarDatos();
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-4">
                    <div class="card-body">
                        <h2>Alumnos</h2>
                        <hr>
                        <table style = "color: rgba(240,240,240)" class="table">
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
                                <?php
                                    foreach($datos as $item){
                                ?>
                                <tr>
                                    <td><?php echo $item ->nombre; ?></td>
                                    <td><?php echo $item ->apellidos; ?></td>
                                    <td><?php echo $item ->fecha_nac; ?></td>
                                    <td><?php echo $item ->estatus; ?></td>
                                    <td><?php echo $item ->email; ?></td>
                                    <td><?php echo $item ->telefono; ?></td>
                                    <td><?php echo $item ->direccion; ?></td>
                                    <td><?php echo $item ->carrera; ?></td>
                                </tr>
                                <?php } ?>
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