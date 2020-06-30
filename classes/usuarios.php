<?php

class usuarios{
	private $id;
	private $nome;
	private $email;
	private $senha;
	private $id_perfil;
	
	public function getId(){
		return $this->id;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function getSenha(){
		return $this->senha;
	}

	public function getPerfil(){
		return $this->id_perfil;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setSenha($senha){
		$this->senha = md5($senha);
	}

	public function setPerfil($id_perfil){
		$this->id_perfil = $id_perfil;
	}
	
}
?>