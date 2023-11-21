<?php

// src/Controller/BlogApiController.php
namespace App\Controller;
use App\Entity\Profesor;
use App\Repository\ProfesorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
// ...
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfesorController extends AbstractController {

    private $registry;
    private $em;
    private $profesorRepository;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry) {
        $this->em = $em;
        $this->registry = $registry;
        $this->profesorRepository = new ProfesorRepository($this->registry);
    }
  


    #[Route('/api/profesores/{id}', methods: ['GET','HEAD'])]
    public function findOne(int $id): JsonResponse
    {
        $response = new JsonResponse();
        $findOne = $this->profesorRepository->find($id);
        $response->setData([
           'success' => true,
           'data' => $this->profesorRepository->dataProfesor($findOne)
        ]);
        return $response;
    }

    #[Route('/api/profesores/', methods: ['GET','HEAD'])]
    public function list(): JsonResponse
    {
        // ... return a JSON response with the post
        $response = new JsonResponse();
        $listProfesores = $this->profesorRepository->findAll();
        $dataProfesores = [];
        
        foreach ($listProfesores as $profesor) {
            $dataProfesores[] = $this->profesorRepository->dataProfesor($profesor);
        }


        $response->setData([
           'success' => true,
           'data' => $dataProfesores
        ]);
        return $response;
    }

    #[Route('/api/profesores/', methods: ['POST'])]
    public function createProfesor(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $fecha__nacimiento = $data['fecha_nacimiento'];
        $direccion = $data['direccion'];
        $telefono = $data['telefono'];
        $codigo_postal = $data['codigo_postal'];
        $email = $data['email'];
        $especialidad = $data['especialidad'];



        $profesor = new Profesor();
        $response = new JsonResponse();

     
      $fecha_nacimiento = new \DateTime($fecha__nacimiento);

        $profesor->setNombre((String)$nombre);
        $profesor->setApellido((String)$apellido);
        $profesor->setFechaNacimiento($fecha_nacimiento);
        $profesor->setDireccion((String)$direccion);
        $profesor->setTelefono((int)$telefono);
        $profesor->setCodigoPostal((int)$codigo_postal);
        $profesor->setEmail((String)$email);
        $profesor->setEspecialidad((String)$especialidad);


     	$em->persist($profesor);
     	$em->flush();


         $response->setData([
            'success' => true,
            'data' => $this->profesorRepository->dataProfesor($profesor)
         ]);
         return $response;
    }

   



    #[Route('/api/profesores/{id}', methods: ['PUT'])]
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
        $especialidad = $data['especialidad'];



        // ... return a JSON response with the post
        $response = new JsonResponse();
        //$response->setContent('<div>Hola mundo</div>');

        $objProfesor = $this->profesorRepository->find($id);

        $fecha_nacimiento = new \DateTime($fecha__nacimiento);

        $objProfesor->setNombre((String)$nombre);
        $objProfesor->setApellido((String)$apellido);
        $objProfesor->setFechaNacimiento($fecha_nacimiento);
        $objProfesor->setDireccion((String)$direccion);
        $objProfesor->setTelefono((int)$telefono);
        $objProfesor->setCodigoPostal((int)$codigo_postal);
        $objProfesor->setEmail((String)$email);
        $objProfesor->setEspecialidad((String)$especialidad);

 
        $em->persist($objProfesor);
        $em->flush();

        $response->setData([
            'success' => true,
            'data' => [
                $this->profesorRepository->dataProfesor($objProfesor)
            ]
        ]);
        return $response;
    }



    #[Route('/api/profesores/{id}', methods: ['DELETE'])]
    public function delete(int $id, Request $request, EntityManagerInterface $em){
        // ... return a JSON response with the post
        $response = new JsonResponse();
        //$response->setContent('<div>Hola mundo</div>');

        $objProfesor = $this->profesorRepository->find($id);
 
        $em->remove($objProfesor);
        $em->flush();

        $response->setData([
            'success' => true,
            'data' => $this->profesorRepository->dataProfesor($objProfesor)
         ]);
         return $response;
         
    }

   
}

?>