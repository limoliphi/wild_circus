<?php

namespace App\Controller;

use App\Repository\PubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PubController extends AbstractController
{
    /**
     * @Route("/pub", name="pub")
     */
    public function index(PubRepository $pubRepository)
    {
        $pubs = $pubRepository->findAll();
        return $this->render('pub/index.html.twig', [
            'pubs' => $pubs,
        ]);
    }
}
