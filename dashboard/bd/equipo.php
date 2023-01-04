<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$num_inventario = (isset($_POST['num_inventario'])) ? $_POST['num_inventario'] : '';
$servicetag = (isset($_POST['servicetag'])) ? $_POST['servicetag'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO equipos (nombre, marca, modelo, num_inventario, servicetag, tipo, estado) VALUES('$nombre', '$marca', '$modelo', '$num_inventario, '$servicetag', '$tipo', '$estado') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, nombre, marca, modelo, num_inventario, servicetag, tipo, estado FROM equipos ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE equipos SET nombre='$nombre', marca='$marca', modelo='$modelo', num_inventario='$num_inventario', servicetag='$servicetag', tipo='$tipo', estado='$estado' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombre, marca, modelo, num_inventario, servicetag, tipo, estado FROM equipos WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM equipos WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
