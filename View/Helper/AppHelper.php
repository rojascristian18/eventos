<?php
App::uses('Helper', 'View');
class AppHelper extends Helper
{
	public function menuActivo($link = array())
	{
		if ( ! is_array($link) || empty($link) )
		{
			return false;
		}

		$action				= $this->request->params['action'];
		$controller			= $this->request->params['controller'];
		$prefix				= (isset($this->request->params['prefix']) ? $this->request->params['prefix'] : null);


		if ( $prefix && isset($this->request->params[$prefix]) && $this->request->params[$prefix] )
		{
			$tmp_action			= explode('_', $action);
			if ( $tmp_action[0] === $prefix )
			{
				array_shift($tmp_action);
				$action			= implode('_', $tmp_action);
			}
		}

		return (
			(isset($link['controller']) ? ($link['controller'] == $controller) : true) &&
			(isset($link['action']) ? ($link['action'] == $action) : true)
		);
	}

	public function precio_bruto($precio = null, $iva = 19)
	{
		if (!is_null($precio)) {

			$iva = (intval($iva) / 100) +1;

			return round( $precio * $iva );
		}
		
		return;
	}


	public function tabla_productos($productos = array()) {
		$tabla = '';
		if (!empty($productos)) {
			foreach ($productos as $index => $producto) {
				$tabla .= '<tr>';
		    	$tabla .= '<td><input type="hidden" name="data[Producto]['.$index.'][id]" value="[*ID_REGISTRO*]"><input type="hidden" name="data[Producto]['.$index.'][id_product]" value="[*ID*]" class="js-input-id_product">[*ID*]</td>';
		    	$tabla .= '<td>[*REFERENCIA*]</td>';
		    	$tabla .= '<td>[*NOMBRE*]</td>';
		    	$tabla .= '<td><b>[*PRECIO*]</b></td>';
		    	$tabla .= '<td><b>[*DESCUENTO*]</b></td>';
		    	$tabla .= '<td><label class="label label-form label-success">[*PRECIO_FINAL*]</label></td>';
		    	$tabla .= '<td><button class="js-clon-eliminar btn btn-xs btn-danger">Quitar</button></td>';
		    	$tabla .= '</tr>';

				// Armamos la tabla
				$tabla = str_replace('[*ID_REGISTRO*]', $producto['id'] , $tabla);
				$tabla = str_replace('[*ID*]', $producto['id_product'] , $tabla);
				$tabla = str_replace('[*REFERENCIA*]', $producto['Producto']['reference'] , $tabla);
				$tabla = str_replace('[*NOMBRE*]', $producto['Producto']['Idioma'][0]['ProductosIdioma']['name'] , $tabla);

				$precio_normal 		= $this->precio_bruto($producto['Producto']['price'], $producto['Producto']['GrupoReglaImpuesto']['ReglaImpuesto'][0]['Impuesto']['rate']);
				
				if ( ! empty($producto['Producto']['PrecioEspecifico']) ) {
					if ($producto['Producto']['PrecioEspecifico'][0]['reduction'] == 0) {
						$tabla = str_replace('[*PRECIO*]', CakeNumber::currency($precio_normal , 'CLP'), $tabla);
						$tabla = str_replace('[*DESCUENTO*]', intval($producto['Producto']['PrecioEspecifico'][0]['reduction']) , $tabla);
						$tabla = str_replace('[*PRECIO_FINAL*]', CakeNumber::currency($precio_normal , 'CLP'), $tabla);
					}else {
						$precio_descuento	= $this->precio_bruto($precio_normal, ($producto['Producto']['PrecioEspecifico'][0]['reduction'] * 100 * -1) );
						
						$tabla = str_replace('[*PRECIO*]', CakeNumber::currency($precio_normal , 'CLP'), $tabla);
						$tabla = str_replace('[*DESCUENTO*]', intval($producto['Producto']['PrecioEspecifico'][0]['reduction'] * 100 * -1) , $tabla);
						$tabla = str_replace('[*PRECIO_FINAL*]', CakeNumber::currency($precio_descuento , 'CLP') , $tabla);
					}
				}else{
					$tabla = str_replace('[*PRECIO*]', CakeNumber::currency($precio_normal , 'CLP') , $tabla);
					$tabla = str_replace('[*DESCUENTO*]', 0 , $tabla);
					$tabla = str_replace('[*PRECIO_FINAL*]', CakeNumber::currency($precio_normal , 'CLP') , $tabla);
				}
	    	}	
		}

		return $tabla;
	}


	/**
	 * Calculadora de cuotas
	 */
	public function calcularCuota($cuotas, $monto) 
	{
		return CakeNumber::currency( ($monto / $cuotas) , 'CLP');
	}


	/**
	 * Ordena las marcas para el selector
	 */
	public function optionsList($arr = array(), $model = '', $identifier = '', $name = '')
	{	
		$newOptionsList = array();
		foreach ($arr as $i => $val) {
			$newOptionsList[$val[$model][$identifier]] = $val[$model][$name];
		}

		return $newOptionsList;
	}
}
