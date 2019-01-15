<!DOCTYPE>

<html>
<head>
 <title>FORMULARIO VEHICULO</title>
    </head>
       <body>
           <body background="assets/img/3.png">
                <p><h2>Registrar Vehiculos</h2></p>


<?php
require_once 'vehiculo.entidad.php';
require_once 'vehiculo.model.php';

require_once 'cliente.entidad.php';
require_once 'cliente.model.php';

$cliente = new Cliente();
$modelCliente = new ClienteModel();

// Logica
$alm = new Vehiculo();
$model = new VehiculoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('id',		$_REQUEST['id']);
            $alm->__SET('idcliente',       $_REQUEST['idcliente']);
			$alm->__SET('placa',    $_REQUEST['placa']);
			$alm->__SET('marca',    $_REQUEST['marca']);
			$alm->__SET('referencia',	$_REQUEST['referencia']);
			$alm->__SET('color',	$_REQUEST['color']);
			$alm->__SET('facturacompra',	$_REQUEST['facturacompra']);
			$alm->__SET('manifiestoaduana', $_REQUEST['manifiestoaduana']);
			$alm->__SET('soat',		$_REQUEST['soat']);
			$alm->__SET('fechasoat',$_REQUEST['fechasoat']);
			$alm->__SET('tecnicomecanico',	$_REQUEST['tecnicomecanico']);
			$alm->__SET('tecnicomecanicofecha',	$_REQUEST['tecnicomecanicofecha']);
			$alm->__SET('poliza',	$_REQUEST['poliza']);
			$alm->__SET('polizafecha',	$_REQUEST['polizafecha']);		

			$model->Actualizar($alm);
			header('Location: vehiculo.view.php');
			break;

		case 'registrar':
			$alm->__SET('id',		$_REQUEST['id']);
             $alm->__SET('idcliente',       $_REQUEST['idcliente']);
			$alm->__SET('placa',    $_REQUEST['placa']);
			$alm->__SET('marca',    $_REQUEST['marca']);
			$alm->__SET('referencia',	$_REQUEST['referencia']);
			$alm->__SET('color',	$_REQUEST['color']);
			$alm->__SET('facturacompra',	$_REQUEST['facturacompra']);
			$alm->__SET('manifiestoaduana', $_REQUEST['manifiestoaduana']);
			$alm->__SET('soat',		$_REQUEST['soat']);
			$alm->__SET('fechasoat',$_REQUEST['fechasoat']);
			$alm->__SET('tecnicomecanico',	$_REQUEST['tecnicomecanico']);
			$alm->__SET('tecnicomecanicofecha',	$_REQUEST['tecnicomecanicofecha']);
			$alm->__SET('poliza',	$_REQUEST['poliza']);
			$alm->__SET('polizafecha',	$_REQUEST['polizafecha']);	

			$model->Registrar($alm);
			header('Location: vehiculo.view.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['id']);
			header('Location: vehiculo.view.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['id']);
			break;
	}
}
 $vehiculos = $model->Listar();
 $clientes = $modelCliente->Listar();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>JEBA - Modulo Mantenimiento Vehicular</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="id" value="<?php echo $alm->__GET('id'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Cliente</th>
                            <td>
                                <?php if ($alm->__GET('id')>0){?>                                                            
                                <select id="idcliente" name="idcliente" class="form-control">                                    
                                    <?php foreach($clientes as $c): 
                                         if ($c->idcliente == $alm->__GET('idcliente')){?>
                                    <option value="<?php echo $c->idcliente; ?>" selected="selected"><?php echo $c->nombre; ?></option>
                                    <?php }else{ ?>                                        
                                    <option value="<?php echo $c->idcliente; ?>"><?php echo $c->nombre; ?></option>
                                    <?php } endforeach; ?>
                                </select>
                                <?php }else{ ?>
                                <select id="idcliente" name="idcliente" class="form-control">
                                    <option value="" selected>Seleccione un cliente</option>
                                    <?php foreach($clientes as $c): ?>                                                                                
                                    <option value="<?php echo $c->idcliente; ?>"><?php echo $c->nombre; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Placa</th>
                            <td><input type="text" name="placa" value="<?php echo $alm->__GET('placa'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Marca</th>
                            <td><input type="text" name="marca" value="<?php echo $alm->__GET('marca'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Linea</th>
                            <td><input type="text" name="referencia" value="<?php echo $alm->__GET('referencia'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Color</th>
                            <td><input type="text" name="color" value="<?php echo $alm->__GET('color'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Factura de Compra</th>
                            <td colspan="2"><input type="text" name="facturacompra" value="<?php echo $alm->__GET('facturacompra'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Manifiesto Aduana</th>
                            <td colspan="2"><input type="text" name="manifiestoaduana" value="<?php echo $alm->__GET('manifiestoaduana'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Soat</th>
                            <td colspan="2"><input type="text" name="soat" value="<?php echo $alm->__GET('soat'); ?>" style="width:50%;" /></td>
                            <td>Fecha Vencimiento: <input type="text" name="fechasoat" value="<?php echo $alm->__GET('fechasoat'); ?>" style="width:50%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Tecnicomecanico</th>
                            <td colspan="2"><input type="text" name="tecnicomecanico" value="<?php echo $alm->__GET('tecnicomecanico'); ?>" style="width:50%;" /></td>
							 <td>Fecha Vencimiento: <input type="text" name="tecnicomecanicofecha" value="<?php echo $alm->__GET('tecnicomecanicofecha'); ?>" style="width:50%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Poliza</th>
                            <td colspan="2"><input type="text" name="poliza" value="<?php echo $alm->__GET('poliza'); ?>" style="width:50%;" /></td>
                            <td>Fecha Vencimiento: <input type="text" name="polizafecha" value="<?php echo $alm->__GET('polizafecha'); ?>" style="width:50%;" /></td>
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
                            <th style="text-align:left;">Cliente</th>
                            <th style="text-align:left;">Placa</th>
                            <th style="text-align:left;">Linea</th>
                            <th style="text-align:left;">Color</th>
                            <th style="text-align:left;">FacturaCompra</th>
                            <th style="text-align:left;">Manifiesto</th>
                            <th style="text-align:left;">Soat</th>
                            <th style="text-align:left;">Tecnicomecanico</th>
                            <th style="text-align:left;">Poliza</th>
							
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r):?>
                        <tr>
                            <td><?php echo $r->__GET('idcliente'); ?></td>
                            <td><?php echo $r->__GET('placa'); ?></td>
                            <td><?php echo $r->__GET('referencia'); ?></td>
                            <td><?php echo $r->__GET('color'); ?></td>
                            <td><?php echo $r->__GET('facturacompra'); ?></td>
                            <td><?php echo $r->__GET('manifiestoaduana'); ?></td>
                            <td><?php echo $r->__GET('fechasoat'); ?></td>
                            <td><?php echo $r->__GET('tecnicomecanicofecha'); ?></td>
                            <td><?php echo $r->__GET('polizafecha'); ?></td>
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
        </div></center>
       </body>
    </html>
  </body>
</html> 