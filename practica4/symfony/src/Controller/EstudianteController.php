<?php

// src/Controller/BlogApiController.php
namespace App\Controller;
use App\Entity\Estudiante;
use App\Repository\EstudianteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
// ...
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstudianteController extends AbstractController {

    private $registry;
    private $em;
    private $estudianteRepository;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry) {
        $this->em = $em;
        $this->registry = $registry;
        $this->estudianteRepository = new EstudianteRepository($this->registry);
    }
  


    #[Route('/api/estudiantes/{id}', methods: ['GET','HEAD'])]
    public function findOne(int $id): JsonResponse
    {
        $response = new JsonResponse();
        $findOne = $this->estudianteRepository->find($id);
        $response->setData([
           'success' => true,
           'data' => $this->estudianteRepository->dataEstudiante($findOne)
        ]);
        return $response;
    }

    #[Route('/api/estudiantes/', methods: ['GET','HEAD'])]
    public function list(): JsonResponse
    {
        // ... return a JSON response with the post
        $response = new JsonResponse();
        $listEstudiantes = $this->estudianteRepository->findAll();
        $dataEstudiantes = [];
        
        foreach ($listEstudiantes as $estudiante) {
            $dataEstudiantes[] = $this->estudianteRepository->dataEstudiante($estudiante);
        }


        $response->setData([
           'success' => true,
           'data' => $dataEstudiantes
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
      $fecha_nacimiento = new \DateTime("1988-05-12");

        $estudiante->setNombre("Jorge");
        $estudiante->setApellido("Marimon");
        $estudiante->setFechaNacimiento($fecha_nacimiento);
        $estudiante->setDireccion("Bami");
        $estudiante->setTelefono("99935260");
        $estudiante->setCodigoPostal("44444");
        $estudiante->setEmail("jorgemm@gmail.com");

     	$em->persist($estudiante);
     	$em->flush();


         $response->setData([
            'success' => true,
            'data' => $this->estudianteRepository->dataEstudiante($estudiante)
         ]);
         return $response;
    }

   



    #[Route('/api/estudiantes/{id}', methods: ['PUT'])]
    public function update(int $id, Request $request, EntityManagerInterface $em){
        // ... return a JSON response with the post
        $response = new JsonResponse();
        //$response->setContent('<div>Hola mundo</div>');

        $objEstudiante = $this->estudianteRepository->find($id);

        $fecha_nacimiento = new \DateTime("1988-05-12");

        $objEstudiante->setNombre("Jorge");
        $objEstudiante->setApellido("Marimon");
        $objEstudiante->setFechaNacimiento($fecha_nacimiento);
        $objEstudiante->setDireccion("Bami");
        $objEstudiante->setTelefono("99935260");
        $objEstudiante->setCodigoPostal("44444");
        $objEstudiante->setEmail("jorgemm@gmail.com");
 
        $em->persist($objEstudiante);
        $em->flush();

        $response->setData([
            'success' => true,
            'data' => [
                $this->estudianteRepository->dataEstudiante($objEstudiante)
            ]
        ]);
        return $response;
    }



    #[Route('/api/estudiantes/{id}', methods: ['DELETE'])]
    public function delete(int $id, Request $request, EntityManagerInterface $em){
        // ... return a JSON response with the post
        $response = new JsonResponse();
        //$response->setContent('<div>Hola mundo</div>');

        $objEstudiante = $this->estudianteRepository->find($id);
 
        $em->remove($objEstudiante);
        $em->flush();

        $response->setData([
            'success' => true,
            'data' => $this->estudianteRepository->dataEstudiante($objEstudiante)
         ]);
         return $response;
         
    }

   
}

?>