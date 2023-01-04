<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Solicitudes</h1>  
    
 <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, diagnostico, id_equipo, id_usuario, problema, fecha_revision FROM solicitudes";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoS" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaSolicitudes" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>Id</th>
                                    <th>Diagnostico</th>
                                    <th>Equipo</th>                                
                                    <th>Usuario</th>
                                    <th>Problema</th> 
                                    <th>Fecha</th> 
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                            
                                foreach($data as $dat) {                                                        
                                ?>
                                <tr>
                                    <td><?php echo $dat['id'] ?></td>
                                    <td><?php echo $dat['diagnostico'] ?></td>
                                    <td><?php echo $dat['id_equipo'] ?></td>
                                    <td><?php echo $dat['id_usuario'] ?></td>   
                                    <td><?php echo $dat['problema'] ?></td>
                                    <td><?php echo $dat['fecha_revision'] ?></td>   
                                    <td></td>
                                </tr>
                                <?php
                                    }
                                ?>                                
                            </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalSolicitudes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formSolicitudes">    
            <div class="modal-body">
                <div class="form-group">
                <label for="diagnostico" class="col-form-label">Diagnostico:</label>
                <input type="text" class="form-control" id="diagnostico">
                </div>
                <div class="form-group">
                <label for="id_equipo" class="col-form-label">Equipo:</label>
                <input type="number" class="form-control" id="id_equipo">
                </div>                
                <div class="form-group">
                <label for="id_usuario" class="col-form-label">Usuario:</label>
                <input type="number" class="form-control" id="id_usuario">
                </div>      
                <div class="form-group">
                <label for="problema" class="col-form-label">Problema:</label>
                <input type="text" class="form-control" id="problema">
                </div>
                <div class="form-group">
                <label for="fecha_revision" class="col-form-label">Fecha:</label>
                <input type="date" class="form-control" id="fecha_revision">
                </div>      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>