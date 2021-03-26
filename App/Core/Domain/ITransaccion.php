<?php
interface ITransaccion {
	/**
	 * Implementacion de transaccion
	 *
	 * @param int $id
	 */
	public function insert($id);
	/**
	 * Implementacion de transaccion
	 *
	 * @param [int] $id
	 */
	public function delete($id='');
	/**
	 * Implementacion de transaccion
	 *
	 * @param [int] $id
	 */
	public function update($id='');
	/**
	 * Implementacion de transaccion
	 *
	 * @param int $id
	 */
	public function find($id);
}
?>