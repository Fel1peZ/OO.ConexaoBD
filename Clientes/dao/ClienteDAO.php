<?php

require_once("modelo/Cliente.php");
require_once("modelo/ClientePF.php");
require_once("modelo/ClientePJ.php");
require_once("util/Conexao.php");
    class ClienteDAO{

        public function inserirCliente(Cliente $cliente){


            $sql = "INSERT INTO clientes 
                            (tipo, nome_social, email, nome, cpf, razao_social, cnpj)
                            VALUES
                            (?, ?, ?, ?, ?, ?, ?)";

            $con = Conexao::getCon();

            $stm = $con->prepare($sql);
            if($cliente instanceof ClientePF) {

            
            $stm->execute(array($cliente->getTipo(),
                                $cliente->getNomeSocial(),
                                $cliente->getEmail(),
                                $cliente->getNome(),
                                $cliente->getCpf(),
                                null,
                                null));

            } else if($cliente instanceof ClientePJ) {
                $stm->execute(array($cliente->getTipo(),
                                    $cliente->getNomeSocial(),
                                    $cliente->getEmail(),
                                    null,
                                    null,
                                    $cliente->getRazaoSocial(),
                                    $cliente->getCnpj()
            ));
            }

            
        }
        public function listarClientes(){
            $sql = "SELECT * FROM clientes";

            $con = Conexao::getCon();

            $stm = $con->prepare($sql);
            $stm->execute();
            $registros = $stm->fetchAll();

            $clientes = $this->mapCliente($registros);
            return $clientes;
        }

        public function buscarPorId(int $idCliente){
            $con = Conexao::getCon();

            $sql = "SELECT * FROM clientes WHERE id = ?";

            $stm = $con->prepare($sql);
            $stm->execute([$idCliente]);

            $registros = $stm->fetchAll();

            $clientes = $this->mapCliente($registros);
            if(count($clientes) > 0)
                return $clientes[0];
            else
                return null;
        

        }

        public function removerClientes(int $idCliente){
            $sql = " DELETE  FROM clientes  WHERE id = ?";

            $con = Conexao::getCon();

            $stm = $con->prepare($sql);
            $stm->execute([$idCliente]);

            $registros = $stm->fetchAll();

            $clientes = $this->mapCliente($registros);
            if(count($clientes) > 0)
                return $clientes[0];
            else
                return null;


        }

        private function mapCliente(array $registros){
            $clientes = array();
            foreach($registros as $reg){
                $cliente = null;
                if($reg['tipo']== 'F'){
                    $cliente = new ClientePF();
                    $cliente->setNome($reg['nome']);
                    $cliente->setCpf($reg['cpf']);
                }else{
                    $cliente = new ClientePJ();
                    $cliente->setRazaoSocial($reg['razao_social']);
                    $cliente->setCnpj($reg['cnpj']);
                };
                $cliente->setId($reg['id']);
                $cliente->setNomeSocial($reg['nome_social']);
                $cliente->setEmail($reg['email']);
                array_push($clientes, $cliente);
            };
            return $clientes;
        }
    }