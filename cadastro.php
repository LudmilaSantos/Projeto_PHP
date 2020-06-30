<?php
    session_start();
    if(!isset($_SESSION['f_id'])) {
        session_destroy();
        header("Location:/");
    }
    require_once("DAO/usuariosDAO.php");
    require_once("DAO/perfisDAO.php");

    $myuser = new usuarios();
    $meuperfil = new perfisDAO();
    $myuserdao = new usuariosDAO($myuser);
    if(isset($_POST["acao"])) {
        $acao = $_POST["acao"];
    } else {
        $acao = "";
    }
    if($acao == "alterar") {
        foreach($myuserdao->find($_POST['f_id']) as $key=>$value) {
            $f_nome = $value->nome;
            $f_mail = $value->email;
            $f_perfil = $value->id_perfil;
            $f_id = $value->id;
        }
    }
?>
<html>
	<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
		<title>Usuários do Sistema</title>
	</head>
    <body>
        <nav class="navbar navbar-expand-lg bg-primary p-4">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-2 active">
                        <a class="nav-link btn btn-light" href="relatorio.php">Gerar PDF</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link btn btn-outline-light" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="d-flex align-items-center flex-column p-4 bg-primary">
            <div class="card p-3" style="width: 350px">
                <h4 class="text-center text-primary">Cadastro de usuários</h4>
                <form class="m-0" method="POST" action="<?php echo isset($f_id) ? "alterar.php" : "inserir.php" ?>">
                    <label class="d-block">Nome: <input class="form-control" type="text" name="f_nome" value="<?php echo isset($f_nome) ? $f_nome : ""; ?>"></label>
                    <label class="d-block">E-mail: <input class="form-control" type="text" name="f_mail" value="<?php echo isset($f_mail) ? $f_mail : ""; ?>"></label>
                    <label class="d-block">Perfil: 
                        <select name="f_perfil" class="custom-select">
                            <option>Selecione o perfil</option>
                            <?php foreach($meuperfil->load() as $perfil){ ?>
                                <option value="<?= $perfil->getId(); ?>" <?= isset ($f_perfil) && $f_perfil == $perfil->getId() ? "selected" : "" ?>><?= $perfil->getNome(); ?></option>
                            <?php } ?>
                        </select>
                    <input type=hidden name=f_id value="<?php echo isset($f_id) ? $f_id : ""; ?>">
                    <?php if(isset($f_id)) { ?>
                        <input type="hidden" name="acao" value="salvar_alteracao">
                        <button class="btn btn-primary d-block mx-auto mt-3" type="submit">Alterar</button>
                    <?php } else { ?>
                        <input type="hidden" name="acao" value="enviar">
                        <button class="btn btn-primary d-block mx-auto mt-3" type="submit">Enviar</button>
                    <?php } ?>
                </form>
            </div>
            <div class="card p-3 mt-4" style="width: 1300px">
                <table class="table table-bordered table-hover">
                    <thead class="text-primary">
                        <tr>
                            <th width="25%">Nome</th>
                            <th width="25%">E-mail</th>
                            <th width="25%">Perfil</th>
                            <th width="25%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($myuserdao->load() as $usuarios){ ?>
                            <tr>
                                <td><?php echo $usuarios->getNome(); ?></td>
                                <td><?php echo $usuarios->getEmail(); ?></td>
                                <td><?php echo $meuperfil->find($usuarios->getPerfil())[0]->nome; ?></td>
                                <td>
                                    <form class="d-inline-block m-0" method="POST" action=<?php echo $_SERVER['PHP_SELF']; ?>>
                                        <input type="hidden" name="f_id" value="<?php echo $usuarios->getId(); ?>">
                                        <input type="hidden" name="acao" value="alterar">
                                        <button class="btn btn-outline-primary" type="submit">Alterar</button>
                                    </form> 
                                    <form class="d-inline-block m-0" method="POST" action="resetar_senha.php">
                                        <input type="hidden" name="f_id" value="<?php echo $usuarios->getId(); ?>">
                                        <button class="btn btn-outline-primary" type="submit">Resetar senha</button>
                                    </form>		
                                    <form class="d-inline-block m-0" method="POST" action="excluir.php">
                                        <input type="hidden" name="f_id" value="<?php echo $usuarios->getId(); ?>">
                                        <button class="btn btn-danger" type="submit">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php }?>	
                    </tbody>
                </table>
                <div class="d-block text-center text-secondary mt-3">
                    Total de registros: <?= count($myuserdao->load()); ?>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</body>
</html>