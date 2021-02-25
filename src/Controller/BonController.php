<?php

namespace App\Controller;

use App\Entity\Bon;
use App\Form\BonType;
use App\Repository\BonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bon")
 */
class BonController extends AbstractController
{
    /**
     * @Route("/", name="bon_index", methods={"GET"})
     */
    public function index(BonRepository $bonRepository): Response
    {
        return $this->render('bon/index.html.twig', [
            'bons' => $bonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bon_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bon = new Bon();
        $bon->setDatumTijd(new \DateTime('now'));
        $form = $this->createForm(BonType::class, $bon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bon);
            $entityManager->flush();

            return $this->redirectToRoute('bon_index');
        }

        return $this->render('bon/new.html.twig', [
            'bon' => $bon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bon_show", methods={"GET"})
     */
    public function show(Bon $bon): Response
    {
        return $this->render('bon/show.html.twig', [
            'bon' => $bon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bon_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bon $bon): Response
    {
        $bon->setDatumTijd(new \DateTime('now'));
        $form = $this->createForm(BonType::class, $bon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bon_index');
        }

        return $this->render('bon/edit.html.twig', [
            'bon' => $bon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bon $bon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bon->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bon_index');
    }
}
