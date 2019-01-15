<?php
class VehiculoinventarioModel
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

			$stm = $this->pdo->prepare("SELECT vi.*, v.placa FROM tb_vehiculosinventario as vi
										INNER JOIN tb_vehiculos as v ON v.id = vi.idplaca ORDER BY v.id");
			$stm->execute();
                        
                        

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)

			{
				$alm = new Vehiculoinventario();

				$alm->__SET('idinventario', $r->idinventario);
				$alm->__SET('idplaca', $r->placa);
				$alm->__SET('kitcarretera', $r->kitcarretera);
				$alm->__SET('extintor', $r->extintor);
				$alm->__SET('cruceta', $r->cruceta);
				$alm->__SET('gato', $r->gato);
				$alm->__SET('llaves', $r->llaves);
				$alm->__SET('repuesto', $r->repuesto);
				$alm->__SET('catalogo', $r->catalogo);	

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
			          ->prepare("SELECT * FROM tb_vehiculosinventario WHERE idinventario = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			$alm = new Vehiculoinventario();

				$alm->__SET('idinventario', $r->idinventario);
				$alm->__SET('idplaca', $r->idplaca);
				$alm->__SET('kitcarretera', $r->kitcarretera);
				$alm->__SET('extintor', $r->extintor);
				$alm->__SET('cruceta', $r->cruceta);
				$alm->__SET('gato', $r->gato);
				$alm->__SET('llaves', $r->llaves);
				$alm->__SET('repuesto', $r->repuesto);
				$alm->__SET('catalogo', $r->catalogo);
                                                                
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
			          ->prepare("DELETE FROM tb_vehiculosinventario WHERE idinventario = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Vehiculoinventario $data)
	{
		try 
		{
			$sql = "UPDATE vehiculosinventario SET 
						idplaca			= ?, 
						kitcarretera    	= ?,
						extintor		= ?, 
						cruceta			= ?,
						gato			= ?,
						llaves			= ?,
						repuesto		= ?,
						catalogo		= ?
				    WHERE idinventario = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
									
					$data->__GET('idplaca'), 
					$data->__GET('kitcarretera'), 
					$data->__GET('extintor'),
					$data->__GET('cruceta'),
					$data->__GET('gato'),
					$data->__GET('llaves'),
					$data->__GET('repuesto'),
					$data->__GET('catalogo'),
					
					$data->__GET('idinventario')
					)
				);
				
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Vehiculoinventario $data)
	{
		try 
		{
		$sql = "INSERT INTO tb_vehiculosinventario(idplaca, kitcarretera, extintor, cruceta, gato, llaves, repuesto,catalogo) "
                        . "VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                
                //print_r($sql);
                //exit();

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('idplaca'), 
				$data->__GET('kitcarretera'), 
				$data->__GET('extintor'),
				$data->__GET('cruceta'),
				$data->__GET('gato'),
				$data->__GET('llaves'),
				$data->__GET('repuesto'),
				$data->__GET('catalogo')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}