<?php

namespace App\Controller;

use App\Entity\Pub;
use App\Form\PubType;
use App\Repository\PubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/pub")
 */
class AdminPubController extends AbstractController
{
    /**
     * @Route("/", name="pub_index", methods={"GET"})
     */
    public function index(PubRepository $pubRepository): Response
    {
        return $this->render('admin_pub/index.html.twig', [
            'pubs' => $pubRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pub_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pub = new Pub();
        $form = $this->createForm(PubType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pub);
            $entityManager->flush();

            return $this->redirectToRoute('pub_index');
        }

        return $this->render('admin_pub/new.html.twig', [
            'pub' => $pub,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pub_show", methods={"GET"})
     */
    public function show(Pub $pub): Response
    {
        return $this->render('admin_pub/show.html.twig', [
            'pub' => $pub,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pub_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pub $pub): Response
    {
        $form = $this->createForm(PubType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pub_index');
        }

        return $this->render('admin_pub/edit.html.twig', [
            'pub' => $pub,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pub_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pub $pub): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pub->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pub);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pub_index');
    }
}
