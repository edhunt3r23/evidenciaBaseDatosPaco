<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="main.css">
  <link rel="stylesheet" type="text/css" href="baja.css">
</head>
<body>
<?php
    require_once "./test.php"; 
    $Data = new Carreras();    
    $carr = $Data -> selectCarreras();
?>
<?php
    require_once "./test.php"; 
    $Data = new Datos();
    $datos = $Data -> mostrarDatos();
?>
<?php
    require_once "./test.php"; 
    $Data = new Carreras();    
    $carrC = $Data -> selectCarreras();
?>

  <div class="container">
	<div class="login-card">

		<h1>Bienvenido a nuestras bases de datos</h1>
		<div class="button-container">
			<button onclick="mostrarSeccion('seccion1')">Alumnos</button>
			<button onclick="mostrarSeccion('seccion2')">Carreras</button>
		</div>
			
		<div id="seccion1" class="seccion">
			<div class="sub-button-container" id="subButtonContainer">
				<button onclick="mostrarSubSeccion('AltaA')">Alta</button>
				<button onclick="mostrarSubSeccion('InfoA')">Info</button>
				<button onclick="mostrarSubSeccion('BajaA')">Baja</button>
				<button onclick="mostrarSubSeccion('ModA')">Modificación</button>
			  </div>
			  <div id="AltaA" class="subseccion">
				<div class="container-alta">
					<div class="title">Dar de alta</div>
					<div class="content">
                    <form action="test.php" method="POST">
                        <div class="user-details">
                        <div class="input-box">
                            <span class="details">Nombre*</span>
                            <input type="text" name = "name" placeholder="Ingresa tu nombre(s)" autocomplete = "off"  required autofocus>
                        </div>
                        <div class="input-box">
                            <span class="details">Apellido*</span>
                            <input type="text" name = "apellido" placeholder="Ingresa tu Apellido(s)" autocomplete = "off" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Email*</span>
                            <input type="text" name = "email" placeholder="Ingresa tu correo institucional" autocomplete = "off" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Fecha de nacimiento*</span>
                            <input type="date" name = "fecha" placeholder="Ingresa tu fecha de nacimiento" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Teléfono*</span>
                            <input type="text" name = "telefono" placeholder="Ingresa tu teléfono" autocomplete = "off" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Carrera*</span>
                            <div class="column" style="border:none; border-style:none;" >
                            <div class="select-box">
                                <select name = "carrera" style = "margin-left: -13px; border: none; border-style: hidden;">
                                    <option hidden>Carreras</option>
                                    <?php
                                    foreach($carr as $item){
                                    ?>
                                    <option value="<?php echo $item->carrera; ?>"> <?php echo $item->carrera ?> </option>
                                    <?php } ?>    
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="input-box">
                            <span class="details">Dirección*</span>
                            <input name = "direccion" type="text" placeholder="Ingresa tu Dirección" autocomplete = "off" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Estatus*</span>
                            <div class="column">
                                <div class="select-box">
                                    <select name = "estatus" style = "margin-left: -13px;">
                                        <option hidden>Seleccione su Estatus</option>
                                        <option>Inscrito</option>
                                        <option>No Inscrito</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="button">
                        <input id = "DarAlta" name = "DarAlta" type="submit" value="Dar de alta">
                        </div>
                    </form>
				</div>
				  </div>
			  </div>
			  <div id="InfoA" class="subseccion">
                <div class="container-alta">
                    <div class="title">Consultar Alumno</div>
                    <div class="content">
                    <form action="test.php" method = "POST">
                        <div class="user-details">
                        <div class="input-box">
                            <span class="details">Nombre*</span>
                            <input name = "name" type="text" placeholder="Ingresa su nombre(s)" autocomplete= "off" autofocus required>
                        </div>
                        <div class="input-box">
                            <span class="details">Apellido*</span>
                            <input name = "apellido" type="text" placeholder="Ingresa su Apellido(s)" autocomplete= "off" >
                        </div>
                        </div>
                        <div class="button">
                        <input name = "consultaA" type="submit" value="Buscar Alumno">
                        </div>
                    </form>
                    </div>
                </div>
			  </div>
			  <div id="BajaA" class="subseccion">
                <div class="container-alta">
                    <div class="title">Dar de baja alumno</div>
                    <div class="content">
                    <form action="test.php" method = "POST" >
                        <div class="user-details">
                        <div class="input-box">
                            <span class="details">Nombre*</span>
                            <input name = "name" type="text" autocomplete= "off" placeholder="Ingresa su nombre(s)" autofocus required>
                        </div>
                        <div class="input-box">
                            <span class="details">Apellido*</span>
                            <input name = "apellido" type="text" autocomplete= "off" placeholder="Ingresa su Apellido(s)" required>
                        </div>
                        </div>
                        <div class="button">
                        <input name = "DarBaja" type="submit" value="Dar de baja">
                        </div>
                    </form>
                    </div>
                </div>
			  </div>
              <div id="ModA" class="subseccion">
                <div class="container-alta">
                    <div class="title">Modificar Alumno</div>
                    <div class="content">
                    <form action="test.php" method = "POST">
                        <div class="user-details">
                        <div class="input-box">
                            <span class="details">Nombre*</span>
                            <input name = "nombre" type="text" autocomplete= "off" placeholder="Ingresa su nombre(s)" autofocus required>
                        </div>
                        <div class="input-box">
                            <span class="details">Apellido*</span>
                            <input name = "apellidos" type="text" autocomplete= "off" placeholder="Ingresa su Apellido(s)" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Dato a Editar*</span>
                            <div class="column">
                                <div class="select-box">
                                    <select name = "dato" >
                                        <!-- pendiente -->
                                        <option hidden>Elija una opción</option>
                                        <option value ="nombre">Nombre</option>
                                        <option value = "apellidos" >Apellidos</option>
                                        <option value ="fecha_nac">Fecha</option>
                                        <option value ="estatus">Estatus</option>
                                        <option value ="email">Email</option>
                                        <option value ="telefono">Telefono</option>
                                        <option value ="direccion">Direccion</option>
                                        <option value ="carrera">Carrera</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="input-box">
                            <span class="details">Nuevo Dato*</span>
                            <input name = "nuevoDato" type="text" autocomplete= "off" placeholder="Nuevo dato a ingresar" required>
                        </div>
                        </div>
                        <div class="button">
                        <input name = "moda" type="submit" value="Modificar">
                        </div>
                    </form>
                    </div>
                </div>                    
              </div>
		</div>
		
		<div id="seccion2" class="seccion">
			<div class="sub-button-container2" id="subButtonContainer">
			<button onclick="mostrarSubSeccion('AltaC')">Alta</button>
			<button onclick="mostrarSubSeccion('InfoC')">Info</button>
			</div>
            <div id= "AltaC" class="subseccion">
                <div class="container-alta">
                    <div class="title">Agregar Carrera</div>
                    <div class="content">
                    <form action="test.php" method = "POST">
                        <div class="user-details">
                        <div class="input-box">
                            <span class="details">Nombre de la carrera*</span>
                            <input name = "nameC" type="text" autocomplete= "off" placeholder="Ingresa nombre de la carrera" autofocus required>
                        </div>
                        <div class="input-box">
                            <span class="details">Descripción*</span>
                            <input name = "desc" type="text" autocomplete= "off" placeholder="Ingresa Descripcion(s)" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Departamento*</span>
                            <input name = "departamento" type="text" autocomplete= "off" placeholder="Ingresa Departamento(s)" required>
                        </div>
                        </div>
                        <div class="button">
                        <input name = "agC" type="submit" value="Agregar Carrera">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <div id= "InfoC" class="subseccion">
                <div class="container-alta">
                    <div class="title">Consultar Carrera</div>
                    <div class="content">
                    <form action="test.php" method = "POST">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Carreras*</span>
                                <div class="column">
                                    <div class="select-box">
                                        <select name = "carrera" style = "margin-left: -13px; border: none; border-style: hidden;">
                                            <option hidden>Carreras</option>
                                            <?php
                                            foreach($carrC as $item){
                                            ?>
                                            <option value="<?php echo $item->carrera; ?>"> <?php echo $item->carrera ?> </option>
                                            <?php } ?>    
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button">
                            <input name = "BuscarC" type="submit" value="Consultar">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<button id="volver-btn"> Log out</button>
        <script>
          document.getElementById("volver-btn").onclick = function () {
            location.href = "index.html";
            exit();
          };
        </script>
  <script src="main.js"></script>
</body>
</html>