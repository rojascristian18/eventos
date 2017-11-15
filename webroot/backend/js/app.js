/**
 * JS del Sitio
 */
(function($) {

	var b, a;

	$.extend({
		app:{
			plugins: {
				select: {
					bind: function() {

		                $(".select").selectpicker();

		                $(".select").on("change", function(){
		                    if($(this).val() == "" || null === $(this).val()){
		                        if(!$(this).attr("multiple"))
		                            $(this).val("").find("option").removeAttr("selected").prop("selected",false);
		                    }else{
		                        $(this).find("option[value="+$(this).val()+"]").attr("selected",true);
		                    }
		                });
					},
					init: function() {
						if($(".select").length){
							$.app.plugins.select.bind();
						}
					}
				},
				nestable: {
					bind: function(){
						$('#nestable').nestable({maxDepth: 2});

						$('#nestable').on('change',function(e){
							var list = e.length ? e : $(e.target),
							output = $('#nestable-output');
							if (window.JSON) {
								var obj = window.JSON.stringify(list.nestable('serialize')),
									url = webroot + 'categorias/actualizar_orden_categorias/';

								$.ajax({
								    type: "POST",
								    url: url,
								    data: { data: obj},
								    dataType: "html",
								    success: function(data) {
								    	if (data == 'ok') {
								    		noty({text: 'Orden actualizado con éxito.', layout: 'topRight', type: 'success'});
								    	}

								    	if (data == 'error') {
								    		noty({text: 'Error al ordenar las categorías. Intente nuevamente.', layout: 'topRight', type: 'error'});
								    	}

							
								    },
								    error: function() {
								        noty({text: 'Error al procesar la inforamción. Intente nuevamente.', layout: 'topRight', type: 'error'});
								    }
								});

							} else {
								output.val('El navegador no soporta esta opción.');
							}
						});
					},
					init: function(){
						if ( $('.dd').length ) {
							$.app.plugins.nestable.bind();
						};
					}
				},
				clone: {
					reIndexar: function() {
						var $contenedor			= $('.js-clon-contenedor');

						$contenedor.find('tr:visible').each(function(index)
						{
							$(this).find('input, select, textarea').each(function()
							{
								var $that		= $(this),
									nombre		= $that.attr('name').replace(/[(\d)]/g, (index + 1));

								$that.attr('name', nombre);
							});
						});
					},
					quitarSimple: function(){
						$(document).on('click', '.js-clon-eliminar', function(evento)
						{
							evento.preventDefault();

							var $this				= $(this),
								$tr					= $this.parents('tr').first();
								
							$tr.remove();

							/**
							 * Reindexa
							 */
							$.app.plugins.clone.reIndexar();
						});
					},
					quitarMarcas: function(){
						$(document).on('click', '.js-clon-eliminar-marcas', function(evento)
						{
							evento.preventDefault();

							var $this				= $(this),
								$tr					= $this.parents('tr').first(),
								$inputHide 			= $this.parents('tr').first().find('.id_evento_marca'),
								inputEliminadosVal 	= $('#ElementosEliminadosMarcas').val();
						
							// Lo agegamos al input de elementos eliminados separados por coma(,)
							if ( inputEliminadosVal != "" ) inputEliminadosVal += ",";

							inputEliminadosVal += $inputHide.val();

							console.info('Inputs eliminados: ' + inputEliminadosVal);
							$('#ElementosEliminadosMarcas').val(inputEliminadosVal);
								
							$tr.remove();

							/**
							 * Reindexa
							 */
							$.app.plugins.clone.reIndexar();
						});
					},
					quitarCategorias: function(){
						$(document).on('click', '.js-clon-eliminar-categoria', function(evento)
						{
							evento.preventDefault();

							var $this				= $(this),
								$tr					= $this.parents('tr').first(),
								$inputHide 			= $this.parents('tr').first().find('.id_evento_categoria'),
								inputEliminadosVal 	= $('#ElementosEliminadosCategorias').val();
						
							// Lo agegamos al input de elementos eliminados separados por coma(,)
							if ( inputEliminadosVal != "" ) inputEliminadosVal += ",";

							inputEliminadosVal += $inputHide.val();

							console.info('Inputs eliminados: ' + inputEliminadosVal);
							$('#ElementosEliminadosCategorias').val(inputEliminadosVal);
								
							$tr.remove();

							/**
							 * Reindexa
							 */
							$.app.plugins.clone.reIndexar();
						});
					},
					agregar: function() {
						$('.js-clon-agregar').on('click', function(evento, data)
						{
							evento.preventDefault();

							var $this			= $(this),
								$scope			= $this.parents('.js-clon-scope').first(),
								$base			= $('.js-clon-base', $scope),
								$contenedor		= $('.js-clon-contenedor', $scope),
								$clon			= $base.clone(),
								$tr;

							/**
							 * Hace visible al elemento clonado y quita los atributos de deshabilitado
							 */
							$clon.removeClass('hidden js-clon-base');
							$clon.find('input, select, textarea, button').each(function()
							{
								$(this).removeAttr('disabled');
							});

							/**
							 * Si es accion clonar, copia los datos y escribe la fila bajo la seleccionada
							 */
							if ( typeof(data) === 'object' && typeof(data.clone) !== 'undefined' )
							{
								$tr			= $(data.element).parents('tr').first();
								$tr.find('input, select, textarea').each(function(index)
								{
									$clon.find('input, select, textarea').eq(index).val($(this).val());
								});
								$tr.after($clon.show());
							}

							/**
							 * Si es accion agregar, agrega la fila al final de la tabla
							 */
							else
							{
								$contenedor.append($clon.show());
							}

							/**
							 * Reindexa
							 */
							$.app.plugins.clone.reIndexar();
						});
					},
					clonar: function() {
						/**
						 * Clonar
						 */
						$('.js-clon-contenedor').on('click', '.js-clon-clonar', function(evento)
						{
							evento.preventDefault();
							var $scope			= $(this).parents('.js-clon-scope').first();
							$('.js-clon-agregar', $scope).trigger('click', { clone: true, element: this });
						});
					},
					init: function(){
						if ( $('.js-clon-scope').length ) {
							$.app.plugins.clone.agregar();
							$.app.plugins.clone.clonar();
							$.app.plugins.clone.quitarSimple();
							$.app.plugins.clone.quitarMarcas();
							$.app.plugins.clone.quitarCategorias();
						}
					}
				},
				init: function(){
					$.app.plugins.clone.init();
					$.app.plugins.nestable.init();
					$.app.plugins.select.init();
				}

			},
			limpiarCache: {
				bind: function(){
					$('#clear_cache').on('click', function(){
						$.get( webroot + 'eventos/clear_cache', function(respuesta){
							console.log(respuesta);
				      	})
				      	.fail(function(){

							noty({text: 'Ocurrió un error. Intente nuevamente.', layout: 'topRight', type: 'error'});

							setTimeout(function(){
								$.noty.closeAll();
							}, 10000);
						});
					});
				},
				init: function(){
					if ($('#clear_cache').length) {
						$.app.limpiarCache.bind();
					}
				}
			},
			buscarProductos: {
				bind: function() {
					var todo = '';

					$('.input-productos-buscar').each(function(){
						var $esto 	= $(this);
						
						$esto.autocomplete({
						   	source: function(request, response) {
						      	$.get( webroot + 'eventos/obtener_productos/' + request.term, function(respuesta){
									response( $.parseJSON(respuesta) );
						      	})
						      	.fail(function(){

									noty({text: 'Ocurrió un error al obtener la información. Intente nuevamente.', layout: 'topRight', type: 'error'});

									setTimeout(function(){
										$.noty.closeAll();
									}, 10000);
								});
						    },
						    select: function( event, ui ) {
						        console.log("Seleccionado: " + ui.item.value + " id " + ui.item.id);
						        todo = ui.item.todo;
						        console.log(todo);
						    },
						    open: function(event, ui) {
			                    var autocomplete = $(".ui-autocomplete:visible");
			                    var oldTop = autocomplete.offset().top;
			                    var width  = $esto.width();
			                    var newTop = oldTop - $esto.height() + 25;

			                    autocomplete.css("top", newTop);
			                    autocomplete.css("width", width);
			                    autocomplete.css("position", 'absolute');
			                }
						});
					});

					// Botón agregar producto a la lista
					$('.button-productos-buscar').on('click', function(event) {
						event.preventDefault();

						$('#tablaProductos tbody').append(todo);
						$('.input-productos-buscar').val('');
					});

					// Botón quitar elemento de la lista
					$(document).on('click', '.quitar', function(event){
						event.preventDefault();
						$(this).parents('tr').eq(0).remove();
					});
					
				},
				init: function() {
					if ($('.input-productos-buscar').length) {
						$.app.buscarProductos.bind();
					}
				}
			},
			init: function() {
				$.app.buscarProductos.init();
				$.app.limpiarCache.init();
				$.app.plugins.init();
			}
		}
	});

	$(document).ready(function(){
		$.app.init();
	});

})( jQuery );