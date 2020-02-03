<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param int|null $id
     * @param EventRepository $eventRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(EventRepository $eventRepository, ActorRepository $actorRepository)
    {
        $events = $eventRepository->findBy([], ['date' => 'ASC']);
        $actors = $actorRepository->findAll();


        return $this->render('home/index.html.twig', [
            'events' => $events,
            'actors' => $actors

        ]);
    }
}
