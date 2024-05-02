<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListaController extends AbstractController
{
    #[Route('/lista', name: 'app_lista')]
    public function index(): Response
    {
        return $this->render('/lista/index.html.twig');
    }
}
