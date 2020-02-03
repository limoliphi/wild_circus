<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ActorController extends AbstractController
{
    /**
     * @Route("/actor", name="actor")
     */
    public function index(ActorRepository $actorRepository)
    {
        $actors = $actorRepository->findAll();
        return $this->render('actor/index.html.twig', [
            'actors' => $actors
        ]);
    }
}
