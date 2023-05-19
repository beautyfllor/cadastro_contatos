<?php
    $form = (string) "router.php?component=contatos&action=inserir";

    if(session_status()) {

        if(!empty($_SESSION['dadosContato'])) {

            $id                     = $_SESSION['dadosContato']['id'];
            $nome                   = $_SESSION['dadosContato']['nome'];
            $email                  = $_SESSION['dadosContato']['email'];
            $telefone               = $_SESSION['dadosContato']['telefone'];
            $data_nascimento        = $_SESSION['dadosContato']['data_nascimento'];
            $profissao              = $_SESSION['dadosContato']['profissao'];
            $celular                = $_SESSION['dadosContato']['celular'];

            $form = "router.php?component=contatos&action=editar&id=".$id;

            unset($_SESSION['dadosContato']);
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/button.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/footer.css">

    <title>Cadastro de contatos</title>

</head>

<body>

    <header>
        <img src="./img/logo_alphacode.png" alt="logo_alphacode">
        <h2>Cadastro de contatos</h2>
    </header>

    <main>

        <form action="<?=$form?>" name="frmCadastro" method="post">

            <div class="form">
                <div class="container-inputs">
                    <div class="campo">
                        <div class="label">
                            <label>Nome completo</label>
                        </div>
                        <div>
                            <input name="txtNome" class="input" type="text" value="<?=isset($nome)?$nome:null?>" placeholder="Ex.: Letícia Pacheco dos Santos" maxlength="100">
                        </div>
                    </div>

                    <div class="campo">
                        <div class="label">
                            <label>E-mail</label>
                        </div>
                        <div>
                            <input name="txtEmail" class="input" type="email" value="<?=isset($email)?$email:null?>" placeholder="Ex.: leticia@gmail.com" maxlength="100">
                        </div>
                    </div>

                    <div class="campo">
                        <div class="label">
                            <label>Telefone para contato</label>
                        </div>
                        <div>
                            <input name="txtTelefone" class="input" type="tel" value="<?=isset($telefone)?$telefone:null?>" placeholder="Ex.: (11) 4033-2019" maxlength="14">
                        </div>
                    </div>

                    <div>
                        <div class="check">
                            <input name="contatos[]" value="whatsapp" type="checkbox" class="checkbox">
                            <label class="check-text">Número de celular possui Whatsapp</label>
                        </div>
                        <div class="check">
                            <input name="contatos[]" value="sms" type="checkbox" class="checkbox">
                            <label class="check-text">Enviar notificações por SMS</label>
                        </div>
                    </div>
                </div>

                <div class="container-inputs">
                    <div class="campo">
                        <div class="label">
                            <label>Data de nascimento</label>
                        </div>
                        <div>
                            <input name="txtDataNascimento" class="input" type="text" value="<?=isset($data_nascimento)?$data_nascimento:null?>" placeholder="Ex.: 2003-10-03" maxlength="10">
                        </div>
                    </div>

                    <div class="campo">
                        <div class="label">
                            <label>Profissão</label>
                        </div>
                        <div>
                            <input name="txtProfissao" class="input" type="text" value="<?=isset($profissao)?$profissao:null?>" placeholder="Ex.: Desenvolvedora Web" maxlength="50">
                        </div>
                    </div>

                    <div class="campo">
                        <div class="label">
                            <label>Celular para contato</label>
                        </div>
                        <div>
                            <input name="txtCelular" class="input" type="tel" value="<?=isset($celular)?$celular:null?>" placeholder="Ex.: (11) 98493-2039" maxlength="15">
                        </div>
                    </div>

                    <div>
                        <div class="check">
                            <input name="contatos[]" value="email" type="checkbox" class="checkbox">
                            <label class="check-text">Enviar notificações por E-mail</label>
                        </div>
                    </div>

                </div>
            </div>

            <div id="button">
                <input name="submit" type="submit" id="cadastrar" name="btnCadastrar" value="Cadastrar contato">
            </div>

        </form>

        <table id="tblContatos">

            <thead>

                <tr>
                    <th>Nome</th>
                    <th>Data de nascimento</th>
                    <th>Email</th>
                    <th>Celular para contato</th>
                    <th>Ações</th>
                </tr>

            </thead>

            <tbody>

                <?php
                    require_once('controller/controllerContatos.php');

                    $listContato = listarContato();

                    foreach($listContato as $item) {
                ?>

                <tr class="informacoes">

                    <td><?=$item['nome']?></td>
                    <td><?=$item['data_nascimento']?></td>
                    <td><?=$item['email']?></td>
                    <td><?=$item['celular']?></td>

                    <td class="actions">
                        <a class="editar" href="router.php?component=contatos&action=buscar&id=<?=$item['id']?>">
                            <img src="./img/editar.png" alt="editar" title="Editar">
                        </a>

                        <a class="excluir" onclick="return confirm('Deseja excluir esse item?');" href="router.php?component=contatos&action=deletar&id=<?=$item['id']?>">
                            <img src="./img/excluir.png" alt="excluir" title="Excluir">
                        </a>
                    </td>

                </tr>
                <?php
                    }
                ?>
            </tbody>

        </table>

    </main>

    <footer>
        <p class="p-termos">Termos | Políticas</p>
        <p>© Copyright 2022 | Desenvolvido por</p>
        <img src="./img/logo_rodape_alphacode.png" class="logo" alt="logo_alphacode">
        <p class="p-alphacode">©Alphacode IT Solutions 2022</p>
    </footer>

</body>

</html>