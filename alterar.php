<?php
    require_once("DAO/usuariosDAO.php");
        $myuser = new usuarios();
        $myuser->setNome($_POST['f_nome']);
	    $myuser->setEmail($_POST['f_mail']);
        $myuser->setId($_POST['f_id']);
        $myuser->setPerfil($_POST['f_perfil']);
        $myuserdao = new usuariosDAO($myuser);
        $myuserdao->update($myuser->getId());
        Header("Location:cadastro.php");
?>