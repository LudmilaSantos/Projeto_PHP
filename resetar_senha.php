<?php
    require_once("DAO/usuariosDAO.php");
    $myuser = new usuarios();
    $myuser->setId($_POST['f_id']);
    $myuser->setSenha('123456');
    $myuserdao = new usuariosDAO($myuser);
    $myuserdao->reset($myuser->getId());
    $pagina = "Location:cadastro.php";
	header($pagina);
?>
