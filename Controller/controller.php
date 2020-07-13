<?php
class controller{
    public function login(){
        $view = new view();
        $myuser = new usuarios();

        if(isset($_POST['f_mail']) and isset($_POST['f_senha'])){
            $myuser->setEmail($_POST['f_mail']);
            $myuser->setSenha($_POST['f_senha']);
            $myuserdao = new usuariosDAO($myuser);
            $resultado = $myuserdao->login();
            if($resultado > 0) {
                $_SESSION['f_id'] = $resultado;
                if($_POST['f_senha'] == '123456') {
                    unset($_POST['f_senha']);
                    return $this->trocar_senha();
                } else {
                    return $this->cadastro();
                }
            } else {
                $output = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Login ou senha incorretos!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
                return $view->login($output);
            }
        } else {
            return $view->login();
        }
    }

    public function trocar_senha(){
        $view = new view();
        $myuser = new usuarios();
        $myuser->setId($_SESSION['f_id']);
        $myuserdao = new usuariosDAO($myuser);
        if(isset($_POST['f_senha'])){
            $myuser->setSenha($_POST['f_senha']);
            $myuserdao->reset($myuser->getId());
            return $this->login();
        } else {
            return $view->trocar_senha();
        }
    }

    public function cadastro(){
        $view = new view();
        if(!isset($_SESSION['f_id'])) {
            session_destroy();
            return $view->login();
        }
    
        $myuser = new usuarios();
        $meuperfil = new perfisDAO();
        $myuserdao = new usuariosDAO($myuser);
        if(isset($_POST["acao"])) {
            $acao = $_POST["acao"];
        } else {
            $acao = "";
        }
        $f_nome = null;
        $f_mail = null;
        $f_perfil = null;
        $f_id = null;
        if($acao == "alterar") {
            foreach($myuserdao->find($_POST['f_id']) as $key=>$value) {
                $f_nome = $value->nome;
                $f_mail = $value->email;
                $f_perfil = $value->id_perfil;
                $f_id = $value->id;
            }
        }
        return $view->cadastro($meuperfil, $myuserdao, $f_nome, $f_mail, $f_perfil, $f_id);
    }

    public function alterar(){
        $view = new view();
        $myuser = new usuarios();
        $myuser->setNome($_POST['f_nome']);
	    $myuser->setEmail($_POST['f_mail']);
        $myuser->setId($_POST['f_id']);
        $myuser->setPerfil($_POST['f_perfil']);
        $myuserdao = new usuariosDAO($myuser);
        $myuserdao->update($myuser->getId());
        return $this->cadastro();
    }

    public function excluir(){
        $view = new view();
        $myuser = new usuarios();
        $myuser->setId($_POST['f_id']);
        $myuserdao = new usuariosDAO($myuser);
        $myuserdao->delete($myuser->getId());
        return $this->cadastro();
    }

    public function inserir(){
        $view = new view();
        if(isset($_POST['f_mail']) and isset($_POST['f_nome']) and isset($_POST['f_perfil'])){
            $myuser = new usuarios();
            $myuser->setNome($_POST['f_nome']);
            $myuser->setEmail($_POST['f_mail']);
            $myuser->setSenha('123456');
            $myuser->setPerfil($_POST['f_perfil']);
            $myuserdao = new usuariosDAO($myuser);
            $resultado = $myuserdao->insert();
        }
        return $this->cadastro();
    }

    public function logout(){
        $view = new view();
        session_start();
        unset($_SESSION);
        session_destroy();
        return $view->login();
    }
   
    public function resetar_senha(){
        $view = new view();
        $myuser = new usuarios();
        $myuser->setId($_POST['f_id']);
        $myuser->setSenha('123456');
        $myuserdao = new usuariosDAO($myuser);
        $myuserdao->reset($myuser->getId());
        return $this->cadastro();
    }

}