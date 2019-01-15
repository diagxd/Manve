<?php
class VehiculomantenimientoModel
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

			//$stm = $this->pdo->prepare("SELECT * FROM tb_vehiculosmantenimiento");
			$stm = $this->pdo->prepare("SELECT mto.id, idplaca, tipomantenimiento, fechamantenimiento, tallermantenimiento, mto.idempleado
										,v.placa,e.nombre,e.apellido
										FROM tb_vehiculosmantenimiento as mto
    									INNER JOIN tb_vehiculos as v ON v.id = mto.idplaca
    									LEFT JOIN tb_empleados as e ON e.idempleado = mto.idempleado ORDER BY mto.id");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Vehiculomantenimiento();

				$alm->__SET('id', $r->id);
				$alm->__SET('idplaca', $r->placa);
				$alm->__SET('idempleado', $r->nombre.$r->apellido);
				$alm->__SET('tipomantenimiento', $r->tipomantenimiento);
				$alm->__SET('fechamantenimiento', $r->fechamantenimiento);
				$alm->__SET('tallermantenimiento', $r->tallermantenimiento);
				

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
			          ->prepare("SELECT * FROM tb_vehiculosmantenimiento WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Vehiculomantenimiento();

				$alm->__SET('id', $r->id);
				$alm->__SET('idplaca', $r->idplaca);
				$alm->__SET('idempleado', $r->idempleado);
				$alm->__SET('tipomantenimiento', $r->tipomantenimiento);
				$alm->__SET('fechamantenimiento', $r->fechamantenimiento);
				$alm->__SET('tallermantenimiento', $r->tallermantenimiento);

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
			          ->prepare("DELETE FROM tb_vehiculosmantenimiento WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Vehiculomantenimiento $data)
	{
		try 
		{
			$sql = "UPDATE tb_vehiculosmantenimiento SET 
						idplaca	= ?,
						idempleado =?,
						tipomantenimiento	= ?,
						fechamantenimiento	= ?, 
						tallermantenimiento	= ?
						
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
									
					$data->__GET('idplaca'), 
					$data->__GET('idempleado'), 
					$data->__GET('tipomantenimiento'), 
					$data->__GET('fechamantenimiento'),
					$data->__GET('tallermantenimiento'),
										
					$data->__GET('id')
					)
				);
				
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Vehiculomantenimiento $data)
	{
		try 
		{
		$sql = "INSERT INTO tb_vehiculosmantenimiento(idplaca, idempleado, tipomantenimiento,fechamantenimiento,tallermantenimiento) 
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('idplaca'),
				$data->__GET('idempleado'),  
				$data->__GET('tipomantenimiento'), 
				$data->__GET('fechamantenimiento'),
				$data->__GET('tallermantenimiento')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}