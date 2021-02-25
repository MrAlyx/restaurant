<?php

namespace App\Controller;

use App\Entity\Klant;
use App\Form\KlantType;
use App\Repository\KlantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/klant")
 */
class KlantController extends AbstractController
{
    /**
     * @Route("/", name="klant_index", methods={"GET"})
     */
    public function index(KlantRepository $klantRepository): Response
    {
        return $this->render('klant/index.html.twig', [
            'klants' => $klantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="klant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $klant = new Klant();
        $form = $this->createForm(KlantType::class, $klant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($klant);
            $entityManager->flush();

            return $this->redirectToRoute('klant_index');
        }

        return $this->render('klant/new.html.twig', [
            'klant' => $klant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="klant_show", methods={"GET"})
     */
    public function show(Klant $klant): Response
    {
        return $this->render('klant/show.html.twig', [
            'klant' => $klant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="klant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Klant $klant): Response
    {
        $form = $this->createForm(KlantType::class, $klant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('klant_index');
        }

        return $this->render('klant/edit.html.twig', [
            'klant' => $klant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="klant_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Klant $klant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$klant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($klant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('klant_index');
    }
}
