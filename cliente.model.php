<?php
class ClienteModel
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

			$stm = $this->pdo->prepare("SELECT * FROM tb_clientes");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Cliente();

				$alm->__SET('idcliente', $r->idcliente);
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
			          ->prepare("SELECT * FROM tb_clientes WHERE idcliente = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Cliente();

			$alm->__SET('idcliente', $r->idcliente);
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
			          ->prepare("DELETE FROM tb_clientes WHERE idcliente = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Cliente $data)
	{
		try 
		{
			$sql = "UPDATE tb_clientes SET 
						nombre		= ?, 
						apellido		= ?,
						direccion		= ?, 
						telefono	= ?,
						email		= ?
				    WHERE idcliente = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('apellido'), 
					$data->__GET('direccion'),
					$data->__GET('telefono'),
					$data->__GET('email'),
					$data->__GET('idcliente')					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Cliente $data)
	{
		try 
		{
		$sql = "INSERT INTO tb_clientes (nombre,apellido,direccion,telefono,email) 
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