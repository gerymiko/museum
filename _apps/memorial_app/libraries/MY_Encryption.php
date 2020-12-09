<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

   class MY_Encryption {
      
      function encrypt_decrypt($action, $string) {
         $output = false;
         $encrypt_method = "AES-256-CBC";
         $secret_key = "6818f23eef19d38dad1d2729991f6368";
         $secret_iv = "0ac35e3823616c810f86e526d1ed59e7";

         $key = hash('sha256', $secret_key);

         $iv = substr(hash('sha256', $secret_iv), 0, 16);
         if ( $action == 'encrypt' ) {
           $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
           $output = base64_encode($output);
         } else if( $action == 'decrypt' ) {
           $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
         }
         return $output;
      }

   }
?>