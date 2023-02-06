<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Dashboard</h1>

<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, diagnostico, id_equipo, id_usuario, problema, fecha_revision FROM solicitudes";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-9">
                        <h6>Cantidad Usuarios</h6>
                        <h6 id="totalUsuarios">0</h6>
                    </div>
                    <div class="col-sm-3">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-9">
                        <h6>Cantidad Equipos</h6>
                        <h6 id="totalEquipos">0</h6>
                    </div>
                    <div class="col-sm-3">
                        <i class="fas fa-shopping-bag fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-9">
                        <h6>Cantidad Solicitudes</h6>
                        <h6 id="totalSolicitudes">0</h6>
                    </div>
                    <div class="col-sm-3">
                        <i class="fas fa-file-contract fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-tags me-1"></i>
        Historial de Solicitudes
    </div>
    <div class="card-body">

        <form id="formDashboard">
            <div class="row align-items-end">
                <div class="col-sm-2">
                    <div class="mb-2">
                        <label class="form-label">Fecha de Inicio:</label>
                        <input class="form-control" type="text" id="txtfechaInicio" name="fechainicio" />
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="mb-2">
                        <label class="form-label">Fecha Fin:</label>
                        <input class="form-control" type="text" id="txtfechaFin" name="fechafin" />
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="d-grid mb-2">
                        <button class="btn btn-primary" id="btnBuscar" type="button"><i class="fas fa-search"></i> Buscar</button>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="d-grid mb-2">
                    <a href="pdf/generar.php" class="btn btn-danger"><i class="fas fa-file-pdf"></i>Exportar</a>
                    </div>
                </div>
            </div>
        </form>

        <hr />

        <div class="row">
            <div class="col-sm-12">
                <table id="tablaDashboard" class="display cell-border" style="width:100%">
                    <thead>
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
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>