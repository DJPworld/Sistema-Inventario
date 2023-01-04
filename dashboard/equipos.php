<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Equipos</h1>  
    
 <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, nombre, marca, modelo, num_inventario, servicetag, tipo, estado FROM equipos";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoE" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaEquipos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>marca</th>                                
                                <th>modelo</th>  
                                <th>No. Inventario</th>
                                <th>Service Tag</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['marca'] ?></td>
                                <td><?php echo $dat['modelo'] ?></td>
                                <td><?php echo $dat['num_inventario'] ?></td>
                                <td><?php echo $dat['servicetag'] ?></td>
                                <td><?php echo $dat['tipo'] ?></td>    
                                <td><?php echo $dat['estado'] ?></td>
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
<div class="modal fade" id="modalEquipos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formEquipos">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="marca" class="col-form-label">Marca:</label>
                <input type="text" class="form-control" id="marca">
                </div>                
                <div class="form-group">
                <label for="modelo" class="col-form-label">Modelo:</label>
                <input type="text" class="form-control" id="modelo">
                </div>
                <div class="form-group">
                <label for="num_inventario" class="col-form-label">No. Inventario:</label>
                <input type="text" class="form-control" id="num_inventario">
                </div>  
                <div class="form-group">
                <label for="servicetag" class="col-form-label">Service Tag:</label>
                <input type="text" class="form-control" id="servicetag">
                </div>
                <div class="form-group">
                <label for="tipo" class="col-form-label">Tipo:</label>
                <input type="text" class="form-control" id="tipo">
                </div>
                <div class="form-group">
                <label for="estado" class="col-form-label">Estado:</label>
                <input type="number" class="form-control" id="estado">
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