<!DOCTYPE>

<html>
<head>
<title>FORMULARIO MANTENIMIENTO</title>
  </head>
     <body>
        <body background="assets/img/3.png">
                <p><h2>Registrar Mantenimiento</h2></p>


<?php
require_once 'vehiculomantenimiento.entidad.php';
require_once 'vehiculomantenimiento.model.php';

require_once 'vehiculo.entidad.php';
require_once 'vehiculo.model.php';

require_once 'empleado.entidad.php';
require_once 'empleado.model.php';

// Logica
$alm = new Vehiculomantenimiento();
$model = new VehiculomantenimientoModel();

$vehiculo = new Vehiculo();
$modelVehiculos = new VehiculoModel();

$empleado = new Empleado();
$modelEmpleados = new EmpleadoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('id',		$_REQUEST['id']);
			$alm->__SET('idplaca',    $_REQUEST['idplaca']);
            $alm->__SET('idempleado',    $_REQUEST['idempleado']);
			$alm->__SET('tipomantenimiento',    $_REQUEST['tipomantenimiento']);
			$alm->__SET('fechamantenimiento',	$_REQUEST['fechamantenimiento']);
			$alm->__SET('tallermantenimiento',	$_REQUEST['tallermantenimiento']);
				
			$model->Actualizar($alm);
			header('Location: vehiculomantenimiento.view.php');
			break;

		case 'registrar':
			$alm->__SET('id',		$_REQUEST['id']);
			$alm->__SET('idplaca',    $_REQUEST['idplaca']);
            $alm->__SET('idempleado',    $_REQUEST['idempleado']);
			$alm->__SET('tipomantenimiento',    $_REQUEST['tipomantenimiento']);
			$alm->__SET('fechamantenimiento',	$_REQUEST['fechamantenimiento']);
			$alm->__SET('tallermantenimiento',	$_REQUEST['tallermantenimiento']);	

			$model->Registrar($alm);
			header('Location: vehiculomantenimiento.view.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['id']);
			header('Location: vehiculomantenimiento.view.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['id']);
			break;
	}
}
$vehiculos = $modelVehiculos->Listar();
$empleados = $modelEmpleados->Listar();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>JEBA - Modulo Mantenimiento Vehicular</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="id" value="<?php echo $alm->__GET('id'); ?>" />
                    
                    <table style="width:500px;">
					
                        <tr>
                            <th style="text-align:left;">Placa</th>
                            <td>
                                <?php if ($alm->__GET('id')>0){?>                                                            
                                <select id="idplaca" name="idplaca" class="form-control">                                    
                                    <?php foreach($vehiculos as $a): 
                                         if ($a->id == $alm->__GET('idplaca')){?>
                                    <option value="<?php echo $a->id; ?>" selected="selected"><?php echo $a->placa; ?></option>
                                    <?php }else{ ?>                                        
                                    <option value="<?php echo $a->id; ?>"><?php echo $a->placa; ?></option>
                                    <?php } endforeach; ?>
                                </select>
                                <?php }else{ ?>
                                <select id="idplaca" name="idplaca" class="form-control">
                                    <option value="" selected>Seleccione una placa</option>
                                    <?php foreach($vehiculos as $a): ?>                                                                                
                                    <option value="<?php echo $a->id; ?>"><?php echo $a->placa; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php } ?>
                            </td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Tipo Mantenimiento</th>
                            
							<td>
                                <select name="tipomantenimiento" >
                                    <option value="PREVENTIVO" <?php echo $alm->__GET('tipomantenimiento') == 'PREVENTIVO' ? 'selected' : ''; ?>>PREVENTIVO</option>
                                    <option value="CORRECTIVO" <?php echo $alm->__GET('tipomantenimiento') == 'CORRECTIVO' ? 'selected' : ''; ?>>CORRECTIVO</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                           <th style="text-align:left;">Asigne el empleado</th>
                            <td>
                                <?php if ($alm->__GET('id')>0){?>                                                            
                                <select id="idempleado" name="idempleado" class="form-control">                                    
                                    <?php foreach($empleados as $e): 
                                         if ($e->idempleado == $alm->__GET('idempleado')){?>
                                    <option value="<?php echo $e->idempleado; ?>" selected="selected"><?php echo $e->nombre; ?></option>
                                    <?php }else{ ?>                                        
                                    <option value="<?php echo $e->idempleado; ?>"><?php echo $e->nombre; ?></option>
                                    <?php } endforeach; ?>
                                </select>
                                <?php }else{ ?>
                                <select id="idempleado" name="idempleado" class="form-control">
                                    <option value="" selected>Seleccione un Empleado</option>
                                    <?php foreach($empleados as $e): ?>                                                                                
                                    <option value="<?php echo $e->idempleado; ?>"><?php echo $e->nombre; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php } ?>
                            </td> 
                        </tr>
						<tr>
                            <th style="text-align:left;">Fecha Mantenimiento</th>
                            <td><input type="text" name="fechamantenimiento" value="<?php echo $alm->__GET('fechamantenimiento'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            
                        </tr>    
						<tr>
                             <th style="text-align:left;">Observaciones</th>
                            <td><input type="text" name="tallermantenimiento" value="<?php echo $alm->__GET('tallermantenimiento'); ?>" style="width:100%;" /></td>
                        </tr>
							
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">No. Orden</th>
                            <th style="text-align:left;">Vehiculo</th>
                            <th style="text-align:left;">Empleado Asignado</th>
                            <th style="text-align:left;">Tipo Mantenimiento</th>
                            <th style="text-align:left;">Fecha Mantenimiento</th>
                            <th style="text-align:left;">Observaciones</th>
							<th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>

                        <tr>
                            <td><?php echo $r->__GET('id'); ?></td>
                            <td><?php echo $r->__GET('idplaca'); ?></td>
                            <td><?php echo $r->__GET('idempleado'); ?></td>
                            <td><?php echo $r->__GET('tipomantenimiento'); ?></td>
                            <td><?php echo $r->__GET('fechamantenimiento'); ?></td>
                            <td><?php echo $r->__GET('tallermantenimiento'); ?></td>
							
                            <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table> 
					
              
            </div>
        </div>
		<div>
			<br>
			<input type="button" class="pure-button pure-button-warning" value="Volver al Inicio" onClick="window.location = 'index.php';"> 
        </div>
     </body>
    </html>
   </body>
</html>