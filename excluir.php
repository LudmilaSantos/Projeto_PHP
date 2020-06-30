<?php
    require_once("DAO/usuariosDAO.php");
        $myuser = new usuarios();
        $myuser->setId($_POST['f_id']);
        $myuserdao = new usuariosDAO($myuser);
        $myuserdao->delete($myuser->getId());
        Header("Location:cadastro.php");
?>