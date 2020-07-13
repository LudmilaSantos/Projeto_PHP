<?php
class view{
    public function login($mensagem = ""){
?>
        <div class="d-flex align-items-center justify-content-center h-100 w-100"> 
            <div class="card p-3" style="width: 350px">
                <h4 class="text-center text-primary">Login</h4>
                <?php echo $mensagem ?>
                <form class="m-0" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <label class="d-block">E-mail: <input type="text" name="f_mail" class="form-control" autofocus></label>
                    <label class="d-block">Senha: <input type="password" name="f_senha" class="form-control"></label>
                    <button type="submit" class="btn btn-primary d-block mx-auto mt-3">Enviar</button>
                </form>
            </div>
        </div>
<?php
    }

    public function trocar_senha($mensagem = ""){
?>
        <div class="d-flex align-items-center justify-content-center h-100 w-100"> 
            <div class="card p-3" style="width: 350px">
                <h4 class="text-center text-primary">Troque a senha padrão</h4>
                <?php echo $mensagem ?>
                <form class="m-0" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>?acao=trocar_senha">
                    <label class="d-block">Nova senha: <input type="password" name="f_senha" class="form-control" autofocus></label>
                    <button type="submit" class="btn btn-primary d-block mx-auto mt-3">Enviar</button>
                </form>
            </div>
        </div>
<?php
    }

    public function cadastro($meuperfil, $myuserdao, $f_nome, $f_mail, $f_perfil, $f_id){
?>
        <nav class="navbar navbar-expand-lg bg-primary p-4">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-2 active">
                        <a class="nav-link btn btn-light" href="classes/relatorio.php" target="_blank">Gerar PDF</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link btn btn-outline-light" href="<?php echo $_SERVER['PHP_SELF']; ?>?acao=logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="d-flex align-items-center flex-column p-4 bg-primary">
            <div class="card p-3" style="width: 350px">
                <h4 class="text-center text-primary">Cadastro de usuários</h4>
                <form class="m-0" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?acao=<?php echo isset($f_id) ? "alterar" : "inserir" ?>">
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
                                    <form class="d-inline-block m-0" method="POST" action=<?php echo $_SERVER['PHP_SELF']; ?>?acao=cadastro>
                                        <input type="hidden" name="f_id" value="<?php echo $usuarios->getId(); ?>">
                                        <input type="hidden" name="acao" value="alterar">
                                        <button class="btn btn-outline-primary" type="submit">Alterar</button>
                                    </form> 
                                    <form class="d-inline-block m-0" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?acao=resetar_senha">
                                        <input type="hidden" name="f_id" value="<?php echo $usuarios->getId(); ?>">
                                        <button class="btn btn-outline-primary" type="submit">Resetar senha</button>
                                    </form>		
                                    <form class="d-inline-block m-0" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?acao=excluir">
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
    <?php
    }
}
?>