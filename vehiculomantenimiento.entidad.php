<?php
class Vehiculomantenimiento
{
	private $id;
	private $idplaca;
	private $tipomantenimiento;
	private $fechamantenimiento;
	private $tallermantenimiento;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}