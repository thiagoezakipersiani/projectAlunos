<?php 

$mensagem = '';
  if(isset($_GET['status'])){
    switch ($_GET['status']) {
      case 'success':
        $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
        break;

      case 'error':
        $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
        break;
    }
  }


 $resultados='';

foreach ($alunos as $aluno) {
	$resultados .=' <tr>
	                  <td>'.$aluno->id.'</td>
	                  <td>'.$aluno->nome_completo.'</td>
	                  <td>'.date('d/m/Y', strtotime($aluno->data_nascimento)).'</td>
	                  <td>'.$aluno->endereco.'</td>
	                  <td>'.$aluno->renda_familiar.'</td>
	                  <td>
	                  	<a href="editar.php?id='.$aluno->id.'">
	                  	<button type="button" class="btn btn-primary">Editar</button>
	                  	</a>
	                  	<a href="excluir.php?id='.$aluno->id.'">
	                  	<button type="button" class="btn btn-danger">Excluir</button>
	                  	</a>
	                  </td>
	                </tr>';
 }

   $resultados = strlen($resultados) ? $resultados : '<tr>
                                                       <td colspan="6" class="text-center">
                                                              Nenhum aluno encontrado
                                                       </td>
                                                    </tr>';
?>
<main>
	<?=$mensagem?>

	<section>
		<a href="cadastrar.php">
			<button class="btn btn-success">
				Novo Aluno
			</button>
		</a>	
	</section>

	<section>
		<table class="table bg-light mt-3">
			<thead>
				<tr>
					<th>Id</th>
					<th>Nome Completo</th>
					<th>Data Nascimento</th>
					<th>Endereco</th>
					<th>Renda Familiar</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?=$resultados?>
			</tbody>
		</table>
	</section>

	<section>
		<a href="exibir_pdf.php">
			<button class="btn btn-success">
				Relatório em PDF por idade
			</button>
		</a>	
	</section>


</main>