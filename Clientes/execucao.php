<?php
require_once("modelo/Cliente.php");
require_once("modelo/ClientePF.php");
require_once("modelo/ClientePJ.php");
require_once("dao/ClienteDAO.php");
//teste da conexao

/*require_once("util/Conexao.php");
$con = Conexao::getCon();
print_r($con);*/

do {


    echo "\n----------CADASTRO DE CLIENTES-----\n";
    echo "1- Cadastrar Cliente PF\n";
    echo "2- Cadastrar Cliente PJ\n";
    echo "3- Listar Clientes \n";
    echo "4- Buscar Cliente \n";
    echo "5- Excluir Cliente\n";
    echo "0- Sair\n";

    $opcao = readline("Informe a opção: ");
    switch ($opcao) {

        case 1:
            $cliente = new ClientePF();
            $cliente->setNome(readline("Informe o nome: "));
            $cliente->setNomeSocial(readline("Informe o nome social: "));
            $cliente->setCpf(readline("Informe o CPF: "));
            $cliente->setEmail(readline("Informe o email:"));

            //Chamar o metodo do DAO para persistir o objeto
            $clienteDAO = new ClienteDAO;
            $clienteDAO->inserirCliente($cliente);

            echo "Cliente PF cadastrado com sucesso!\n\n";
            break;
        case 2:
            $cliente = new ClientePJ();
            $cliente->setRazaoSocial(readline("Informe a Razão social:"));
            $cliente->setNomeSocial(readline("Informe o nome social: "));
            $cliente->setCnpj(readline("Informe o CNPJ: "));
            $cliente->setEmail(readline("Informe o email:"));

            $clienteDAO = new ClienteDAO;
            $clienteDAO->inserirCliente($cliente);
            echo "Cliente PJ cadastrado com sucesso!\n\n";
            break;
        case 3:
            //Buscar os objetos no banco de dados
            $clienteDAO = new ClienteDAO();
            $clientes = $clienteDAO->listarClientes();

            foreach($clientes as $c){
                /*
                printf("%d- %s | %s | %s | %s | %s\n",
                    $c->getId(), $c->getTipo(),$c->getNomeSocial(),
                    $c->getIdentificacao(), $c->getNroDoc(),
                    $c->getEmail());


                    */
            }


            break;
        case 4:
            //Buscar um cliente pelo seu ID

            //1- Ler o ID
            $id = readline("Informe o ID do cliente: ");

            //2- Chamar o metodo que retorna o objeto cliente do banco de dados
            $clienteDAO = new ClienteDAO();
            $cliente = $clienteDAO->buscarPorId($id);

            if($cliente != null)
                echo $cliente;
            else
                echo "Cliente não encontrado\n";
           
            break;
        case 5:
            //EXCLUSAO PELO ID DO CLIENTE

            //1-Listar os clientes

            //2-Solicitar o ID

            //3-Chamar o cliente DAO para remover a base de dados

            //4-Informar q o cliente foi excluído
            break;
        case 0:
            echo"Encerrando o programa";
            break;
    }
} while ($opcao != 0);
