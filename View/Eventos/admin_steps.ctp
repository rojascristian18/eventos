<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12 col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-xs-12">
						<h3>¿Desea continuar con la configuración del evento?</h3>
					</div>
					<div class="col-xs-12 col-sm-4">
						<?= $this->Html->link('Sí, vamos <i class="fa fa-step-forward"></i>', array('action' => 'steps', $id, 1), array('class' => 'btn btn-success btn-block', 'rel' => 'tooltip', 'title' => 'Continuar', 'escape' => false)); ?>
					</div>
					<div class="col-xs-12 col-sm-4">
						<?= $this->Html->link('Ups, volver a editar <i class="fa fa-edit"></i>', array('action' => 'edit', $id), array('class' => 'btn btn-default btn-block', 'rel' => 'tooltip', 'title' => 'Volver a editar', 'escape' => false)); ?>
					</div>
					<div class="col-xs-12 col-sm-4">
						<?= $this->Html->link('Luego, volver al inicio <i class="fa fa-undo"></i>', array('action' => 'index'), array('class' => 'btn btn-default btn-block', 'rel' => 'tooltip', 'title' => 'Volver', 'escape' => false)); ?>
					</div>
				</div>
			</div>
		</div> <!-- end col -->
	</div> <!-- end row -->
</div>
