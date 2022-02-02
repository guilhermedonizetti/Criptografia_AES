<?php

class ConectorBD
{

    public function conectarBD()
    {
        try {
            $connection = new PDO("mysql:host=localhost;dbname=atividades", "root", "");
        }
        catch(PDOException) {
            $connection = null;
        }

        return $connection;
    }
    
}
