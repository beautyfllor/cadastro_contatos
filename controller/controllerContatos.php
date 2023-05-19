<?php
    function inserirContato($dadosContato) {

        if(!empty($dadosContato)) {

            if(!empty($dadosContato['txtNome']) && !empty($dadosContato['txtEmail']) && !empty($dadosContato['txtDataNascimento']) && !empty($dadosContato['txtCelular'])) {

                $arrayDados = array(
                    "nome"                => $dadosContato['txtNome'],
                    "email"               => $dadosContato['txtEmail'],
                    "telefone"            => $dadosContato['txtTelefone'],
                    "data_nascimento"     => $dadosContato['txtDataNascimento'],
                    "profissao"           => $dadosContato['txtProfissao'],
                    "celular"             => $dadosContato['txtCelular']
                );

                require_once('model/bd/contato.php');

                if(insertContato($arrayDados))
                   return true;
                else
                print_r($arrayDados);
                    return array('idErro' => 1,
                                'message' => 'Não foi possível inserir os dados no Banco de Dados.'
                            );
            } else
                return array('idErro' => 2,
                            'message' => 'Existem campos obrigatórios que não foram preenchidos.'
                        );
        }
    }

    function atualizarContato($dadosContato, $id) {
    
        if(!empty($dadosContato)) {

            if(!empty($dadosContato['txtNome']) && !empty($dadosContato['txtEmail']) && !empty($dadosContato['txtDataNascimento']) && !empty($dadosContato['txtCelular'])) {

                if(!empty($id) && $id != 0 && is_numeric($id)) {


                    $arrayDados = array(
                        "id"                  => $id,
                        "nome"                => $dadosContato['txtNome'],
                        "email"               => $dadosContato['txtEmail'],
                        "telefone"            => $dadosContato['txtTelefone'],
                        "data_nascimento"     => $dadosContato['txtDataNascimento'],
                        "profissao"           => $dadosContato['txtProfissao'],
                        "celular"             => $dadosContato['txtCelular']
                    );

                    require_once('model/bd/contato.php');

                    if(updateContato($arrayDados))
                        return true;
                    else
                        return array('idErro' => 1,
                                    'message' => 'Não foi possível atualizar os dados no Banco de Dados.'
                                );
                } else
                    return array('idErro' => 3,
                                'message' => 'Não é possível editar um registro sem informar um id válido.'
                            );
            } else
                return array('idErro' => 2,
                            'message' => 'Existem campos obrigatórios que não foram preenchidos.'
                        );
        }
    }

    function excluirContato($id) {

        if(!empty($id) && $id != 0 && is_numeric($id)) {

            require_once('model/bd/contato.php');

            if(deleteContato($id))
                return true;
            else
                return array('idErro' => 1,
                            'message' => 'Não foi possível excluir o registro do Banco de Dados.'
                        );
        } else
            return array('idErro' => 3,
                        'message' => 'Não é possível excluir um registro sem informar um id válido.'
                    );
    }

    function listarContato() {

        require_once('model/bd/contato.php');

        $dados = selectAllContatos();

        if(!empty($dados))
            return $dados;
        else 
            return false;
    }

    function buscarContato ($id) {
        
        if($id != 0 && !empty($id) && is_numeric($id)) {

            require_once('model/bd/contato.php');

            $dados = selectByIdContato($id);

            if(!empty($dados))
                return $dados;
            else
                return false;
        } else
            return array('idErro' => 3,
                        'message' => 'Não é possível buscar um registro sem informar um id válido.'
                    );
    }
?>