<?php
class VehiculoModel
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

			$stm = $this->pdo->prepare("SELECT v.*, c.nombre
										FROM tb_vehiculos as v
    									INNER JOIN tb_clientes as c ON c.idcliente = v.idcliente ORDER BY v.id");
    									
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Vehiculo();

				$alm->__SET('id', $r->id);
				$alm->__SET('idcliente', $r->nombre);
				$alm->__SET('placa', $r->placa);
				$alm->__SET('marca', $r->marca);
				$alm->__SET('referencia', $r->referencia);
				$alm->__SET('modelo', $r->modelo);
				$alm->__SET('color', $r->color);
				$alm->__SET('facturacompra', $r->facturacompra);
				$alm->__SET('manifiestoaduana', $r->manifiestoaduana);
				$alm->__SET('soat', $r->soat);
				$alm->__SET('fechasoat', $r->fechasoat);
				$alm->__SET('tecnicomecanico', $r->tecnicomecanico);
				$alm->__SET('tecnicomecanicofecha', $r->tecnicomecanicofecha);
				$alm->__SET('poliza', $r->poliza);
				$alm->__SET('polizafecha', $r->polizafecha);			

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
			          ->prepare("SELECT * FROM tb_vehiculos WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Vehiculo();

			$alm->__SET('id', $r->id);
			$alm->__SET('idcliente', $r->idcliente);
			$alm->__SET('placa', $r->placa);
			$alm->__SET('marca', $r->marca);
			$alm->__SET('referencia', $r->referencia);
			$alm->__SET('modelo', $r->modelo);
			$alm->__SET('color', $r->color);
			$alm->__SET('facturacompra', $r->facturacompra);
			$alm->__SET('manifiestoaduana', $r->manifiestoaduana);
			$alm->__SET('soat', $r->soat);
			$alm->__SET('fechasoat', $r->fechasoat);
			$alm->__SET('tecnicomecanico', $r->tecnicomecanico);
			$alm->__SET('tecnicomecanicofecha', $r->tecnicomecanicofecha);
			$alm->__SET('poliza', $r->poliza);
			$alm->__SET('polizafecha', $r->polizafecha);

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
			          ->prepare("DELETE FROM tb_vehiculos WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Vehiculo $data)
	{
		try 
		{
			$sql = "UPDATE tb_vehiculos SET 
						idcliente	= ?,
						placa		= ?, 
						marca		= ?,
						modelo		= ?, 
						referencia	= ?,
						color		= ?,
						facturacompra	= ?,
						manifiestoaduana	= ?,
						soat		= ?,
						fechasoat	= ?,
						tecnicomecanico	= ?,
						tecnicomecanicofecha	= ?,
						poliza		= ?,
						polizafecha	= ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('idcliente'),
					$data->__GET('placa'), 
					$data->__GET('marca'), 
					$data->__GET('modelo'),
					$data->__GET('referencia'),
					$data->__GET('color'),
					$data->__GET('facturacompra'),
					$data->__GET('manifiestoaduana'),
					$data->__GET('soat'),
					$data->__GET('fechasoat'),
					$data->__GET('tecnicomecanico'),
					$data->__GET('tecnicomecanicofecha'),
					$data->__GET('poliza'),
					$data->__GET('polizafecha'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Vehiculo $data)
	{
		try 
		{
		$sql = "INSERT INTO tb_vehiculos (idcliente,placa, marca,modelo,referencia,color,facturacompra,manifiestoaduana,soat,fechasoat,tecnicomecanico,tecnicomecanicofecha,poliza,polizafecha) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('idcliente'),
				$data->__GET('placa'), 
				$data->__GET('marca'), 
				$data->__GET('modelo'),
				$data->__GET('referencia'),
				$data->__GET('color'),
				$data->__GET('facturacompra'),
				$data->__GET('manifiestoaduana'),
				$data->__GET('soat'),
				$data->__GET('fechasoat'),
				$data->__GET('tecnicomecanico'),
				$data->__GET('tecnicomecanicofecha'),
				$data->__GET('poliza'),
				$data->__GET('polizafecha')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}