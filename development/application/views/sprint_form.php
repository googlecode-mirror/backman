<form method="post" id="sprint_form" action="backlog/insert/sprint">
	<ul class="line">
		<li class="title">Título: </li>
		<li class="field"><input type="text" name="title" /></li>
	</ul>
	<input type="hidden" name="product_backlog_id" value="<?php echo $backlog_id; ?>" />
	<input type="submit" value="Salvar" />
</form>