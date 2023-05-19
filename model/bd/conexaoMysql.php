<?php
    function conexaoMysql() {

        $conexao = array();
        $conexao = mysqli_connect('localhost', 'root', '', 'db_contatos');

        if ($conexao)
            return $conexao;
        else
            return false;
    }

    function fecharConexaoMysql($conexao) {
        mysqli_close($conexao);
    }
?>