<?php 
 
namespace App\Controller; 
 
use Symfony\Component\HttpFoundation\Response; 
class ejemplo 
{ 
     public function inicio() 
     { 
      return new Response("hola gente"); 
    } 
}