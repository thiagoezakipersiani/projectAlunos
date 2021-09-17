<?php 

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Aluno{
	/**
	* identificador
	* @var integer
	*/
	public $id;

	/**
	*nome completo
	* @var string
	*/	
	public $nome_completo;

	/**
	* endereco
	* @var string
	*/
	public $endereco;

	/**
	* data nascimento
	* @var string
	*/
	public $data_nascimento;

    /**
	* data nascimento
	* @var int
	*/
	public $renda_familiar;
	/**
	* url upload perfil
	* @var varchar
	*/
	public $arquivo;



	public function cadastrar($DIR){
		//CONFIGURANDO O CAMINHO DA IMAGEM
			try {
					$upload=$_FILES['arquivo'];

				    $ext = pathinfo($upload['name']);
					$nome_imagem = $this->nome_completo.'.'.$ext['extension'];
					//NÃO ESQUECER DE SETAR PERMIÇÃO NAS PASTA QUE IRÁ RECEBER O UPLOAD.   
					$caminho_imagem = $DIR .'/'. $nome_imagem;
					move_uploaded_file($upload['tmp_name'], $caminho_imagem);
					$this->arquivo=$caminho_imagem;
					//CADASTRANDO AS INFORMAÇÕES
		            $obDatabase = new Database('alunos');
                    $this->id = $obDatabase->insert([
			        'nome_completo' => $this->nome_completo,
			        'endereco' => $this->endereco,
			        'renda_familiar' => $this->renda_familiar,
			        'data_nascimento'=> $this->data_nascimento,
			        'arquivo' => $this->arquivo
		            ]);
	                //retorna com sucesso
	                return true;
			} catch (PDOException $ex) {
				echo '<script type="text/javascript">alert("Error: '.$ex->getMessage().'");</script>';
			}
			    	
	}

	public function atualizar($DIR){
		            $upload=$_FILES['arquivo'];

				    $ext = pathinfo($upload['name']);
					$nome_imagem = $this->nome_completo.'.'.$ext['extension'];
					//NÃO ESQUECER DE SETAR PERMIÇÃO NAS PASTA QUE IRÁ RECEBER O UPLOAD.   
					$caminho_imagem = $DIR .'/'. $nome_imagem;
					move_uploaded_file($upload['tmp_name'], $caminho_imagem);
					$this->arquivo=$caminho_imagem;
					//CADASTRANDO AS INFORMAÇÕES
		            return (new Database('alunos'))
		            ->update('id=' .$this->id,[
			                   'nome_completo' => $this->nome_completo,
			                   'endereco' => $this->endereco,
			                   'renda_familiar' => $this->renda_familiar,
			                   'data_nascimento'=> $this->data_nascimento,
			                   'arquivo' => $this->arquivo
		       ]);
	}

	//metodo responsavel por excluir o aluno do banco, retorna boolean
	public function excluir(){
		return (new Database('alunos'))->delete('id=' .$this->id);
	}

	//metodo que realiza a consulta e traz os dados dos alunos do banco de dados
	public static function getAlunos($where=null,$order=null,$limit=null){
		return (new Database('alunos'))->select($where,$order,$limit)
		                               ->fetchAll(PDO::FETCH_CLASS,self::class);
	}

	//metodo responsavel por buscar um aluno com base no ID
	 public static function getAluno($id){
    return (new Database('alunos'))->select('id='.$id)
                                  ->fetchObject(self::class);
  }


   public static function getAlunosPorIdaide(){
    return (new Database('alunos'))->selectOrderByAge()
		                           ->fetchAll(PDO::FETCH_CLASS,self::class);
  }
}

 ?>