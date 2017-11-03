var limit 	= 10,
	offset 	= 0,
	request = true,
	finishR = false,
	params 	= ''; 

$.extend({
	app: {
		menu: function(){
			$('.leftside-navigation ul.collapsible .collapsible-body li.active').each(function(){
				$(this).parents('.bold').eq(0).find('.collapsible-header').eq(0).trigger('click');
			});

			//Main Left Sidebar Menu
			  $('.sidebar-collapse').sideNav({
			    edge: 'left', // Choose the horizontal origin    
			  });
		},
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
			bind: function(){

				$('#filtroMarcas').val(arrMarcas);
				$('#filtroPrecios').val(filtroPrecio);
				$('#filtroDescuento').val(filtroDescuento);

				if (arrMarcas != '') {
					params += encodeURIComponent(JSON.stringify(arrMarcas)) + '&';
				}

				if (filtroPrecio != '') {
					params += filtroPrecio + '&';
				}

				if (filtroDescuento != '') {
					params += filtroDescuento + '&';
				}

				$.app.productos.obtenerProductos(params);

				//$.app.productos.obtenerProductos(limit, offset);

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
			obtenerProductos: function(parametros){
				request = false;

				$.app.cargando.mostrar();	
				var params = document.location.search;
				if (!finishR) {
					$.get( webroot + 'eventos/ajax_get_products/' + limit + '/' + offset + params , function(respuesta){
						
						if (respuesta.length < 2) {
							finishR = true;
						}

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

				}else{
					$.app.cargando.ocultar();
					var htmlFinal = '<div class="col s12 center-align"><h6 class="grey-text lighten-2">No hay más resultados</h6></label></div>'
					$('#products').append(htmlFinal);
				}
			},
			bind: function(){

				// Carga inicial
				// $.app.productos.obtenerProductos(limit, offset);

				$(window).on('scroll', function(){
					var y = $(this).scrollTop() + 210,
						limitScroll = $('#products > .product').last().offset().top;
					
					if ( y > limitScroll && request == true) {

						if (arrMarcas != '') {
							params += encodeURIComponent(JSON.stringify(arrMarcas)) + '&';
						}

						if (filtroPrecio != '') {
							params += filtroPrecio + '&';
						}

						if (filtroDescuento != '') {
							params += filtroDescuento + '&';
						}

						$.app.productos.obtenerProductos(params);
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
			$.app.menu();
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