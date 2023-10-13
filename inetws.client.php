<?php
/**
* inetws SOAP client
* @author Gabriel Paz <Gabriel.paz@infor.net>
* @copyright 2016 Gabriel Paz
* @version 3.0
*
* @throws SoapFault
*/
require_once("soapUserNameToken.class"); try {
ini_set("soap.wsdl_cache_enabled", "0");
$u = 'pruebaflush';
$p = 'PRUEBAFLUSH';
// Set the login headers
$wsu = 'http://schemas.xmlsoap.org/ws/2002/07/utility';
$usernameToken = new SoapHeaderUsernameToken($u, $p);
$soapHeaders[] = new SoapHeader($wsu, 'UsernameToken', $usernameToken);
$wsdl = 'http://www.infor.net/inetws/inetws.php?get_wsdl=1';
$client = new SoapClient($wsdl);
$client->__setSoapHeaders( $soapHeaders );
//Busqueda persona
//APELLIDOS, NOMBRES, ORDEN, REGISTRO, CODIGO_PAIS
$result = $client->busqueda_persona("perez perez", "juan jose", "DPI", "1633540320101", "GT");
//Busqueda empresa
//RAZON_SOCIAL, NOMBRE_COMERCIAL, NUMERO_TRIBUTARIO, CODIGO_PAIS //$result = $client->busqueda_empresa("","","","","");
//Estudio persona
//CODIGO_PERSONA
//$result = $client->estudio_persona();
//$result = $client->estudio_persona(19781393);
//Estudio empresa
//CODIGO_EMPRESA
//$result = $client->estudio_empresa();
//$result = $client->estudio_empresa(3610637);

//About
//$result = $client->about();
header("Content-Type: application/xml; charset=UTF-8"); print $result;
} catch(SoapFault $f) {
print "Algo salio mal al ejecutar su peticion: {$f->getMessage()}"; }
?>