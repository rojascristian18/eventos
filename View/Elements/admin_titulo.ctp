<div class="page-title">
	<? if (empty($titulo)) : ?>
		<h2><span class="fa fa-list"></span> <?=Inflector::humanize($this->request->params['controller']);?></h2>	
	<? else : ?>
		<h2><span class="<?=$titulo['icono']; ?>"></span> <?=$titulo['nombre']; ?></h2>	
	<? endif; ?>
</div>