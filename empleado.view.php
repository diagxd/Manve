<!DOCTYPE>
<html>
<head>
 <title>FORMULARIO EMPLEADO</title>
  </head>
     <body>
        <body background="assets/img/3.png">

                <p><h2>Registrar Empleado</h2></p>


<?php
require_once 'empleado.entidad.php';
require_once 'empleado.model.php';


// Logica
$alm = new Empleado();
$model = new EmpleadoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idempleado',        $_REQUEST['idempleado']);
            $alm->__SET('nombre',    $_REQUEST['nombre']);
            $alm->__SET('apellido',    $_REQUEST['apellido']);
            $alm->__SET('direccion',    $_REQUEST['direccion']);
            $alm->__SET('telefono', $_REQUEST['telefono']);
            $alm->__SET('email',    $_REQUEST['email']);

			$model->Actualizar($alm);
			header('Location: empleado.view.php');
			break;

		case 'registrar':
			$alm->__SET('idempleado',        $_REQUEST['idempleado']);
            $alm->__SET('nombre',    $_REQUEST['nombre']);
            $alm->__SET('apellido',    $_REQUEST['apellido']);
            $alm->__SET('direccion',    $_REQUEST['direccion']);
            $alm->__SET('telefono', $_REQUEST['telefono']);
            $alm->__SET('email',    $_REQUEST['email']);

			$model->Registrar($alm);
			header('Location: empleado.view.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['id']);
			header('Location: empleado.view.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['id']);
			break;
	}
}
 $vehiculos = $model->Listar();
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
                
                <form action="?action=<?php echo $alm->idempleado > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idempleado" value="<?php echo $alm->__GET('idempleado'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $alm->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Apellido</th>
                            <td><input type="text" name="apellido" value="<?php echo $alm->__GET('apellido'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Direccion</th>
                            <td><input type="text" name="direccion" value="<?php echo $alm->__GET('direccion'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Telefono</th>
                            <td><input type="text" name="telefono" value="<?php echo $alm->__GET('telefono'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Email</th>
                            <td colspan="2"><input type="text" name="email" value="<?php echo $alm->__GET('email'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Apellido</th>
                            <th style="text-align:left;">Direccion</th>
                            <th style="text-align:left;">Telefono</th>
                            <th style="text-align:left;">Email</th>
						
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('apellido'); ?></td>
                            <td><?php echo $r->__GET('direccion'); ?></td>
                            <td><?php echo $r->__GET('telefono'); ?></td>
                            <td><?php echo $r->__GET('email'); ?></td>
                            <td>
                                <a href="?action=editar&id=<?php echo $r->idempleado; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->idempleado; ?>">Eliminar</a>
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