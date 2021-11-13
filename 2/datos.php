<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
class datos
{
public function inicio()
{

return new Response("Datos Estudiante: Mathías Miranda, 2019205281,Ingenieria de Sistemas,M,Matricula normal");
}
}
