<?php
namespace App\Helpers;

use Illuminate\Http\Request;

class curlHelper
{
		/**
		 * Hace una llamada CURL a la URL deseada y devuelve la respuesta
		 * @Author Javier     Aguero       <javier.aguero[at]espol.cl>
		 * @Date   2018-09-25
		 * @param  [type]     $method      método para la llamada CURL
		 * @param  [type]     $url         URL para la llamada
		 * @param  boolean    $data        datos que se desean enviar en post o put
		 * @param  boolean    $json_header define si los datos deben ser enviados en formato JSON
		 */
		public static function CallAPI($method, $url, $header, $data = false)
		{
				$curl = curl_init();

				switch ($method) {
					case "POST":
						curl_setopt($curl, CURLOPT_POST, 1);
						if ($data) {
								curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
						}
					break;
					case "PUT":
						curl_setopt($curl, CURLOPT_PUT, 1);
						break;
						if ($data) {
								$url = sprintf("%s?%s", $url, http_build_query($data));
						}
				}

				$headers = array(
					 //'Authorization: '.$header
					 'Authorization: Hawk id="CVJ9kXEwbfvRepBBUC9", ts="'.strtotime(date('r', time()).'').'", nonce="mgKxLM", mac="44287toRm/Gf8vRo0VGqTNLC2sd0XG1wUp79FVg+cTo="',
				);


				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

				$result = curl_exec($curl);
				curl_close($curl);

				return $result;
		}

		/**
		 * Fuerza la salida de cualquier contenido a Json en el header
		 * @Author Javier     Aguero     <javier.aguero[at]espol.cl>
		 * @Date   2018-09-14
		 * @param  [string]     $contenido [cualquier cotenido]
		 * @return [string]                [salida con json en header]
		 */
		public static function jsonResponse($contenido)
		{
				return response($contenido)->header('Content-Type', 'application/json');
		}


		public static function CallFracttal(){
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://app.fracttal.com/api/meters_list/SIE0700-P",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Accept: */*",
			    'Authorization: Hawk id="CVJ9kXEwbfvRepBBUC9", ts="1560960124", nonce="CO5iZq", mac="SEzKOjVPrQZGLxOio5k1Pu2/mQzlQpnS1uoAMbJBAAg="',
			    "Cache-Control: no-cache",
			    "Connection: keep-alive",
			    "Content-Type: application/x-www-form-urlencoded",
			    "Host: app.fracttal.com",
			    "Postman-Token: 918f60fb-8315-4f46-9dd3-cdac5f297b83,18c79638-f88b-4ce5-b18e-0370f17740d6",
			    "User-Agent: PostmanRuntime/7.15.0",
			    "accept-encoding: gzip, deflate",
			    "cache-control: no-cache",
			    "content-length: ",
			    "cookie: __cfduid=d0b077325453c3497edad155776e575731560886638",
			    "key: KXSIEbw4nTkngG7q1f5yHltjQjvcE8lZhEsvqp0eJlS02ar4Gx3YjxH"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  echo $response;
			}
		}

		public static function httpRequest(){

			$request = new HttpRequest();
			$request->setUrl('https://app.fracttal.com/api/meters_list/SIE0700-P');
			$request->setMethod(HTTP_METH_GET);

			$request->setHeaders(array(
			  'cache-control' => 'no-cache',
			  'Connection' => 'keep-alive',
			  'content-length' => '',
			  'accept-encoding' => 'gzip, deflate',
			  'cookie' => '__cfduid=d0b077325453c3497edad155776e575731560886638',
			  'Host' => 'app.fracttal.com',
			  'Postman-Token' => 'd2647080-ed6f-4eba-ad22-dbed9fb3cc3a,a126dd90-429e-4380-aa4b-f7efef9429bc',
			  'Cache-Control' => 'no-cache',
			  'Accept' => '*/*',
			  'User-Agent' => 'PostmanRuntime/7.15.0',
			  'Authorization' => 'Hawk id="CVJ9kXEwbfvRepBBUC9", ts="1560961458", nonce="ITIiOe", mac="mr5LtgyvBLV33qZrjPZIpj9Kd126uZvrQYXKns2DFDo="',
			  'Content-Type' => 'application/x-www-form-urlencoded',
			  'key' => 'KXSIEbw4nTkngG7q1f5yHltjQjvcE8lZhEsvqp0eJlS02ar4Gx3YjxH'
			));

			try {
			  $response = $request->send();

			  echo $response->getBody();
			} catch (HttpException $ex) {
			  echo $ex;
			}
		}
}
