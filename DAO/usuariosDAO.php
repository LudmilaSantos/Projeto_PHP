<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/Cadastro/classes/usuarios.php');
    require_once('Crud.php');

    class usuariosDAO extends Crud{
        private $d_usuario;
        protected $table = 'usuarios';

        public function __construct($p_usuario){
            $this->d_usuario = $p_usuario;
        }
        
        public function __clone(){

        }

        public function __destruct(){
            foreach($this as $key => $value){
                unset($this->$key);
            }
            foreach(array_keys(get_defined_vars()) as $var){
                unset(${"$var"});
            }
            unset($var);
        }

        public function insert(){
            $sql  = "INSERT INTO $this->table (nome, email, senha, id_perfil) VALUES ('".$this->d_usuario->getNome()."', '".$this->d_usuario->getEmail()."', '".$this->d_usuario->getSenha()."', '".$this->d_usuario->getPerfil()."')";
            $stmt = DB::prepare($sql);
            return $stmt->execute(); 
        }
        
        public function update($id){
            $sql  = "UPDATE $this->table SET nome = '".$this->d_usuario->getNome()."', email = '".$this->d_usuario->getEmail()."', id_perfil = '".$this->d_usuario->getPerfil()."' WHERE id = '".$this->d_usuario->getId()."'";
            $stmt = DB::prepare($sql);
            return $stmt->execute();	
        }

        public function delete($id){
            $sql  = "DELETE FROM $this->table WHERE id = '".$this->d_usuario->getId()."'";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute(); 
        }

        public function login(){
    	    $sql = "SELECT id FROM $this->table WHERE email = '" . $this->d_usuario->getEmail() . "' and senha = '";
    	    $sql = $sql . $this->d_usuario->getSenha() . '\'';
    	    $stmt = DB::prepare($sql);
    		$stmt->execute();
    		//$count = $stmt->rowCount();
    		//return $count;
    		$ident = $stmt->fetchAll();
    		foreach ($ident as $key => $value) {
    			if ($value->id > 0) {
    				return $value->id;
    			} else {
    				return 0;
    			}
    		}
    	}

        public function reset($id){
            $sql  = "UPDATE $this->table SET senha = '".$this->d_usuario->getSenha()."' WHERE id = '".$this->d_usuario->getId()."'";
            $stmt = DB::prepare($sql);
            return $stmt->execute();	
        }

        public function load(){
            $array = $this->findAll();
            foreach($array as $chave => $valor){
                $objeto = new usuarios();
                $objeto->setId($valor->id);
                $objeto->setNome($valor->nome);
                $objeto->setEmail($valor->email);
                $objeto->setSenha($valor->senha);
                $objeto->setPerfil($valor->id_perfil);
                $arrayUsuarios[] = $objeto;
            }
            return $arrayUsuarios;
        }
    }