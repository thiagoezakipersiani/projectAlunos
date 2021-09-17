
<main>
	<section>
		<a href="index.php">
			<button class="btn btn-success">
				Voltar
			</button>
		</a>	
	</section>
	
	<h2 class="mt-3"><?=TITLE?></h2>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nome completo</label>
			<input type="text" class="form-control" name="nome_completo" 
			value="<?=$obAluno->nome_completo?>">
		</div>

		<div class="form-group">
			<label>Endereco</label>
			<textarea class="form-control" name="endereco"><?=$obAluno->endereco?></textarea>
		</div>

		<div class="form-group">
			<label>Data nascimento</label>
			<input type="date" class="form-control" name="data_nascimento"
			value="<? echo '($obAluno->data_nascimento)'?>">		
		</div>
		<div class="form-group">
			<label>Renda familiar</label>
			<input type="number" class="form-control" name="renda_familiar"
			value="<?=$obAluno->renda_familiar?>">
		</div>
		<br>

    	<div>
    		<label>Escolha uma foto de perfil</label><br><br>
            <input type="file" name="arquivo">
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        </div>    
      <br>
	    <div class="form-group">
			<button type="submit" class="btn btn-success">Enviar</button>
		</div>
	</form>
</main>