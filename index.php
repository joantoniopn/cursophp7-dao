<?php

require_once("config.php");

//$sql = new Sql();
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);

//Carrega um usuário
//$root = new Usuario();
//root->loadbyId(3);
//echo $root;

//Carrega uma lista de usuários
$lista = Usuario::getList();
echo json_encode($lista);

//Carrega uma lista pesquisando pelo login
//$busca = Usuario::search("ro");
//echo json_encode($busca);


//Carrega o usuário utilizando o login e senha
//$usuario = new Usuario();
//$usuario->login("john", "Passteste");
//echo $usuario;

//Inserindo um novo usuário
//$aluno = new Usuario("aluno1", "@lun0");
//$aluno->insert();
//echo $aluno;

//Update usuario pelo id
//$usuario = new Usuario();
//$usuario->loadbyId(8);
//$usuario->update("professor", "65422");
//echo $usuario;
?>