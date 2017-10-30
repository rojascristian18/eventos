<? if ( $flash = $this->Session->flash('flash') ) : ?>
<div class="modal animated fadeIn flash" id="modal_alertas" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <p><?= $flash; ?></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$('.modal').modal('show');

	setTimeout(function(){
		$('.modal').modal('hide');		
	}, 3500);	
</script>
<? endif; ?>

<? if ( $danger = $this->Session->flash('danger') ) : ?>
<div class="modal animated fadeIn danger" id="modal_alertas" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <p><?= $danger; ?></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$('.modal').modal('show');

	setTimeout(function(){
		$('.modal').modal('hide');		
	}, 3500);	
</script>
<? endif; ?>

<? if ( $success = $this->Session->flash('success') ) : ?>
<div class="modal animated fadeIn success" id="modal_alertas" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <p><?= $success; ?></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$('.modal').modal('show');

	setTimeout(function(){
		$('.modal').modal('hide');		
	}, 3500);	
</script>
<? endif; ?>




