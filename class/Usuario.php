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

			$linha = $resultado[0];

			$this->setIdusuario($linha['idusuario']);
			$this->setDeslogin($linha['deslogin']);
			$this->setDessenha($linha['dessenha']);
			$this->setDtCadstro(new DateTime($linha['dt_cadastro']));

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

			$linha = $resultado[0];

			$this->setIdusuario($linha['idusuario']);
			$this->setDeslogin($linha['deslogin']);
			$this->setDessenha($linha['dessenha']);
			$this->setDtCadstro(new DateTime($linha['dt_cadastro']));
		}else{
			
			throw new Exception("Login ou senha inválido", 1);
			
		}

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