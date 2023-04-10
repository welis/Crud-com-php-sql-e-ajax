<?php

class Conexao {
    private $host = 'localhost';
    private $user = 'root';
    private  $password = '1263';
    private $dbname = 'crud_client';

    public function conectar() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname";
            $conexao = new PDO($dsn, $this->user, $this->password);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexao;
          } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
          }
    }
}

?>