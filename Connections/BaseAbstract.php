<?php
abstract class BaseAbstract {
/*	Base interna del propio sistema caja_db
*/
	protected $__USER = 'root';
	protected $__PASSWORD = '';
	protected $__BASE = 'sistemcont_db';
	protected $__SERVER = 'localhost';
	
	/*
	protected $__USER = 'hosting_admin';
	protected $__PASSWORD = 'E-CQQJ)08K(!';
	protected $__BASE = 'hosting_productos';
	protected $__SERVER = 'gator4225.hostgator.com';
	*/
	abstract public function ConnectDB();

}
?>