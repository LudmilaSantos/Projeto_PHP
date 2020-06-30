<?php
    require_once("DAO/usuariosDAO.php");
	if(isset($_POST['f_mail']) and isset($_POST['f_nome']) and isset($_POST['f_perfil'])){
        $myuser = new usuarios();
        $myuser->setNome($_POST['f_nome']);
	    $myuser->setEmail($_POST['f_mail']);
        $myuser->setSenha('123456');
        $myuser->setPerfil($_POST['f_perfil']);
	    $myuserdao = new usuariosDAO($myuser);
        $resultado = $myuserdao->insert();
        $pagina = "Location:cadastro.php";
		header($pagina);
	}
?>