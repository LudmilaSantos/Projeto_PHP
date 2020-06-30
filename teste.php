<html>
    <head></head>
    <body>
    <?php
        require_once($_SERVER['DOCUMENT_ROOT'].'/DAO/perfisDAO.php');
    ?>
        <h2>Perfis</h2>
        <select name=perfis id=perfis>
        <?php
            $meuPerfil = new perfisDAO();
            $meuArray = $meuPerfil->load();
            foreach($meuArray as $perfis){
        ?>
            <option value="<?= $perfis->getId() ?>"> <?= $perfis->getNome() ?> </option>
        <?php
            }
        ?>
        </select>
    </body>
</html>