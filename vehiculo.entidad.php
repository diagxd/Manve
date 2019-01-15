<?php
class Vehiculo
{
	private $id;
	private $placa;
	private $marca;
	private $referencia;
	private $modelo;
	private $color;
	private $facturacompra;
	private $manifiestoaduana;
	private $soat;
	private $fechasoat;
	private $tecnicomecanico;
	private $tecnicomecanicofecha;
	private $poliza;
	private $polizafecha;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}