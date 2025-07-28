<?php


//Load Composer's autoloader
require  './vendor/autoload.php';


//header('Content-type: text/javascript');

/* 
   @author Name Yolfry Web
   @copyright 2025 Yolfry Web
   @author email <yolfri1997@hotmail.com>
*/

/*Permite el aceso desde Get o Post desde cualquier Servidor*/

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");


/*Zona horaria */
date_default_timezone_set('America/Santo_Domingo');
session_start();
$_POST = json_decode(file_get_contents('php://input'), true);


try {


   $version = (!empty($_GET['version'])) ? $_GET['version'] : null;
   $method = (!empty($_GET['method'])) ? $_GET['method'] : null;
   $query = (!empty($_GET['query'])) ? $_GET['query'] : null;

   if (!$version) {
      throw new Error('Api Version no detecte');
   }

   if (!$method) {
      throw new Error('Api Methodo no detecte');
   }

   if (!$query) {
      throw new Error('Api Query no detecte');
   }

   //Include Version de Api
   include __DIR__ . '/api/' . $version . '.php';

   //Agregar Query a la Api
   api::$query = $query;

   $res['error'] = false;
   $res['message'] = null;

   /* Api res  api/version/method/query*/
   $res['res'] = api::$method();

   echo json_encode($res);
} catch (\Throwable $e) {
   $res['error'] = true;
   $res['message'] = $e->getMessage();
   $res['res'] = false;
   echo json_encode($res);
}
