<?php

class Usuario{
    private $pdo;
    public $msgErro = "";

    public function __construct($nome, $host,$usuario,$senha){
        try{
            $this->pdo = new pdo("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);

        }catch (PDOException $e){
            $msgErro=$e -> getMessage();
        }   
    }

    public function cadastrar($nome, $telefone,$email,$senha,$genero,$dt_nascimento){
        //verificar cadastro existente
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount()> 0) 
        {
            return false; //ja esta cadastrado
        }
        else
        {
            //caso nao cadastrado
            $sql = $this->pdo->prepare("INSERT INTO usuarios (nome,telefone,email,senha,id_genero, dt_nascimento) VALUES (:n, :t, :e, :s,:g, :dtn)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":g",$genero);
            $sql->bindValue(":s",$senha);
            $sql->bindValue(":dtn",$dt_nascimento);

            $sql->execute();
            

            return true; //tudo ok

        }


    }

    public function ultimoInsert(){
        $LAST_ID = $this->pdo->lastInsertId();

        return $LAST_ID;
    }
    
    public function logar($email,$senha){
        
        //verificar se o email e senha estao cadastrados, se sim
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",$senha);
        $sql->execute();

        if($sql->rowCount()> 0)
        {
            //entrar no sistema (sessao)
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; //cadastrado com sucesso
        }
        else
        {
            return false;//nao foi possivel logar
        }

    }

    public function buscaInteresse(){
        $res = array();
        $sql = $this->pdo->query("SELECT * FROM interesses");
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $res;

    }

    public function insereInteresse($interesse, $usuario){

        $sql = $this->pdo->prepare("INSERT INTO interesseusuario (id_interesse, id_usuario) VALUES (:i, :u)");

            $sql->bindValue(":i", $interesse);
            $sql->bindValue(":u", $usuario);
            $sql->execute();

            return true;
    }


    public function insereFoto ($image, $usuario){

        $sql = $this->pdo->prepare("INSERT INTO fotos(foto, id_usuario) VALUES (:f, :u)");

        $sql->bindValue(":f", $image);
        $sql->bindValue(":u", $usuario);
        $sql->execute();

        return true;
    }

    public function buscaDados($id){

        $sql = $this->pdo->prepare("SELECT *  FROM usuarios WHERE id_usuario = :id");

        $sql->bindValue(":id", $id);
        $sql->execute();

        $res = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function calculaData($id){
        $sql = $this->pdo->prepare("SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(now(), dt_nascimento)), '%Y') +0 AS Age from usuarios where id_usuario = :id LIMIT 1");

        $sql->bindValue(":id", $id);
        $sql->execute();

        $res = $sql->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function mostraInteresse($id){

        $sql = $this->pdo->prepare("SELECT usuarios.id_usuario,interesse FROM usuarios 
        INNER JOIN interesseusuario 
        ON usuarios.id_usuario = interesseusuario.id_usuario
        INNER JOIN interesses
        ON interesses.id_interesse = interesseusuario.id_interesse
        group by interesse, usuarios.id_usuario
        having id_usuario = :id");

        $sql->bindValue(":id", $id);
        $sql->execute();

        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }



}
?>