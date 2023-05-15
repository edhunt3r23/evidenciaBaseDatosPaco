
<?php
require 'vendor/autoload.php';
$client = new MongoDB\Client('mongodb://localhost:27017/');
$collection = $client->evidencia3->alumnos;
$collection2 = $client->evidencia3->carreras;
$collection3 = $client->evidencia3->cuentas;

class Datos{
    function mostrarDatos(){
        global $collection;
        $datos = $collection -> find([], ['sort' => ['nombre' => 1]]);
        return $datos;
    }    
}

class Carreras{
    function selectCarreras(){
        global $collection2;
        $car = $collection2->find(
            ['carrera' => ['$ne' => 'admin']],
            ['projection' => ['carrera' => 1]],
            ['sort' => ['carrera' => -1]]
        );
        return $car;
    }
}

function agregarAlumnos($nombre, $apellidos, $fecha_nac, $estatus, $email, $telefono, $direccion, $carrera) {
    
    global $collection, $collection2;
    $documento = [
        "nombre" => $nombre,
        "apellidos" => $apellidos,
        "fecha_nac" => $fecha_nac,
        "estatus" => $estatus,
        "email" => $email,
        "telefono" => $telefono,
        "direccion" => $direccion,
        "carrera" => $carrera
    ];
    $nombreCarrera = $documento["carrera"];
    $carrera_existente = $collection2 -> findOne(["carrera" => $nombreCarrera]);
    $nombreAlumno = $documento["nombre"];
    $apellidoAlumno = $documento["apellidos"];
    $alumno_existente = $collection -> findOne(["nombre" => $nombreAlumno, "apellidos" => $apellidoAlumno]);
    if(($carrera_existente !== null) && (!$alumno_existente)){
        $insertar_resultado = $collection -> insertOne($documento);
        if ($insertar_resultado -> getInsertedCount() > 0) {
            return true;
        } else {
            return false;
        }
    } else{
        return false;
    }
}

function darDeBajaAlumno($nombre, $apellidos) {
    global $collection, $collection2;

    // Buscar al alumno por nombre y apellidos
    $alumno = $collection->findOne(["nombre" => $nombre, "apellidos" => $apellidos]);

    if ($alumno !== null) {
        // Eliminar al alumno
        if($alumno["_id"] !== null){
            $resultAlumno = $collection->deleteOne(["_id" => $alumno["_id"]]);
            
            if ($resultAlumno->getDeletedCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}
//Funcion para actualizar datos de alumno, busca con nombre/apellido y toma datos para actualizar usando un arreglo
function actualizarDato($nombre, $apellidos, $dato, $nuevoDato) {
    $collection = (new MongoDB\Client('mongodb://localhost:27017/'))->evidencia3->alumnos;
    $updateResult = $collection->updateOne(
        ['nombre' => $nombre, 'apellidos' => $apellidos],
        ['$set' => [$dato => $nuevoDato]]
    );

    $comprobar = $collection->findOne([$dato => $nuevoDato]);
    if($comprobar !== null){
        return true;
    } else{
        return false;
    }

}
// Funcion para consultar alumnos basado en su nombre y apellido
function consultarAlumnos($nombre, $apellidos) {
    global $collection;
    if($nombre == "ALL" && $apellidos == ""){
        include "consultas.php";
        echo "<script>alert('Desplegando Alumnos');</script>";    
        exit();
    }
    // Buscar al alumno por nombre y apellidos
    $alumno = $collection->findOne(["nombre" => $nombre, "apellidos" => $apellidos]);
    return $alumno;
    
}

function crearCuenta($email, $password){
    global $collection, $collection3;
    // Buscar si existe un alumno con el correo proporcionado
    $alumno = $collection->findOne(["email" => $email]);
    $cuenta_existente = $collection3 -> findOne(["correo" => $email]);
    if($cuenta_existente){
        return false;
    } else {
        if ($alumno !== null) {
            // Si el correo es válido, crear la cuenta
            $cuenta = [
                "correo" => $email,
                "password" => $password,
                "alumno_id" => $alumno["_id"]
            ];

            // Insertar la cuenta en la colección cuentas
            $insert_result = $collection3->insertOne($cuenta);

            if ($insert_result->getInsertedCount() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            // Si el correo no es válido, mostrar un mensaje de error
            return false;
        }
    }
}

function iniciarSesion($correo, $contrasena) {
    global $collection3;
    
    $usuario = $collection3->findOne(["correo" => $correo, "password" => $contrasena]);
    
    if ($usuario !== null) {
        return true;
    } else {
        return false;
    }
}

function agregarCarrera($carrera, $descripcion, $departamento) {
    // Crea una instancia del cliente de MongoDB
    global $collection2; // Seleccionar la colección "alumnos" de la base de datos "evidencia3"
    // Checar si la carrera ya existe 
    $carrera_existente = $collection2->findOne(['carrera' => $carrera]);
    if ($carrera_existente) {
        echo"<script>alert('La carrera ya existe')</script>";
        return false;
    }    
    // Crea un documento con los datos de la carrera
    $documento = [
      'carrera' => $carrera,
      'descripcion' => $descripcion,
      'departamento' => $departamento
    ];
  
    // Inserta el documento en la colección
    $resultado = $collection2->insertOne($documento);

    $comprobar = $collection2->findOne(["carrera" => $carrera, 'descripcion' => $descripcion, 'departamento' => $departamento]);
    if($comprobar !== null){
        return true;
    } else{
        return false;
    }
    // Imprime el object ID del documento insertado para verificar que se haya insertado algo
    /* if($resultado->getInserterCount()){
        return true;
    } else{
        return false;
    } */
}
// Funcion para buscar una carrera usando el nombre de la carrera
function buscarCarrera($nombre_carrera) {
    global $collection2;
    // Verificar que la carrera buscada exista   
    $carrera = $collection2->findOne(["carrera" => $nombre_carrera]);
    return $carrera;
}

if(isset($_POST['ingresar'])){
    $correo = $_POST['email'];
    $contrasena = $_POST['password'];
    if(iniciarSesion($correo, $contrasena)){   
        include 'main.php';
        exit();
        
    } else{
        include 'index.html';
        echo "<script>alert('Credenciales incorrectas. Por favor, intenta de nuevo.');</script>";    
        exit();
    }
} 
if(isset($_POST['DarAlta'])){
    $nombre = $_POST['name'];
    $apellidos = $_POST['apellido'];
    $fecha_nac = $_POST['fecha'];
    $estatus = $_POST['estatus'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $carrera = $_POST['carrera'];
    if(agregarAlumnos($nombre, $apellidos, $fecha_nac, $estatus, $email, $telefono, $direccion, $carrera)){
        include "main.php";
        echo "<script>alert('Alumno creado');</script>";    
        exit();
    } else{
        include "main.php";
        echo"<script>alert('Error al agregar alumno, compruebe las credenciales')</script>";
        exit();
    }
} 
if(isset($_POST['moda'])){
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dato = $_POST['dato'];
    $nuevoDato = $_POST['nuevoDato'];
    
    if(!actualizarDato($nombre, $apellidos, $dato, $nuevoDato)){
        include "main.php";
        echo "<script>alert('Hubo un error');</script>";   
        exit();
    } else{
        include "main.php";
        echo "<script>alert('Informacion actualizada exitosamente');</script>";    
        exit();
    }
} 
if(isset($_POST['DarBaja'])){
    $nombre = $_POST['name'];
    $apellidos = $_POST['apellido'];
    if(darDeBajaAlumno($nombre, $apellidos)){
        include "main.php";
        echo "<script>alert('Alumno eliminado exitosamente');</script>";    
        exit();
    } else{
        include "main.php";
        echo"<script>alert('Error al eliminar alumno, compruebe las credenciales')</script>";
        exit();
    }
}
if(isset($_POST['consultaA'])){
    $nombre = $_POST['name'];
    $apellidos = $_POST['apellido'];
    
    
    if(consultarAlumnos($nombre, $apellidos)){
        $imprimirA = consultarAlumnos($nombre, $apellidos);
        $GLOBALS['imprimirA'] = $imprimirA; 
        include "consultaAlumnoIndividual.php";
        echo "<script>alert('Alumno encontrado');</script>";    
        exit();
    } else{
        include "main.php";
        echo"<script>alert('Error al encontrar alumno, compruebe de nuevo')</script>";
        exit();
    }
} 
if(isset($_POST['crear'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if($password == $cpassword){
        if(crearCuenta($email, $password)){
            echo "<script>alert('Cuenta creada');</script>";    
            include 'index.html';
            exit();
        } else{
            include "cuenta.html";
            echo "<script>alert('Error al crear la cuenta, verifica que el correo este bien, o no tengas una cuenta ya');</script>";
            exit();
        }    
    } else{
        include "cuenta.html";
        echo "<br><br><span style= 'margin-top: 2%; color: red' class='error cPassword-error'>
        <i class='bx bx-error-circle error-icon'><p style = '' class='error-text'>Las contraseñas no coinciden</p></i>
        </span>";
        exit();
    }
} 
if(isset($_POST['agC'])){
    $nombreCarrera = $_POST['nameC'];
    $desc = $_POST['desc'];
    $departamento = $_POST['departamento'];
    if(agregarCarrera($nombreCarrera, $desc, $departamento)){
        include "main.php";
        echo "<script>alert('Carrera creada');</script>";    
        exit();
    } else{
        include "main.php";
        echo "<script>alert('Error al crear carrera');</script>";   
        exit();
    }
} 
if(isset($_POST['BuscarC'])){
    $nombreCarrera = $_POST['carrera'];
    if(buscarCarrera($nombreCarrera)){
        $imprimirC = buscarCarrera($nombreCarrera);
        $GLOBALS['imprimirC'] = $imprimirC;
        include "consultaCarrera.php";
        echo "<script>alert('Carrera encontrada');</script>";    
        exit();
    } else{
        include "main.php";
        echo"<script>alert('Error al encontrar carrera, compruebe de nuevo')</script>";
        exit();
    }
} 
?>
