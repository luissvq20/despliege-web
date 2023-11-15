<?php

// src/Controller/BlogApiController.php
namespace App\Controller;
use App\Entity\Estudiante;
use Doctrine\ORM\EntityManagerInterface;
// ...

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstudianteController extends AbstractController {


    #[Route('/api/estudiantes/{id}', methods: ['GET'])]
    public function findOne(int $id): JsonResponse
    {
        // ... return a JSON response with the post
        $estudiante = new Estudiante();
        $response = new JsonResponse();
        //$response->setContent('<div>Hola mundo</div>');
        $response->setData([
           'success' => true,
           'data' => [
               [
                    'id' => $estudiante->getId(),
                    'nombre' => $estudiante->getNombre(),
                    'apellido' => $estudiante->getApellido(),
                    'fecha_nacimiento' => $estudiante->getFechaNacimiento(),
                    'direccion' => $estudiante->getDireccion(),
                    'telefono' => $estudiante->getTelefono(),
                    'codigo_postal' => $estudiante->getCodigoPostal(),
                    'email' => $estudiante->getEmail()


                                   ]
            ]
        ]);
        return $response;
    }

    #[Route('/api/estudiantes/', methods: ['GET'])]
    public function list(): JsonResponse
    {
        // ... return a JSON response with the post
        $estudiante = new Estudiante();
        $response = new JsonResponse();
        //$response->setContent('<div>Hola mundo</div>');
        $response->setData([
           'success' => true,
           'data' => [
               [
                'id' => $estudiante->getId(),
                'nombre' => $estudiante->getNombre(),
                'apellido' => $estudiante->getApellido(),
                'fecha_nacimiento' => $estudiante->getFechaNacimiento(),
                'direccion' => $estudiante->getDireccion(),
                'telefono' => $estudiante->getTelefono(),
                'codigo_postal' => $estudiante->getCodigoPostal(),
                'email' => $estudiante->getEmail()
               ]
            ]
        ]);
        return $response;
    }

    #[Route('/api/estudiantes/', methods: ['POST'])]
    public function createEstudiante(Request $request, EntityManagerInterface $em){
        $estudiante = new Estudiante();
        $response = new JsonResponse();
         //$response->setContent('<div>Hola mundo</div>');

        $nombre = $request->get('nombre', null);
     	if(empty($nombre)) {
         	$response->setData([
             	'success' => true,
             	'error' => 'Nombre cannot be empty',
             	'data' => null
         	]);	
        }

        $apellido = $request->get('apellido', null);
     	if(empty($apellido)) {
         	$response->setData([
             	'success' => true,
             	'error' => 'Apellido cannot be empty',
             	'data' => null
         	]);	
        }

        $fecha_nacimiento = $request->get('fecha_nacimiento', null);
     	if(empty($fecha_nacimiento)) {
         	$response->setData([
             	'success' => true,
             	'error' => 'Fecha de nacimiento cannot be empty',
             	'data' => null
         	]);	
        }

        $direccion = $request->get('direccion', null);
     	if(empty($direccion)) {
         	$response->setData([
             	'success' => true,
             	'error' => 'Direccion cannot be empty',
             	'data' => null
         	]);	
        }
        
        $telefono = $request->get('telefono', null);
     	if(empty($telefono)) {
         	$response->setData([
             	'success' => true,
             	'error' => 'Telefono cannot be empty',
             	'data' => null
         	]);	
        }

        $codigo_postal = $request->get('codigo_postal', null);
        if(empty($codigo_postal)) {
            $response->setData([
                'success' => true,
                'error' => 'Codigo postal cannot be empty',
                'data' => null
            ]);	
       }

       $email = $request->get('email', null);
       if(empty($email)) {
           $response->setData([
               'success' => true,
               'error' => 'Email cannot be empty',
               'data' => null
           ]);	
      }
      $fecha_nacimiento = new \DateTime("2002-05-29");

        $estudiante->setNombre("Alvaro");
        $estudiante->setApellido("Gento");
        $estudiante->setFechaNacimiento($fecha_nacimiento);
        $estudiante->setDireccion("Triana ");
        $estudiante->setTelefono("77735260");
        $estudiante->setCodigoPostal("41000");
        $estudiante->setEmail("alvarogento@gmail.com");

     	$em->persist($estudiante);
     	$em->flush();


         $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => $estudiante->getId(),
                    'nombre' => $estudiante->getNombre(),
                    'apellido' => $estudiante->getApellido(),
                    'fecha_nacimiento' => $estudiante->getFechaNacimiento(),
                    'direccion' => $estudiante->getDireccion(),
                    'telefono' => $estudiante->getTelefono(),
                    'codigo_postal' => $estudiante->getCodigoPostal(),
                    'email' => $estudiante->getEmail()
                ]
             ]
         ]);
         return $response;
    }

   



    #[Route('/api/estudiantes/{id}', methods: ['PUT'])]
    public function update(int $id): Response
    {
         // ... return a JSON response with the post
         $estudiante = new Estudiante();
         $response = new JsonResponse();
         //$response->setContent('<div>Hola mundo</div>');
         $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => $estudiante->getId(),
                    'nombre' => $estudiante->getNombre(),
                    'apellido' => $estudiante->getApellido(),
                    'fecha_nacimiento' => $estudiante->getFechaNacimiento(),
                    'direccion' => $estudiante->getDireccion(),
                    'telefono' => $estudiante->getTelefono(),
                    'codigo_postal' => $estudiante->getCodigoPostal(),
                    'email' => $estudiante->getEmail()
                ]
             ]
         ]);
         return $response;
    }

   
}

?>