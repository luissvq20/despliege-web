<?php

// src/Controller/BlogApiController.php
namespace App\Controller;

// ...

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstudianteController extends AbstractController {


    #[Route('/api/posts/{id}', methods: ['GET', 'HEAD'])]
    public function mostrar(int $id): Response
    {
        // ... return a JSON response with the post
    }

    #[Route('/api/posts/{id}', methods: ['PUT'])]
    public function edit(int $id): Response
    {
        // ... edit a post
    }

   
}

?>