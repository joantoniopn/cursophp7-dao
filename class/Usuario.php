<?php

class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($valor){
		return $this->idusuario = $valor;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($valor){
		return $this->deslogin = $valor;
	}
	
	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($valor){
		return $this->dessenha = $valor;
	}

	public function getDtCadastro(){
		return $this->dtcadastro;
	}

	public function setDtCadstro($valor){
		return $this->dtcadastro = $valor;
	}

	public function loadById($id){

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id

		));

		if(count($resultado) > 0){

			$this->setData($resultado[0]);

		}

	}

	public static function getList(){
		$sql = new Sql();
		
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));
	}

	public function login($login, $senha){

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$senha
		));

		if(count($resultado) > 0){

			$this->setData($resultado[0]);

		}else{

			throw new Exception("Login ou senha inválido", 1);
			
		}

	}

	public function setData($dados){

		$this->setIdusuario($dados['idusuario']);
		$this->setDeslogin($dados['deslogin']);
		$this->setDessenha($dados['dessenha']);
		$this->setDtCadstro(new DateTime($dados['dt_cadastro']));

	}

	public function insert(){
		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		if(count($results > 0)){
			$this->setData($results[0]);
		}
	}

	public function update($login, $senha){

		$this->setDeslogin($login);
		$this->setDessenha($senha);

		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario(),
		));
	}

	public function delete(){
		$sql = new Sql();
		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			':ID' => $this->getIdusuario()
		));
		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtCadstro(new DateTime());

	}

	public function __construct($login = "", $senha = ""){
		$this->setDeslogin($login);
		$this->setDessenha($senha);

	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
		));
	}
}



?>