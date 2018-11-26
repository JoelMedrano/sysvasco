<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=192.168.1.26;dbname=db_corpvasco",
			            "admin",
			            "vasco123");

		$link->exec("set names utf8");

		return $link;

	}

}
