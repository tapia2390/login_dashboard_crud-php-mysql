<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   


$documento = (isset($_POST['documento'])) ? $_POST['documento'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$celular = (isset($_POST['celular'])) ? $_POST['celular'] : '';
$nombreusaurio = (isset($_POST['nombreusaurio'])) ? $_POST['nombreusaurio'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$password2 = md5($password);
// Establecer la zona horaria a Bogotá, Colombia
date_default_timezone_set('America/Bogota');

// Obtener la fecha y hora actual
$fecha_hora_actual = date('Y-m-d H:i:s');


switch($opcion){
    case 1: //alta

        $sqlusuario = "INSERT INTO usuarios (usuario, password) VALUES('$nombreusaurio','$password2') ";			
        $resulusuario = $conexion->prepare($sqlusuario);
        $resulusuario->execute(); 
        // Obtener el ID generado por la inserción en la tabla login
        $id_login = $conexion->lastInsertId();



        $consulta = "INSERT INTO personas (documento, nombre, celular,estado,rol,fecha,id_usuario) VALUES('$documento','$nombre', '$celular', 1,2,'$fecha_hora_actual',$id_login) ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, documento,nombre, celular FROM personas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE personas SET nombre='$nombre', pais='$pais', edad='$edad' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombre, pais, edad FROM personas WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM personas WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
