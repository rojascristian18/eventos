var limit 	= 10,
	offset 	= 0,
	request = true;

$.extend({
	app: {
		productos: {
			obtenerProductos: function(limite, salto){
				request = false;
				$.get( webroot + 'eventos/ajax_get_products/' + limite + '/' + salto, function(respuesta){
					
					$('#products').append(respuesta);

					offset = offset + 5;
					request = true;
		      	})
		      	.fail(function(){

				});
			},
			bind: function(){
				// Carga inicial
				$.app.productos.obtenerProductos(limit, offset);

				$(window).on('scroll', function(){
					var y = $(this).scrollTop() + 210,
						limitScroll = $('#products > .product').last().offset().top;
					
					if (y > limitScroll && request == true) {
						$.app.productos.obtenerProductos(limit, offset);
					}
				});
			},
			init: function(){
				if ($('#products').length) {
					console.info('Productos');
					$.app.productos.bind();
				}
			}
		},
		init: function() {
			$.app.productos.init();
		}
	}
});

$(document).ready(function(){
	$.app.init();
});