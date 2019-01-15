<?php
class Vehiculoinventario
{
	private $idinventario;
	private $idplaca;
	private $kitcarretera;
	private $extintor;
	private $cruceta;
	private $gato;
	private $llaves;
	private $repuesto;
	private $catalogo;


	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}