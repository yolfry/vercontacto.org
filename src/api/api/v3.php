<?php

//Api VerContacto @yolfry

use ypw\FOM;


class api
{

   public static $query;

   private static function base64_to_jpeg($base64_string = null)
   {
      //Generador de imagen, base64 Code
      if ($base64_string) {

         // Verifica y crea la carpeta images si no existe
         $images_dir = "./images/";
         if (!is_dir($images_dir)) {
            mkdir($images_dir, 0777, true);
         }

         //Formato de la imagen mimeTypw
         $image = uniqid() . ".jpeg";

         $output_file = $images_dir . $image;
         $ifp = fopen($output_file, 'a');

         $base_to_php = explode(',', $base64_string);
         // the 2nd item in the base_to_php array contains the content of the image

         fwrite($ifp, base64_decode($base_to_php[1]));
         fclose($ifp);
         return $image;
      } else {
         return false;
      }
   }


   public static function contacto()
   {

      $FOM = new FOM(true);
      include __DIR__ . '/../config/db.php';
      $FOM->fileQuery = __DIR__ . "/../db/queryApp.php";


      switch (api::$query) {

         case 'share':

            //Select People Business ID
            $data['share'] = strip_tags($_POST['share']);
            $FOM->sed('share', $data);

            if ($FOM->res) {
               return $FOM->res;
            } else {
               throw new Error('No se encuenta contacto');
            }

            break;

         case 'generar':


            /*
             * Entrada de datos para generar Contacto
             * 
             * logo
             * nombre
             * direccion
             * email
             * numero
             * numero2
             * numero3
             * numero4
             * info
             * color
             * redesSociales
            */


            $data['logo'] =           $_POST['logo'];
            $data['nombre'] =         strip_tags($_POST['nombre']);                // Obligatorio
            $data['direccion'] =      strip_tags($_POST['direccion']);
            $data['email'] =          strip_tags($_POST['email']);
            $data['numero'] =         strip_tags($_POST['numero']);                //Obligatorio
            $data['numero2'] =        strip_tags($_POST['numero2']);               //Numero telefoico
            $data['numero3'] =        strip_tags($_POST['numero3']);
            $data['numero4'] =        strip_tags($_POST['numero4']);
            $data['info'] =           strip_tags($_POST['info']);
            $data['color'] =          $_POST['color'];
            $data['redesSociales'] =  $_POST['redesSociales'];
            $data['web'] =            strip_tags($_POST['web']);




            /*
            * Generar ID Unico, para Compartir los contactos
            * Este id permite, encontrar y compartir los contactos
            */
            $data['share'] =          uniqid();



            if (!preg_match("/^.+$/", $data['logo']) && $data['logo'] != null) {
               throw new Error('Logo Icorrecto');
            }

            if (!preg_match("/^[a-zA-Z .-_&0-9+()%üéáíóúñÑ¿¡ÁÉÍÓÚÚ]{2,40}$/", $data['nombre'])) {
               throw new Error('Nombre incorrecto');
            }

            if (!preg_match("/^(.){2,100}$/", $data['direccion']) && $data['direccion'] != null) {
               throw new Error('direccion incorrecta ');
            }


            if (!preg_match("/^[^@]+@[^@]+\.[a-zA-Z]{2,150}$/", $data['email']) && $data['email'] != null) {
               throw new Error('Email incorrecto ');
            }

            if (!preg_match("/^[+]?(\d{1,4})?\s?-?[.]?[(]?\d{3}[)]?\s?-?[.]?\d{3}\s?-?[.]?\d{4}$/", $data['numero'])) {
               throw new Error('Numero incorrecto');
            }

            if (!preg_match("/^[+]?(\d{1,4})?\s?-?[.]?[(]?\d{3}[)]?\s?-?[.]?\d{3}\s?-?[.]?\d{4}$/", $data['numero2']) && $data['numero2'] != null) {
               throw new Error('Numero 2 incorrecto ');
            }
            if (!preg_match("/^[+]?(\d{1,4})?\s?-?[.]?[(]?\d{3}[)]?\s?-?[.]?\d{3}\s?-?[.]?\d{4}$/", $data['numero3']) && $data['numero3'] != null) {
               throw new Error('Numero 3 incorrecto ');
            }
            if (!preg_match("/^[+]?(\d{1,4})?\s?-?[.]?[(]?\d{3}[)]?\s?-?[.]?\d{3}\s?-?[.]?\d{4}$/", $data['numero4']) && $data['numero4'] != null) {
               throw new Error('Numero 4 incorrecto');
            }


            if (!preg_match("/^.{5,200}$/", $data['info']) && $data['info'] != null) {
               throw new Error('Servicios o Detalles incorrecto');
            }

            if (!preg_match("/^.+$/", $data['color']) && $data['color'] != null) {
               throw new Error('Color incorrecto');
            }

            if (!preg_match("/^.+$/", $data['redesSociales']) && $data['redesSociales'] != null) {
               throw new Error('Redes socieles Incorrecta incorrecto');
            }

            if (!preg_match("/^(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[-A-Z0-9+&@#\/%=~_|$?!:,.])*(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[A-Z0-9+&@#\/%=~_|$])$/i", $data['web']) && $data['web'] != null) {
               throw new Error('Link de pagina incorrecto');
            }

            $image = api::base64_to_jpeg($data['logo']);
            $data['logo'] = $image;


            $FOM->sed('generarContacto', $data);

            if ($FOM->res) {
               return $data['share'];
            } else {
               throw new Error('Error para generar Contacto');
            }
            break;


         default:
            throw new Error('Select Query No search');
            break;
      }
   }
}
