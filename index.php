<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/Cadastro/DAO/usuariosDAO.php');
    $myuser = new usuarios();
    if(isset($_POST['f_mail']) and isset($_POST['f_senha'])){
        $myuser->setEmail($_POST['f_mail']);
        $myuser->setSenha($_POST['f_senha']);
        $myuserdao = new usuariosDAO($myuser);
        $resultado = $myuserdao->login();
        if($resultado > 0) {
            $_SESSION['f_id'] = $resultado;
            if($_POST['f_senha'] == '123456') {
                header("Location:trocarsenha.php");
            } else {
                header("Location:cadastro.php");
            }
        } else {
            $output = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Login ou senha incorretos!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          exibe_pagina($output);
        }
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

            <title>Login do Sistema</title>
        </head>
        <body class="d-flex align-items-center justify-content-center bg-primary">
            <div class="card p-3" style="width: 350px">
                <h4 class="text-center text-primary">Login</h4>
                <?php echo $mensagem ?>
                <form class="m-0" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <label class="d-block">E-mail: <input type="text" name="f_mail" class="form-control" autofocus></label>
                    <label class="d-block">Senha: <input type="password" name="f_senha" class="form-control"></label>
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