<?php

namespace App\Controller;

use App\Entity\Subgerecht;
use App\Form\SubgerechtType;
use App\Repository\SubgerechtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subgerecht")
 */
class SubgerechtController extends AbstractController
{
    /**
     * @Route("/", name="subgerecht_index", methods={"GET"})
     */
    public function index(SubgerechtRepository $subgerechtRepository): Response
    {
        return $this->render('subgerecht/index.html.twig', [
            'subgerechts' => $subgerechtRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="subgerecht_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subgerecht = new Subgerecht();
        $form = $this->createForm(SubgerechtType::class, $subgerecht);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subgerecht);
            $entityManager->flush();

            return $this->redirectToRoute('subgerecht_index');
        }

        return $this->render('subgerecht/new.html.twig', [
            'subgerecht' => $subgerecht,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subgerecht_show", methods={"GET"})
     */
    public function show(Subgerecht $subgerecht): Response
    {
        return $this->render('subgerecht/show.html.twig', [
            'subgerecht' => $subgerecht,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subgerecht_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Subgerecht $subgerecht): Response
    {
        $form = $this->createForm(SubgerechtType::class, $subgerecht);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subgerecht_index');
        }

        return $this->render('subgerecht/edit.html.twig', [
            'subgerecht' => $subgerecht,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subgerecht_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Subgerecht $subgerecht): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subgerecht->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subgerecht);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subgerecht_index');
    }
}
