<? $newData=date('Y/m/d', strtotime($obAluno->data_nascimento));?>

<main>
	
	
	<h2 class="mt-3">Excluir vaga</h2>
	<form method="post">
		<div class="form-group">
			<p>Você deseja excluir este registro <strong><?=$obAluno->nome_completo?>?</strong></p>
		</div>

      <br>
	    <div class="form-group">
	    	<a href="index.php">
			<button type="button" class="btn btn-success">
				Cancelar
			</button>
		</a>	
			<button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
		</div>
	</form>
</main>