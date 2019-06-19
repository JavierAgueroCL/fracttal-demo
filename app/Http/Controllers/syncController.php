<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use curlHelper;
use hawkHelper;

class syncController extends Controller
{
	function obtener_datos(){
		$header = hawkHelper::makeRequest('GET');
		$leer = curlHelper::CallAPI('GET', 'https://app.fracttal.com/api/meters_list/SIE0700-P', $header);
		echo "<pre>";
		$var =  (array) json_decode($leer);
		var_dump($header);
		var_dump($var);
		echo "</pre>";
	}
}
