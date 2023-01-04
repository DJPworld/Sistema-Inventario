<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$diagnostico = (isset($_POST['diagnostico'])) ? $_POST['diagnostico'] : '';
$id_equipo = (isset($_POST['id_equipo'])) ? $_POST['id_equipo'] : '';
$id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';
$problema = (isset($_POST['problema'])) ? $_POST['problema'] : '';
$fecha_revision = (isset($_POST['fecha_revision'])) ? $_POST['fecha_revision'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO solicitudes (diagnostico, id_equipo, id_usuario, problema, fecha_revision) VALUES('$diagnostico, $id_equipo, $id_usuario, $problema, $fecha_revision') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, diagnostico, id_equipo, id_usuario, problema, fecha_revision FROM solicitudes ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE solicitudes SET diagnostico='$diagnostico', id_equipo='$id_equipo', id_usuario='$id_usuario', problema='$problema', fecha_revision='$fecha_revision' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, diagnostico, id_equipo, id_usuario, problema, fecha_revision FROM solicitudes WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM solicitudes WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
