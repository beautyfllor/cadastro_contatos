<?php
    require_once('conexaoMysql.php');
    
    function insertContato($dadosContato) {

        $statusResposta = (boolean) false;
        $conexao = conexaoMysql();

        $sql = "insert into tbl_contatos
                    (nome, 
                    email, 
                    telefone, 
                    data_nascimento, 
                    profissao, 
                    celular)
                values
                    ('".$dadosContato['nome']."',
                    '".$dadosContato['email']."',
                    '".$dadosContato['telefone']."',
                    '".$dadosContato['data_nascimento']."',
                    '".$dadosContato['profissao']."',
                    '".$dadosContato['celular']."'
                );";
                
        if(mysqli_query($conexao, $sql)) {

            if(mysqli_affected_rows($conexao))
                $statusResposta = true;
        }

        fecharConexaoMysql($conexao);

        return $statusResposta;
    }

    function updateContato($dadosContato) {

        $statusResposta = (boolean) false;
        $conexao = conexaoMysql();

        $sql = "update tbl_contatos set
                    nome                = '".$dadosContato['nome']."',
                    email               = '".$dadosContato['email']."',
                    telefone            = '".$dadosContato['telefone']."',
                    data_nascimento     = '".$dadosContato['data_nascimento']."',
                    profissao           = '".$dadosContato['profissao']."',
                    celular             = '".$dadosContato['celular']."'
                where id =".$dadosContato['id'];

        if(mysqli_query($conexao, $sql)) {

            if(mysqli_affected_rows($conexao))
                $statusResposta = true;
            }
        
        fecharConexaoMysql($conexao);
        
        return $statusResposta;
    }

    function deleteContato($id) {

        $statusResposta = (boolean) false;
        $conexao = conexaoMysql();

        $sql = "delete from tbl_contatos where id = ".$id;

        if(mysqli_query($conexao, $sql)) {

            if(mysqli_affected_rows($conexao))
                $statusResposta = true;
            }
        
        fecharConexaoMysql($conexao);
        
        return $statusResposta;
    }

    function selectAllContatos() {

        $conexao = conexaoMysql();
        $sql = "select * from tbl_contatos order by id desc";
        $result = mysqli_query($conexao, $sql);

        if($result) {
            $cont = 0;

            while($rsDados = mysqli_fetch_assoc($result)){

                $arrayDados[$cont] = array(
                    "id"                    => $rsDados['id'],
                    "nome"                  => $rsDados['nome'],
                    "email"                 => $rsDados['email'],
                    "telefone"              => $rsDados['telefone'],
                    "data_nascimento"       => $rsDados['data_nascimento'],
                    "profissao"             => $rsDados['profissao'],
                    "celular"               => $rsDados['celular']
                );
                $cont++;
            }

            fecharConexaoMysql($conexao);

            if(isset($arrayDados))
                return $arrayDados;
            else
                return false;
        }
    }

    function selectByIdContato($id) {
    
        $conexao = conexaoMysql();
        $sql = "select * from tbl_contatos where id = ".$id;
        $result = mysqli_query($conexao, $sql);

        if($result){

             if($rsDados = mysqli_fetch_assoc($result)){ 
    
                $arrayDados = array(
                    "id"                    => $rsDados['id'],
                    "nome"                  => $rsDados['nome'],
                    "email"                 => $rsDados['email'],
                    "telefone"              => $rsDados['telefone'],
                    "data_nascimento"       => $rsDados['data_nascimento'],
                    "profissao"             => $rsDados['profissao'],
                    "celular"               => $rsDados['celular']
                );
             }

             fecharConexaoMysql($conexao);

             return $arrayDados;
        }
    }
?>