<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListaController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/lista', name: 'app_lista')]
    public function index(): Response
    {;
        $postRepository = $this->entityManager->getRepository(Post::class);
        $posts = $postRepository->findAll();

        return $this->render('lista/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
