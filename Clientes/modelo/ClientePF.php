<?php

    require_once("Cliente.php");

    class ClientePF extends Cliente{


        private string $nome;
        private string $cpf;

        public function getIdentificacao(){
            return $this->nome;
        }
        public function getNroDoc(){
            return $this->cpf;
        }
        public function getTipo(){
            return "F";
        }

    
        //gets and sets


        /**
         * Get the value of nome
         */
        public function getNome(): string
        {
                return $this->nome;
        }

        /**
         * Set the value of nome
         */
        public function setNome(string $nome): self
        {
                $this->nome = $nome;

                return $this;
        }

        /**
         * Get the value of cpf
         */
        public function getCpf(): string
        {
                return $this->cpf;
        }

        /**
         * Set the value of cpf
         */
        public function setCpf(string $cpf): self
        {
                $this->cpf = $cpf;

                return $this;
        }
    }