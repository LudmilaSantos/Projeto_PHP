<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/Cadastro/classes/perfis.php');
    require_once('Crud.php');

    class perfisDAO extends Crud{
        private $d_perfil;
        protected $table = 'perfis';
        public function __construct(){

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
        }

    	public function insert(){
    		$sql  = "INSERT INTO $this->table (nome) VALUES ('". $this->d_perfil->nome . "')";
    		$stmt = DB::prepare($sql);
    		return $stmt->execute(); 
    	}

        public function update($id){
            $sql  = "UPDATE $this->table SET nome = :nome WHERE id = :id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            return $stmt->execute();	
        }	

        public function load(){
            $array = $this->findAll();
            foreach($array as $chave => $valor){
                $objeto = new perfis();
                $objeto->setId($valor->id);
                $objeto->setNome($valor->nome);
                $arrayPerfis[] = $objeto;
            }
            return $arrayPerfis;
        }

        public function delete($id){
            $sql  = "DELETE FROM $this->table WHERE id = :id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute(); 
        }
    }