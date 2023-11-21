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
    public function createEstudiante(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $fecha__nacimiento = $data['fecha_nacimiento'];
        $direccion = $data['direccion'];
        $telefono = $data['telefono'];
        $codigo_postal = $data['codigo_postal'];
        $email = $data['email'];


        $estudiante = new Estudiante();
        $response = new JsonResponse();

     
      $fecha_nacimiento = new \DateTime($fecha__nacimiento);

        $estudiante->setNombre((String)$nombre);
        $estudiante->setApellido((String)$apellido);
        $estudiante->setFechaNacimiento($fecha_nacimiento);
        $estudiante->setDireccion((String)$direccion);
        $estudiante->setTelefono((int)$telefono);
        $estudiante->setCodigoPostal((int)$codigo_postal);
        $estudiante->setEmail((String)$email);

     	$em->persist($estudiante);
     	$em->flush();


         $response->setData([
            'success' => true,
            'data' => $this->estudianteRepository->dataEstudiante($estudiante)
         ]);
         return $response;
    }

   



    #[Route('/api/estudiantes/{id}', methods: ['PUT'])]
    public function update(int $id, Request $request, EntityManagerInterface $em): JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $fecha__nacimiento = $data['fecha_nacimiento'];
        $direccion = $data['direccion'];
        $telefono = $data['telefono'];
        $codigo_postal = $data['codigo_postal'];
        $email = $data['email'];


        // ... return a JSON response with the post
        $response = new JsonResponse();
        //$response->setContent('<div>Hola mundo</div>');

        $objEstudiante = $this->estudianteRepository->find($id);

        $fecha_nacimiento = new \DateTime($fecha__nacimiento);

        $objEstudiante->setNombre((String)$nombre);
        $objEstudiante->setApellido((String)$apellido);
        $objEstudiante->setFechaNacimiento($fecha_nacimiento);
        $objEstudiante->setDireccion((String)$direccion);
        $objEstudiante->setTelefono((int)$telefono);
        $objEstudiante->setCodigoPostal((int)$codigo_postal);
        $objEstudiante->setEmail((String)$email);
 
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