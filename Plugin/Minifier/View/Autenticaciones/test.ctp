<?= $this->Form->create('Test', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
	<?= $this->Form->input('imagen', array('type' => 'file'))?>
	<?= $this->Form->input('imagen', array('type' => 'text'))?>
		<input type="submit" value="generar">
<?= $this->Form->end(); ?>


