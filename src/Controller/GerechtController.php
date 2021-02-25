<?php

namespace App\Controller;

use App\Entity\Gerecht;
use App\Form\GerechtType;
use App\Repository\GerechtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gerecht")
 */
class GerechtController extends AbstractController
{
    /**
     * @Route("/", name="gerecht_index", methods={"GET"})
     */
    public function index(GerechtRepository $gerechtRepository): Response
    {
        return $this->render('gerecht/index.html.twig', [
            'gerechts' => $gerechtRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gerecht_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gerecht = new Gerecht();
        $form = $this->createForm(GerechtType::class, $gerecht);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gerecht);
            $entityManager->flush();

            return $this->redirectToRoute('gerecht_index');
        }

        return $this->render('gerecht/new.html.twig', [
            'gerecht' => $gerecht,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gerecht_show", methods={"GET"})
     */
    public function show(Gerecht $gerecht): Response
    {
        return $this->render('gerecht/show.html.twig', [
            'gerecht' => $gerecht,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gerecht_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gerecht $gerecht): Response
    {
        $form = $this->createForm(GerechtType::class, $gerecht);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gerecht_index');
        }

        return $this->render('gerecht/edit.html.twig', [
            'gerecht' => $gerecht,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gerecht_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Gerecht $gerecht): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gerecht->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gerecht);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gerecht_index');
    }
}
