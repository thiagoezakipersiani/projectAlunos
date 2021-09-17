<?php 

	 require __DIR__ .'/vendor/autoload.php'; 

	 define('TITLE','Cadastrar aluno');

	 use \App\Entity\Aluno;

	 //echo "<pre>"; print_r($_FILES); echo "</pre>"; exit;  

	 $obAluno= new Aluno;
	 

	if(isset($_POST['nome_completo'],$_POST['endereco'],$_POST['data_nascimento'],$_POST['renda_familiar'])){
		    $obAluno-> nome_completo=$_POST['nome_completo'];
		    $obAluno-> endereco=$_POST['endereco'];
            $obAluno-> data_nascimento=$_POST['data_nascimento'];
            $obAluno-> renda_familiar=$_POST['renda_familiar'];
             // testa a informações do file echo "<pre>"; print_r($_FILES); echo "</pre>"; exit;  
            //echo "<pre>"; print_r($_POST); echo "</pre>"; exit;  
            $DIR=__DIR__ .'/uploads/imagens';
            
            $obAluno-> cadastrar($DIR);
			
            header('location: index.php?status=success');
            exit;
       }

	 include __DIR__.'/includes/header.php';
	 include __DIR__.'/includes/formulario.php';
	 include __DIR__.'/includes/footer.php';
 ?>
