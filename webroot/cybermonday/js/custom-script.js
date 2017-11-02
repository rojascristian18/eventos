var limit 	= 10,
	offset 	= 0,
	request = true;

$.extend({
	app: {
		select: {
			bind: function(){
				$('select').material_select();
			},
			init: function(){
				if ($('select').length) {
					$.app.select.bind();
				}
			}
		},
		filtro: {
			agregarParametrosUrl: function(search, key, val){

			var newParam = key + '=' + val,
				params = '?' + newParam;

			// If the "search" string exists, then build params from it
			if (search) {
				// Try to replace an existance instance
				params = search.replace(new RegExp('([?&])' + key + '[^&]*'), '$1' + newParam);

				// If nothing was replaced, then add the new param to the end
				if (params === search) {
					params += '&' + newParam;
				}
			}
			console.log(params);
			return params;
			},
			parametros: function(){
				var vars = {};
			    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,    
			    function(m,key,value) {
			      vars[key] = value;
			    });
			    return vars;
			},
			bind: function(){

			},
			init: function(){
				if ($('#filtro').length) {
					$.app.filtro.bind();
				}
			}
		},
		slider: {
			bind: function(){
  				$('.slider').slider({
  					height : 250,
  					interval: 5000
  				});
        
			},
			init: function(){
				if ($('.slider').length) {
					$.app.slider.bind();
				};
			}
		},
		cargando: {
			mostrar: function(){
				var html = 	'<div id="preloader-product" class="progress">' +
						      '<div class="indeterminate"></div>' +
						   	'</div>';

				$('#products').append(html);

			},
			ocultar: function(){
				$('#preloader-product').remove();
			}
		},
		productos: {
			obtenerProductos: function(limite, salto, marcas, precios, orden){
				request = false;

				$.app.cargando.mostrar();	

				$.get( webroot + 'eventos/ajax_get_products/' + limite + '/' + salto, function(respuesta){
					
					$('#products').append(respuesta);

					$('.product:hidden').fadeIn(0, function(){
						$(this).children('.card').animate({
							bottom: 0,
							opacity: 1
						}, 500);
					});
					
					offset = offset + 10;
					request = true;
					$.app.cargando.ocultar();
		      	})
		      	.fail(function(){
		      		$.app.cargando.ocultar();
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
			$.app.slider.init();
			$.app.filtro.init();
			$.app.select.init();
		}
	}
});

$(document).ready(function(){
	$.app.init();
});