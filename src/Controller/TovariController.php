<?php

namespace App\Controller;

use App\Entity\Tovari;
use App\Form\TovariType;
use App\Repository\TovariRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tovari")
 */
class TovariController extends AbstractController
{
    /**
     * @Route("/", name="tovari_index", methods={"GET"})
     */
    public function index(TovariRepository $tovariRepository): Response
    {
        return $this->render('tovari/index.html.twig', [
            'tovaris' => $tovariRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tovari_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tovari = new Tovari();
        $form = $this->createForm(TovariType::class, $tovari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tovari);
            $entityManager->flush();

            return $this->redirectToRoute('tovari_index');
        }

        return $this->render('tovari/new.html.twig', [
            'tovari' => $tovari,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tovari_show", methods={"GET"})
     */
    public function show(Tovari $tovari): Response
    {
        return $this->render('tovari/show.html.twig', [
            'tovari' => $tovari,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tovari_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tovari $tovari): Response
    {
        $form = $this->createForm(TovariType::class, $tovari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tovari_index');
        }

        return $this->render('tovari/edit.html.twig', [
            'tovari' => $tovari,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tovari_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tovari $tovari): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tovari->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tovari);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tovari_index');
    }
}
