<?php

namespace App\Controller;

use App\Entity\Zakazchiki;
use App\Entity\Zakazi;
use App\Form\ZakaziType;
use App\Repository\ZakaziRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/zakazi")
 */
class ZakaziController extends AbstractController
{
    /**
     * @Route("/", name="zakazi_index", methods={"GET"})
     */
    public function index(ZakaziRepository $zakaziRepository): Response
    {

        return $this->render('zakazi/index.html.twig', [
            'zakazis' => $zakaziRepository->findAll(),

        ]);
    }

    /**
     * @Route("/new", name="zakazi_new", methods={"GET","POST"})
     */
    public function new(ZakaziRepository $zakaziRepository,Request $request): Response
    {
        $zakazi = new Zakazi();
        $form = $this->createForm(ZakaziType::class, $zakazi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($zakazi);
            $entityManager->flush();

            return $this->redirectToRoute('zakazi_index');
        }
        /*if ($zakaziRepository->findOneBy(['Zakazchik'=>$zakazi->getZakazchik(),'Tovar'=>$zakazi->getTovar()])){
             $buff=$zakaziRepository->findOneBy(['Zakazchik'=>$zakazi->getZakazchik(),'Tovar'=>$zakazi->getTovar()]);
            (int)$amount=$buff->getAmount();
             $entityManager=$this->getDoctrine()->getManager();
             $entityManager->remove($buff);
             $entityManager->flush();
             $zakazi->setAmount($zakazi->getAmount()+$amount);
            $entityManager->persist($zakazi);
            $entityManager->flush();
            return $this->redirectToRoute('zakazi_index');
        }*/

        return $this->render('zakazi/new.html.twig', [
            'zakazi' => $zakazi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="zakazi_show", methods={"GET"})
     */
    public function show(Zakazi $zakazi): Response
    {   $hui=$this->getDoctrine()->getRepository(Zakazchiki::class);
        return $this->render('zakazi/show.html.twig', [
            'zakazi' => $zakazi,
            ]);
    }

    /**
     * @Route("/{id}/edit", name="zakazi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Zakazi $zakazi): Response
    {
        $form = $this->createForm(ZakaziType::class, $zakazi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('zakazi_index');
        }

        return $this->render('zakazi/edit.html.twig', [
            'zakazi' => $zakazi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="zakazi_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Zakazi $zakazi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zakazi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($zakazi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('zakazi_index');
    }
}
