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
    public function cadastrar($nome, $telefone,$email,$senha,$genero,$interesse){
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
            $sql = $this->pdo->prepare("INSERT INTO usuarios (nome,telefone,email,senha,id_genero) VALUES (:n, :t, :e, :s,:g,:i)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":g",$genero);
            $sql->bindValue(":s",$senha);
            $sql->execute();
            return true; //tudo ok

        }

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
}
?>