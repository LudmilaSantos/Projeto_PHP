<?php
session_start();
require ("Controller/controller.php");
require ("Model/model.php");
require ("View/view.php");

$acao = $_GET['acao'];

?>
    <html>
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="/css/bootstrap.min.css">

            <title>Login do Sistema</title>
        </head>
        <body class="bg-primary">
            <?php
            $controller = new controller();
            if (isset ($acao)){
                if ($acao == 'login'){
                    $controller->login();
                } else if ($acao == 'trocar_senha'){
                    $controller->trocar_senha();
                } else if ($acao == 'cadastro'){
                    $controller->cadastro();
                } else if ($acao == 'alterar'){
                    $controller->alterar();
                } else if ($acao == 'excluir'){
                    $controller->excluir();
                } else if ($acao == 'inserir'){
                    $controller->inserir();
                } else if ($acao == 'logout'){
                    $controller->logout();
                } else if ($acao == 'resetar_senha'){
                    $controller->resetar_senha();
                }
            } else {
                $controller->login();
            } ?>
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        </body>
    </html>