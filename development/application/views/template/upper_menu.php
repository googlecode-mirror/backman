<div id="menu">
	<label for="title">Backman 1.2</label>
	<ul>
		<?php foreach($menu as $m) echo "<li><a href='".$m->url."'>".$m->title."</a></li>"; ?>
		<li><a href="autentica/logoff">Sair</a></li>
	</ul>
</div>