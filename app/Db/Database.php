<?php 
  namespace App\Db;
  use \PDO;
  use \PDOException;

class DataBase{
	/**
	*host do banco
	* @var string
	*/	
    const HOST='localhost';
    /**
	*nome banco de dados
	* @var string
	*/
    const NAME='alunos_projeto';
    /**
	*usuario do banco dados
	* @var string
	*/
    const USER='root';
    /**
	*Senha banco de dados
	* @var string
	*/
    const PASS='';

    //qual tabela irá ser manipulada
    private $table;
     /**
	*instancia de conexão com o banco de dados
	* @var PDO
	*/
    private $connection;

    /**
	*instancia de conexão com o banco de dados
	* @param string $table
	*/
   public function __construct($table = null){
    $this->table = $table;
    $this->setConnection();
  }

  /**
   * Método responsável por criar uma conexão com o banco de dados
   */
    private function setConnection(){
    try{
      $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      die('ERROR: '.$e->getMessage());
    }
  }

//metodo responsavel por executar as querie no banco de dados
  public function execute($query,$params=[]){
  	try{
  		$statement=$this->connection->prepare($query);
  		$statement->execute($params);
  		return $statement;
  	}catch(PDOException $e){
      die('ERROR: '.$e->getMessage());
    }
  }

  public function insert($values){
  	//dados da query
  	$fields = array_keys($values);
  	$binds = array_pad([],count($fields),'?');

  
  	//query
  	$query='INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',',$binds).')';

  	//executa o insert
  	$this->execute($query,array_values($values));

  	//retorna o id inserido
  	return $this->connection->lastInsertId();
  }

   public function select($where = null, $order = null, $limit = null, $fields = '*'){
    //DADOS DA QUERY
    $where = strlen($where) ? 'WHERE '.$where : '';
    $order = strlen($order) ? 'ORDER BY '.$order : '';
    $limit = strlen($limit) ? 'LIMIT '.$limit : '';

    //MONTA A QUERY
    $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

    //EXECUTA A QUERY
    return $this->execute($query);
  }

  public function selectOrderByAge($order='TIMESTAMPDIFF(YEAR, data_nascimento,NOW())',$fields='*,TIMESTAMPDIFF(YEAR, data_nascimento,NOW()) as idade'){

  	//monta a query
  	$query='Select '.$fields.' from '.$this->table.' ORDER BY '.$order;

  	//executa a query
  	return $this->execute($query);
  }

   public function update($where,$values){
    //DADOS DA QUERY
    $fields = array_keys($values);

    //MONTA A QUERY
    $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

    //EXECUTAR A QUERY
    $this->execute($query,array_values($values));

    //RETORNA SUCESSO
    return true;
  }

   public function delete($where){
    //MONTA A QUERY
    $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

    //EXECUTA A QUERY
    $this->execute($query);

    //RETORNA SUCESSO
    return true;
  }

}
 ?>