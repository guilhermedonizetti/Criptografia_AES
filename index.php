<?php

include 'conexao_bd.php';
include 'gerar_chave.php';

class RegistrosCriptografados
{

    function __construct()
    {
        // Instanciar conexao com BD
        $conectar = new ConectorBD();
        $this->conn = $conectar->conectarBD();

        // Instanciar o gerador de chaves
        $this->chave = new ChaveCriptografia();
    }

    public function inserirUsuario()
    {
        // Variaveis
        $login = "meuemail@mail.com";
        $senha = "minhaSENHA17";
        $horas = date('Y-m-d H:i:s');
        $key = $this->chave->gerarChave();

        // Registra Usuario
        try {
            $SQL = "INSERT INTO usuario(login, senha, tms_cadastro) ";
            $SQL .= "VALUES( AES_encrypt(?, '".$key."'), AES_encrypt(?, '".$key."'), ?)";
            $stmt = $this->conn->prepare($SQL);

            $stmt->bindParam(1, $login);
            $stmt->bindParam(2, $senha);
            $stmt->bindParam(3, $horas);

            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    echo "Inserido com sucesso!";
                }
                else {
                    echo "Registro nao foi inserido.";
                    die();
                }
            }
        }
        catch(PDOException $e) {
            echo "Erro: " . $e;
            die();
        }

        // Registra Chave
        try {
            $id_user = $this->conn->lastInsertId();

            $SQL = "INSERT INTO chaves(chave, id_usuario, tms_cadastro) VALUES(?, ?, ?)";
            $stmt = $this->conn->prepare($SQL);

            $stmt->bindParam(1, $key);
            $stmt->bindParam(2, $id_user);
            $stmt->bindParam(3, $horas);

            if($stmt->execute()) {
                if($stmt->rowCount()) {
                    //
                }
                else {
                    echo "Chave nao registrada.";
                }
            }
        }
        catch(PDOException $e) {
            echo "Erro: " . $e;
        }
    }

    public function consultarUsuarios()
    {
        //
        try {
            $SQL = "SELECT AES_decrypt(Us.login, Ch.chave) as login, AES_decrypt(Us.senha, Ch.chave) as senha ";
            $SQL .= "FROM usuario Us INNER JOIN  chaves Ch ON Us.id = Ch.id_usuario";
            $stmt = $this->conn->prepare($SQL);
        
            if($stmt->execute()) {
                $row = $stmt->fetchAll();
        
                for($i = 0; $i < count($row); $i++) {
                    echo "Login: " . $row[$i]['login'] . ' / Senha: ' . $row[$i]['senha'];
                }
            }
        
        }
        catch(PDOException $e) {
            echo "Erro: " . $e;
        }
    }

}

$cripto = new RegistrosCriptografados();
$cripto->inserirUsuario();
$cripto->consultarUsuarios();
