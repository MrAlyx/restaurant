<?php

namespace App\Controller;

use App\Entity\Bestelling;
use App\Form\BestellingType;
use App\Repository\BestellingRepository;
use App\Repository\MenuItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/bestelling")
 */
class BestellingController extends AbstractController
{
    /**
     * @Route("/", name="bestelling_index", methods={"GET"})
     */
    public function index(BestellingRepository $bestellingRepository): Response
    {
        return $this->render('bestelling/index.html.twig', [
            'bestellings' => $bestellingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/keuken", name="keuken_index", methods={"GET"})
     */
    public function show_keuken(BestellingRepository $bestellingRepository): Response
    {
        return $this->render('bestelling/keuken.html.twig', [
            'bestellings' => $bestellingRepository->findBy(
                ['gerecht' => 2]
            )
        ]);
    }

    /**
     * @Route("/bar", name="bar_index", methods={"GET"})
     */
    public function show_bar(BestellingRepository $bestellingRepository): Response
    {
        return $this->render('bestelling/bar.html.twig', [
            'bestellings' => $bestellingRepository->findBy(
                ['gerecht' => "1"]
            )
        ]);
    }

    /**
     * @Route("/PDF/{id}", name="bestelling_showpdf", methods={"GET"})
     */

    public function showpdf(bestelling $bestelling)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('bestelling/showpdf.html.twig', [
            'bestelling' => $bestelling
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
    /**
     * @Route("/new", name="bestelling_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bestelling = new Bestelling();
        $form = $this->createForm(BestellingType::class, $bestelling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bestelling);
            $entityManager->flush();

            return $this->redirectToRoute('bestelling_index');
        }

        return $this->render('bestelling/new.html.twig', [
            'bestelling' => $bestelling,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bestelling_show", methods={"GET"})
     */
    public function show(Bestelling $bestelling): Response
    {
        return $this->render('bestelling/show.html.twig', [
            'bestelling' => $bestelling,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bestelling_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bestelling $bestelling): Response
    {
        $form = $this->createForm(BestellingType::class, $bestelling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bestelling_index');
        }

        return $this->render('bestelling/edit.html.twig', [
            'bestelling' => $bestelling,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bestelling_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bestelling $bestelling): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bestelling->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bestelling);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bestelling_index');
    }



}
