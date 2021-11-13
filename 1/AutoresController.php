<?php

namespace App\Controller;

use App\Entity\Autores;
use App\Form\AutoresType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/autores")
 */
class AutoresController extends AbstractController
{
    /**
     * @Route("/", name="autores_index", methods={"GET"})
     */
    public function index(): Response
    {
        $autores = $this->getDoctrine()
            ->getRepository(Autores::class)
            ->findAll();

        return $this->render('autores/index.html.twig', [
            'autores' => $autores,
        ]);
    }

    /**
     * @Route("/new", name="autores_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $autore = new Autores();
        $form = $this->createForm(AutoresType::class, $autore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($autore);
            $entityManager->flush();

            return $this->redirectToRoute('autores_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('autores/new.html.twig', [
            'autore' => $autore,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{isbn}", name="autores_show", methods={"GET"})
     */
    public function show(Autores $autore): Response
    {
        return $this->render('autores/show.html.twig', [
            'autore' => $autore,
        ]);
    }

    /**
     * @Route("/{isbn}/edit", name="autores_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Autores $autore): Response
    {
        $form = $this->createForm(AutoresType::class, $autore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('autores_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('autores/edit.html.twig', [
            'autore' => $autore,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{isbn}", name="autores_delete", methods={"POST"})
     */
    public function delete(Request $request, Autores $autore): Response
    {
        if ($this->isCsrfTokenValid('delete'.$autore->getIsbn(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($autore);
            $entityManager->flush();
        }

        return $this->redirectToRoute('autores_index', [], Response::HTTP_SEE_OTHER);
    }
}
