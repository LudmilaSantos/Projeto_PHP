<?php

require_once 'DB.php';

abstract class Crud extends DB{

	protected $table;

	abstract public function insert();
	abstract public function update($id);
	abstract public function delete($id);

	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function findAll(){
		$sql  = "SELECT * FROM $this->table";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function findEmail($email){
		$sql  = "SELECT * FROM $this->table WHERE email = :email";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}