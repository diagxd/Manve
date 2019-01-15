<?php
class Cliente
{
	private $idcliente;
	private $nombre;
	private $apellido;
	private $direccion;
	private $telefono;
	private $email;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}