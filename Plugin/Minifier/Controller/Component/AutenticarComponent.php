<?php
App::uses('Component', 'Controller');

class AutenticarComponent extends Component
{	
	
	public function initialize(Controller $controller)
	{	
		$this->Controller = $controller;
		/* solicitar token
		$config = [
		    'firma' => [
		        'file' => APP . 'Plugin' . DS . 'FacturacionElectronica' . DS . 'Vendor' . DS . 'certs' . DS . 'certificado_digita.p12',
		        //'data' => '', // contenido del archivo certificado.p12
		        'pass' => 'blanca123456',
		    ],
		];

		// trabajar en ambiente de certificación
		\sasco\LibreDTE\Sii::setAmbiente(\sasco\LibreDTE\Sii::CERTIFICACION);

		// trabajar con maullin para certificación
		\sasco\LibreDTE\Sii::setServidor('maullin');
		
		// solicitar token
		$token = \sasco\LibreDTE\Sii\Autenticacion::getToken($config['firma']);
		//var_dump($token);

		// si hubo errores se muestran
		foreach (\sasco\LibreDTE\Log::readAll() as $error) {
		    echo $error,"\n";
		}*/

		prx('Here');
	}


}