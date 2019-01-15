<?php
class EmpleadoModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			
			$this->pdo = new PDO('pgsql:host=localhost;port=5432;dbname=bd_manve;user=postgres;password=123456');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tb_empleados");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Empleado();

				$alm->__SET('idempleado', $r->idempleado);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('apellido', $r->apellido);
				$alm->__SET('direccion', $r->direccion);
				$alm->__SET('telefono', $r->telefono);
				$alm->__SET('email', $r->email);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM tb_empleados WHERE idempleado = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Empleado();

			$alm->__SET('idempleado', $r->idempleado);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('apellido', $r->apellido);
				$alm->__SET('direccion', $r->direccion);
				$alm->__SET('telefono', $r->telefono);
				$alm->__SET('email', $r->email);

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM tb_empleados WHERE idempleado = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Empleado $data)
	{
		try 
		{
			$sql = "UPDATE tb_empleados SET 
						nombre		= ?, 
						apellido		= ?,
						direccion		= ?, 
						telefono	= ?,
						email		= ?
				    WHERE idempleado = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('apellido'), 
					$data->__GET('direccion'),
					$data->__GET('telefono'),
					$data->__GET('email'),
					$data->__GET('idempleado')					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Empleado $data)
	{
		try 
		{
		$sql = "INSERT INTO tb_empleados (nombre,apellido,direccion,telefono,email) 
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombre'), 
					$data->__GET('apellido'), 
					$data->__GET('direccion'),
					$data->__GET('telefono'),
					$data->__GET('email')	
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}