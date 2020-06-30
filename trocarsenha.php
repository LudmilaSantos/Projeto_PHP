<?php
    session_start();
    require_once("DAO/usuariosDAO.php");
    $myuser = new usuarios();
    $myuser->setId($_SESSION['f_id']);
    $myuserdao = new usuariosDAO($myuser);
        if(isset($_POST['f_senha'])){
        $myuser->setSenha($_POST['f_senha']);
        $myuserdao->reset($myuser->getId());
        header("Location:index.php");
    } else {
        exibe_pagina('');
    }
    function exibe_pagina($mensagem){
?>
    <html>
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="/css/bootstrap.min.css">

            <title>Trocar senha</title>
        </head>
        <body class="d-flex align-items-center justify-content-center bg-primary">
            <div class="card p-3" style="width: 350px">
                <h4 class="text-center text-primary">Troque a senha padrão</h4>
                <?php echo $mensagem ?>
                <form class="m-0" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <label class="d-block">Nova senha: <input type="password" name="f_senha" class="form-control" autofocus></label>
                    <button type="submit" class="btn btn-primary d-block mx-auto mt-3">Enviar</button>
                </form>
            </div>
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        </body>
    </html>
<?php } ?>