<h1>Seja bem vindo!</h1>
<p>Este &eacute; o template inicial do php BKLG manager, se tudo estiver
funcionando corretamente voc&ecirc; j&aacute; pode come&ccedil;ar a inserir dados no seu backlog.
Para mais informa&ccedil;&otilde;es leia o arquivo de Documenta&ccedil;&atilde;o que est&aacute; nesta mesma pasta!</p>

<?php if(!empty($project)): ?>

<div id="project-field">
	<form action="backlog/project" method="post">
		<select name="project">
			<option value="" />
			<?php
				foreach($project as $row):
					$selected="";
					if(isset($backlog_id) && $row->id==$backlog_id) $selected=" selected='selected'";
					echo <<<HTML
						<option value='$row->id'$selected />$row->project_name</option>
HTML;
				endforeach;
			?>
		</select>
		<input type="submit" value="Abrir" />
	</form>
</div>

<div id="sbacklog">
	<a href="backlog/insert/sprint"><input type="button" value="Nova Sprint" id="bt-sprint" /></a>
	<?php
		if(!empty($sprint_backlog)){
			foreach($sprint_backlog as $sb){
				echo <<<HTML
					<h2>$sb->investment / $sb->return - <a href="#">$sb->title</a></h2>
HTML;
			}
		}
	?>
</div>

<?php else: //if project's select field is empty ?>

<div id="project-field">
	<form action="backlog/save/backlog" method="post">
		<label for="nome">Novo projeto:</label>
		<input type="text" name="name" />
		<input type="submit" value="Salvar" />
	</form>
</div>

<?php endif; ?>
