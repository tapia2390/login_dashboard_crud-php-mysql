<?php require_once "vistas/parte_superior.php"?>  
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id,documento, nombre,celular,rol FROM personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>



<!--INICIO del cont principal-->
<div class="container">
    <h1>Crear empleado</h1>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Documeto</th>
                                <th>Nombre</th>                                
                                <th>Celular</th>  
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['documento'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['celular'] ?></td>    
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
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="documento" class="col-form-label">Documeto:</label>
                <input type="number"  maxlength="20"  class="form-control" id="documento" required>
                </div>

                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" maxlength="30"  class="form-control" id="nombre" required>
                </div>

                <div class="form-group">
                <label for="celular" class="col-form-label">Celular:</label>
                <input type="text" class="form-control" id="celular" required >
                </div>
                <hr/>

                <div class="form-group">
                <label for="nombreusaurio" class="col-form-label">Nombre de usaurio:</label>
                <input type="text" maxlength="12" class="form-control" id="nombreusaurio" required >
                </div>
                
                <div class="form-group">
                <label for="password" class="col-form-label">Contraseña:</label>
                <input type="password" maxlength="15" class="form-control" id="password" required >
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