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
                        <h2>Carrera</h2>
                        <hr>
                        <table class="table">
                            <thead>
                                <th>Carrera</th>
                                <th>Descripción</th>
                                <th>Departamento</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $imprimirC ->carrera; ?></td>
                                    <td><?php echo $imprimirC ->descripcion; ?></td>
                                    <td><?php echo $imprimirC ->departamento; ?></td>
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