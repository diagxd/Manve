<!DOCTYPE>

<html>
<head>
<title>FORMULARIO INVENTARIO VEHICULO</title>
  </head>
     <body>
        <body background="assets/img/3.png">
                <p><h2>Registrar Inventario Vehiculo</h2></p>

<?php
require_once 'vehiculoinventario.entidad.php';
require_once 'vehiculoinventario.model.php';

require_once 'vehiculo.entidad.php';
require_once 'vehiculo.model.php';

// Logica
$alm = new Vehiculoinventario();
$model = new VehiculoinventarioModel();

$vehiculo = new Vehiculo();
$modelVehiculos = new VehiculoModel();


if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idinventario',		$_REQUEST['idinventario']);
			$alm->__SET('idplaca',    $_REQUEST['idplaca']);
			$alm->__SET('kitcarretera',    $_REQUEST['kitcarretera']);
			$alm->__SET('extintor',	$_REQUEST['extintor']);
			$alm->__SET('cruceta',	$_REQUEST['cruceta']);
			$alm->__SET('gato',	$_REQUEST['gato']);
			$alm->__SET('llaves', $_REQUEST['llaves']);
			$alm->__SET('repuesto',		$_REQUEST['repuesto']);
			$alm->__SET('catalogo',$_REQUEST['catalogo']);
				
			$model->Actualizar($alm);
			header('Location: vehiculoinventario.view.php');
			break;

		case 'registrar':
			$alm->__SET('idinventario',		$_REQUEST['idinventario']);
			$alm->__SET('idplaca',    $_REQUEST['idplaca']);
			$alm->__SET('kitcarretera',    $_REQUEST['kitcarretera']);
			$alm->__SET('extintor',	$_REQUEST['extintor']);
			$alm->__SET('cruceta',	$_REQUEST['cruceta']);
			$alm->__SET('gato',	$_REQUEST['gato']);
			$alm->__SET('llaves', $_REQUEST['llaves']);
			$alm->__SET('repuesto',		$_REQUEST['repuesto']);
			$alm->__SET('catalogo',$_REQUEST['catalogo']);	

			$model->Registrar($alm);
			header('Location: vehiculoinventario.view.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idinventario']);
			header('Location: vehiculoinventario.view.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['idinventario']);
			break;
	}
}
$vehiculos = $modelVehiculos->Listar();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>JEBA - Modulo Mantenimiento Vehicular</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idinventario > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idinventario" value="<?php echo $alm->__GET('idinventario'); ?>" />
                    
                    <table style="width:500px;">
					
                        <tr>
                            <th style="text-align:left;">Placa</th>
                            <td>
                                <?php if ($alm->__GET('idinventario')>0){?>                                                            
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
                            <th style="text-align:left;">Kit Carretera</th>
                            
                            <td>
                                <select name="kitcarretera" >
                                    <option value="SI" <?php echo $alm->__GET('kitcarretera') == 'SI' ? 'selected' : ''; ?>>SI</option>
                                    <option value="NO" <?php echo $alm->__GET('kitcarretera') == 'NO' ? 'selected' : ''; ?>>NO</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Extintor</th>
                            
							<td>
                                <select name="extintor" >
                                    <option value="SI" <?php echo $alm->__GET('extintor') == 'SI' ? 'selected' : ''; ?>>SI</option>
                                    <option value="NO" <?php echo $alm->__GET('extintor') == 'NO' ? 'selected' : ''; ?>>NO</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Cruceta</th>
                            
							<td>
                                <select name="cruceta" >
                                    <option value="SI" <?php echo $alm->__GET('cruceta') == 'SI' ? 'selected' : ''; ?>>SI</option>
                                    <option value="NO" <?php echo $alm->__GET('cruceta') == 'NO' ? 'selected' : ''; ?>>NO</option>
                                </select>
                            </td>
							
                        </tr>
						<tr>
                            <th style="text-align:left;">Gato</th>
                            
							<td>
                                <select name="gato" >
                                    <option value="SI" <?php echo $alm->__GET('gato') == 'SI' ? 'selected' : ''; ?>>SI</option>
                                    <option value="NO" <?php echo $alm->__GET('gato') == 'NO' ? 'selected' : ''; ?>>NO</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Llaves</th>                            
							<td>
                                <select name="llaves" >
                                    <option value="SI" <?php echo $alm->__GET('llaves') == 'SI' ? 'selected' : ''; ?>>SI</option>
                                    <option value="NO" <?php echo $alm->__GET('llaves') == 'NO' ? 'selected' : ''; ?>>NO</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Llanta Repuesto</th>                            
							<td>
                                <select name="repuesto" >
                                    <option value="SI" <?php echo $alm->__GET('repuesto') == 'SI' ? 'selected' : ''; ?>>SI</option>
                                    <option value="NO" <?php echo $alm->__GET('repuesto') == 'NO' ? 'selected' : ''; ?>>NO</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Manual / catalogo</th>                            
							<td>
                                <select name="catalogo" >
                                    <option value="SI" <?php echo $alm->__GET('catalogo') == 'SI' ? 'selected' : ''; ?>>SI</option>
                                    <option value="NO" <?php echo $alm->__GET('catalogo') == 'NO' ? 'selected' : ''; ?>>NO</option>
                                </select>
                            </td>
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
                            <th style="text-align:left;">Placa</th>
                            <th style="text-align:left;">Kit Carretera</th>
                            <th style="text-align:left;">Extintor</th>
                            <th style="text-align:left;">Cruceta</th>
                            <th style="text-align:left;">Gato</th>
                            <th style="text-align:left;">Llaves</th>
                            <th style="text-align:left;">Llanta Repuesto</th>
                            <th style="text-align:left;">Manual / catalogo</th>
							
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>

                        <tr>
                            <td><?php echo $r->__GET('idplaca'); ?></td>
                            <td><?php echo $r->__GET('kitcarretera'); ?></td>
                            <td><?php echo $r->__GET('extintor'); ?></td>
                            <td><?php echo $r->__GET('cruceta'); ?></td>
                            <td><?php echo $r->__GET('gato'); ?></td>
                            <td><?php echo $r->__GET('llaves'); ?></td>
                            <td><?php echo $r->__GET('repuesto'); ?></td>
                            <td><?php echo $r->__GET('catalogo'); ?></td>
                            <td>
                                <a href="?action=editar&idinventario=<?php echo $r->idinventario; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idinventario=<?php echo $r->idinventario; ?>">Eliminar</a>
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