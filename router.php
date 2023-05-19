<?php
$action = (string) null;
$component = (string) null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {

    $component = strtoupper($_GET['component']);
    $action = strtoupper($_GET['action']);

    switch ($component) {
        case 'CONTATOS';
            require_once('controller/controllerContatos.php');

            if ($action == 'INSERIR') {

                $resposta = inserirContato($_POST);

                if (is_bool($resposta)) {

                    if ($resposta)
                        echo ("<script>alert('Registro inserido com sucesso!'); window.location.href = 'index.php'</script>");
                } else if (is_array($resposta))
                    echo ("<script>alert('" . $resposta["message"] . "'); window.location.href = 'index.php'</script>");

            } else if ($action == 'DELETAR') {

                $id = $_GET['id'];
                $resposta = excluirContato($id);

                if (is_bool($resposta)) {

                    if ($resposta)
                        echo ("<script>alert('Registro excluído com sucesso!'); window.location.href = 'index.php'</script>");
                } else if (is_array($resposta))
                    echo ("<script>alert('" . $resposta["message"] . "'); window.location.href = 'index.php'</script>");

            } elseif ($action == 'BUSCAR') {

                $id = $_GET['id'];
                $dados = buscarContato($id);

                session_start();

                $_SESSION['dadosContato'] = $dados;

                require_once('index.php');

            } else if ($action == 'EDITAR') {
                
                $id = $_GET['id'];
                $resposta = atualizarContato($_POST, $id);

                if (is_bool($resposta)) {

                    if ($resposta)
                        echo ("<script>alert('Registro atualizado com sucesso!'); window.location.href = 'index.php'</script>");
                } else if (is_array($resposta))
                    echo ("<script>alert('" . $resposta["message"] . "'); window.history.back();</script>");
            }
        break;
    }
}
