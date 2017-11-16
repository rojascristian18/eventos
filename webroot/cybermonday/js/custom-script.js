var limit 	= 10,
	offset 	= 0,
	request = true,
	finishR = false,
	params 	= ''; 

$.extend({
	app: {
		plugins: function(){

			  // Search class for focus
			  $('.header-search-input').focus(
			  function(){
			      $(this).parents('div').eq(0).addClass('header-search-wrapper-focus');
			      $(this).siblings("label, i").addClass("active");
			  }).blur(
			  function(){
			      $(this).parents('div').eq(0).removeClass('header-search-wrapper-focus');
			      $(this).siblings("label, i").removeClass("active");
			  }); 
			// Materialize Dropdown
			$('.dropdown-button').dropdown({
				inDuration: 300,
				outDuration: 125,
				constrain_width: false, // Does not change width of dropdown to that of the activator
				hover: false, // Activate on click
				alignment: 'left', // Aligns dropdown to left or right edge (works with constrain_width)
				gutter: 0, // Spacing from edge
				belowOrigin: true // Displays dropdown below the button
			});

			// Fono Dropdown
			  $('.fono-button').dropdown({
			      inDuration: 300,
			      outDuration: 225,
			      constrain_width: false, // Does not change width of dropdown to that of the activator
			      hover: false, // Activate on hover
			      gutter: 0, // Spacing from edge
			      belowOrigin: true, // Displays dropdown below the button
			      alignment: 'left' // Displays dropdown with edge aligned to the left of button
			    }
			  );

			  // Email Dropdown
			  $('.email-button').dropdown({
			      inDuration: 300,
			      outDuration: 225,
			      constrain_width: false, // Does not change width of dropdown to that of the activator
			      hover: false, // Activate on hover
			      gutter: 0, // Spacing from edge
			      belowOrigin: true, // Displays dropdown below the button
			      alignment: 'left' // Displays dropdown with edge aligned to the left of button
			    }
			  );

			  // Whatsapp Dropdown
			  $('.whatsapp-button').dropdown({
			      inDuration: 300,
			      outDuration: 225,
			      constrain_width: false, // Does not change width of dropdown to that of the activator
			      hover: false, // Activate on hover
			      gutter: 0, // Spacing from edge
			      belowOrigin: true, // Displays dropdown below the button
			      alignment: 'left' // Displays dropdown with edge aligned to the left of button
			    }
			  );

			$('.leftside-navigation ul.collapsible .collapsible-body li.active').each(function(){
				$(this).parents('.bold').eq(0).find('.collapsible-header').eq(0).trigger('click');
			});

			//Main Left Sidebar Menu
			$('.sidebar-collapse').sideNav({
				edge: 'left', // Choose the horizontal origin    
			});

			$('select').material_select();

			// Perfect Scrollbar
			$('select').not('.disabled').material_select();
			var leftnav = $(".page-topbar").height();  
			var leftnavHeight = window.innerHeight - leftnav;
			$('.leftside-navigation').height(leftnavHeight).perfectScrollbar({
				suppressScrollX: true
			});
			var righttnav = $("#chat-out").height();
			$('.rightside-navigation').height(righttnav).perfectScrollbar({
				suppressScrollX: true
			}); 

			// Detect touch screen and enable scrollbar if necessary
			function is_touch_device() {
				try {
				  document.createEvent("TouchEvent");
				  return true;
				}
				catch (e) {
				  return false;
				}
				}
				if (is_touch_device()) {
				$('#nav-mobile').css({
				  overflow: 'auto'
				})
			}

			$('#to-detail').on('click', function(){
				$('html, body').animate({
					scrollTop: ($('.product-description').offset().top - $('#header').height())
				},1000);
			});

			/**************************
		     * Auto complete plugin  *
		     *************************/
		    $.fn.autocomplete = function (options) {
		      // Defaults
		      var defaults = {
		        data: {},
		        limit: Infinity,
		        onAutocomplete: null,
		        minLength: 1
		      };

		      options = $.extend(defaults, options);

		      return this.each(function () {
		        var $input = $(this);
		        var data = options.data,
		            count = 0,
		            activeIndex = -1,
		            oldVal,
		            $inputDiv = $input.closest('.input-field'); // Div to append on

		        // Check if data isn't empty
		        if (!$.isEmptyObject(data)) {
		          var $autocomplete = $('<ul class="autocomplete-content dropdown-content"></ul>');
		          var $oldAutocomplete;

		          // Append autocomplete element.
		          // Prevent double structure init.
		          if ($inputDiv.length) {
		            $oldAutocomplete = $inputDiv.children('.autocomplete-content.dropdown-content').first();
		            if (!$oldAutocomplete.length) {
		              $inputDiv.append($autocomplete); // Set ul in body
		            }
		          } else {
		            $oldAutocomplete = $input.next('.autocomplete-content.dropdown-content');
		            if (!$oldAutocomplete.length) {
		              $input.after($autocomplete);
		            }
		          }
		          if ($oldAutocomplete.length) {
		            $autocomplete = $oldAutocomplete;
		          }

		          // Highlight partial match.
		          var highlight = function (string, $el) {
		            var img = $el.find('img');
		            var matchStart = $el.text().toLowerCase().indexOf("" + string.toLowerCase() + ""),
		                matchEnd = matchStart + string.length - 1,
		                beforeMatch = $el.text().slice(0, matchStart),
		                matchText = $el.text().slice(matchStart, matchEnd + 1),
		                afterMatch = $el.text().slice(matchEnd + 1);
		            $el.html("<span>" + beforeMatch + "<span class='highlight'>" + matchText + "</span>" + afterMatch + "</span>");
		            if (img.length) {
		              $el.prepend(img);
		            }
		          };

		          // Reset current element position
		          var resetCurrentElement = function () {
		            activeIndex = -1;
		            $autocomplete.find('.active').removeClass('active');
		          };

		          // Remove autocomplete elements
		          var removeAutocomplete = function () {
		            $autocomplete.empty();
		            resetCurrentElement();
		            oldVal = undefined;
		          };

		          $input.off('blur.autocomplete').on('blur.autocomplete', function () {
		            removeAutocomplete();
		          });

		          // Perform search
		          $input.off('keyup.autocomplete focus.autocomplete').on('keyup.autocomplete focus.autocomplete', function (e) {
		            // Reset count.
		            count = 0;
		            var val = $input.val().toLowerCase();

		            // Don't capture enter or arrow key usage.
		            if (e.which === 13 || e.which === 38 || e.which === 40) {
		              return;
		            }

		            // Check if the input isn't empty
		            if (oldVal !== val) {
		              removeAutocomplete();

		              if (val.length >= options.minLength) {
		                for (var key in data) {
		                  if (data.hasOwnProperty(key) && key.toLowerCase().indexOf(val) !== -1) {
		                    // Break if past limit
		                    if (count >= options.limit) {
		                      break;
		                    }

		                    var autocompleteOption = $('<li></li>');
		                    if (!!data[key]) {
		                      autocompleteOption.append('<img src="' + data[key] + '" class="right circle"><span>' + key + '</span>');
		                    } else {
		                      autocompleteOption.append('<span>' + key + '</span>');
		                    }

		                    $autocomplete.append(autocompleteOption);
		                    highlight(val, autocompleteOption);
		                    count++;
		                  }
		                }
		              }
		            }

		            // Update oldVal
		            oldVal = val;
		          });

		          $input.off('keydown.autocomplete').on('keydown.autocomplete', function (e) {
		            // Arrow keys and enter key usage
		            var keyCode = e.which,
		                liElement,
		                numItems = $autocomplete.children('li').length,
		                $active = $autocomplete.children('.active').first();

		            // select element on Enter
		            if (keyCode === 13 && activeIndex >= 0) {
		              liElement = $autocomplete.children('li').eq(activeIndex);
		              if (liElement.length) {
		                liElement.trigger('mousedown.autocomplete');
		                e.preventDefault();
		              }
		              return;
		            }

		            // Capture up and down key
		            if (keyCode === 38 || keyCode === 40) {
		              e.preventDefault();

		              if (keyCode === 38 && activeIndex > 0) {
		                activeIndex--;
		              }

		              if (keyCode === 40 && activeIndex < numItems - 1) {
		                activeIndex++;
		              }

		              $active.removeClass('active');
		              if (activeIndex >= 0) {
		                $autocomplete.children('li').eq(activeIndex).addClass('active');
		              }
		            }
		          });

		          // Set input value
		          $autocomplete.off('mousedown.autocomplete touchstart.autocomplete').on('mousedown.autocomplete touchstart.autocomplete', 'li', function () {
		            var text = $(this).text().trim();
		            $input.val(text);
		            $input.trigger('change');
		            removeAutocomplete();

		            // Handle onAutocomplete callback.
		            if (typeof options.onAutocomplete === "function") {
		              options.onAutocomplete.call(this, text);
		            }
		          });

		          // Empty data
		        } else {
		          $input.off('keyup.autocomplete focus.autocomplete');
		        }
		      });
		    };

    		
			$('.header-search-input').autocomplete({
				data: productosJson,
				limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
				onAutocomplete: function(val) {

					//console.log(val);
				  	$('.header-search-input:visible').parents('form').eq(0).submit();
				},
				minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
			});
        
		},
		imagenes: {
			bind: function(){

				$('.img-product-container .mini img').on('click', function(){
					$este = $(this);
					$('.img-product-container .mini img').css('border', 'none');
					
					$este.css({
						'border' : '1px solid #F55A00'
					});
					
					$('.img-product-container .cover img').attr('src', $este.data('full') );

				});
			},
			init: function(){
				if ($('.img-product-container').length) {
					$.app.imagenes.bind();
				}	
			}
		},
		comprar: {
			bind: function(){
				var $inputcantidad 	= $('.input-quantity'),
					cantidad 		= $inputcantidad.val(),
					cantidadmaxima 	= parseInt($inputcantidad.data('max')),
					cantidadMinima 	= 1;

				// Agregar
				$('.btn-add').on('click', function(){
					if (cantidad < cantidadmaxima) {
						cantidad = (parseInt(cantidad)+1);
						$inputcantidad.val(cantidad);	
					}	
				});

				// Quitar
				$('.btn-remove').on('click', function(){
					if (cantidad > cantidadMinima) {
						cantidad = (parseInt(cantidad)-1);
						$inputcantidad.val(cantidad);	
					}	
				});

			},
			init: function(){
				if ($('#ComprarProductForm').length) {
					$.app.comprar.bind();
				}
			}
		},
		filtro: {
			bind: function(){

				$('#filtroMarcas').val(arrMarcas);
				$('#filtroPrecios').val(filtroPrecio);
				$('#filtroDescuento').val(filtroDescuento);

				$.app.productos.obtenerProductos();

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
			obtenerCantidad: function(){

				var params = document.location.search;
					$.get( webroot + 'eventos/ajax_count_products/'+ params , function(respuesta){
						var html = 	'<div class="container">'+
									'<div class="row">'+
									'<div class="col s12">'+
									'<h5>'+respuesta+' resultado/os encontrado/os</h5>'
									'</div>'+
									'</div>'+
									'</div>';
						$('#cantidad-resultados').html(html);
			      	})
			      	.fail(function(){

					});
			},
			obtenerProductos: function(){
				request = false;

				$.app.cargando.mostrar();	
				var params = document.location.search;
				if (!finishR) {
					$.get( webroot + 'eventos/ajax_get_products/' + limit + '/' + offset + params , function(respuesta){
						
						if (respuesta.length < 2) {
							finishR = true;

							$.app.cargando.ocultar();
							var htmlFinal = '<div class="col s12 center-align"><h6 class="grey-text lighten-2">No hay más resultados</h6></label></div>'
							$('#products').append(htmlFinal);
							$('#btn-load-more').html('');

						}else{
							$('#products').append(respuesta);

							$('.product:hidden').fadeIn(0, function(){
								$(this).children('.card').animate({
									bottom: 0,
									opacity: 1
								}, 500);
							});
							
							offset = offset + 10;
							request = true;

							//$.app.productos.obtenerCantidad();

							var btn = '<button id="more-products" class="btn naranjo waves-effect waves-light col s12" type="submit"><i class="fa fa-refresh"></i> Cargar 10 herramientas más</button>';
							$('#btn-load-more').html(btn);

							$.app.cargando.ocultar();
						}
			      	})
			      	.fail(function(){
			      		$.app.cargando.ocultar();
					});

				}else{
					$.app.cargando.ocultar();
					var htmlFinal = '<div class="col s12 center-align"><h6 class="grey-text lighten-2">No hay más resultados</h6></label></div>'
					$('#products').append(htmlFinal);
					$('#btn-load-more').html('');
				}
			},
			bind: function(){

				$(document).on('click', '#more-products', function(){
					$.app.productos.obtenerProductos();
				});

				// Carga inicial
				// $.app.productos.obtenerProductos(limit, offset);

				/*$(window).on('scroll', function(){
					var y = $(this).scrollTop() + 210,
						limitScroll = $('#products > .product').last().offset().top;
					
					if ( y > limitScroll && request == true) {

						//$.app.productos.obtenerProductos();
					}
				});*/
			},
			init: function(){
				if ($('#products').length) {
					$.app.productos.bind();
				}
			}
		},
		init: function() {
			$.app.comprar.init();
			$.app.productos.init();
			$.app.slider.init();
			$.app.filtro.init();
			$.app.imagenes.init();
			$.app.plugins();
		}
	}
});

$(document).ready(function(){
	$.app.init();
});