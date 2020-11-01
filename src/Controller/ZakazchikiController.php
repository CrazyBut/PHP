<?php

namespace App\Controller;

use App\Entity\Zakazchiki;
use App\Entity\Zakazi;
use App\Form\ZakazchikiType;
use App\Repository\ZakazchikiRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Webmozart\Assert\Tests\StaticAnalysis\string;

/**
 * @Route("/zakazchiki")
 */
class ZakazchikiController extends AbstractController
{
    /**
     * @Route("/", name="zakazchiki_index", methods={"GET"})
     */
    public function index(ZakazchikiRepository $zakazchikiRepository): Response
    {
        return $this->render('zakazchiki/index.html.twig', [
            'zakazchikis' => $zakazchikiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="zakazchiki_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $zakazchiki = new Zakazchiki();
        $form = $this->createForm(ZakazchikiType::class, $zakazchiki);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($zakazchiki);
            $entityManager->flush();

            return $this->redirectToRoute('zakazchiki_index');
        }

        return $this->render('zakazchiki/new.html.twig', [
            'zakazchiki' => $zakazchiki,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/otchet",name="otchet",methods={"GET"})
     */
    public function otchet(ZakazchikiRepository $zakazchikiRepository,Request $request):Response
    {
        $name = $request->query->get('name');
        $repository = $this->getDoctrine()->getRepository(Zakazi::class);
        return $this -> render('zakazchiki/otchet.html.twig',[
            'zakazis' => $repository -> findtoby ($zakazchikiRepository->findoneBy(['Name'=>$name])), 'string' => $name
        ]);
    }

    /**
     * @Route("/{id}", name="zakazchiki_show", methods={"GET"})
     */
    public function show(Zakazchiki $zakazchiki): Response
    {
        return $this->render('zakazchiki/show.html.twig', [
            'zakazchiki' => $zakazchiki,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="zakazchiki_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Zakazchiki $zakazchiki): Response
    {
        $form = $this->createForm(ZakazchikiType::class, $zakazchiki);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('zakazchiki_index');
        }

        return $this->render('zakazchiki/edit.html.twig', [
            'zakazchiki' => $zakazchiki,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="zakazchiki_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Zakazchiki $zakazchiki): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zakazchiki->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($zakazchiki);
            $entityManager->flush();
        }

        return $this->redirectToRoute('zakazchiki_index');
    }
}
