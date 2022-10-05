<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/index", name="portfolio", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('portfolio', [], Response::HTTP_SEE_OTHER);
        }

    


        $Project = $this->getDoctrine()->getRepository(Projet::class)->findAll();

        return $this->render('/index.html.twig', [
            'controller_name' => 'PortfolioController',
            "list" => $Project,
            "form_title" => "Liste des Projet",
            'form' => $form->createView(),

        ]);
    }


    



    /**
     * @Route("/admin/AjouterProjet", name="AjouterProjet")
     */
    public function ajoutprojet(Request $request): Response
    {
        $p1 = new Projet();
        $form = $this->createform(ProjetType::class, $p1);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            //$nomficher = $this->getParameter('kernel.project_dir') . '/public/uploads/projet' . '.' . $image->getExtension();
            $nomfichier = md5(uniqid()) . '.' . $image->getExtension();
            $image->move($this->getParameter('dossier_image'), $nomfichier);
            $p1->setImage($nomfichier);
            $p1 = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($p1);
            $entityManager->flush();
            return $this->redirectToRoute('listeprojetAdmin');
        }
        return $this->render('admin/projet-form.html.twig', [
            'formulaire' => $form->createView(),
            "form_title" => "Ajouter un projet"
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Request $request, $id): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('portfolio', [], Response::HTTP_SEE_OTHER);
        }

        $proj = $this->getDoctrine()->getRepository(Projet::class)->find($id);
        //  $form = $this->createform(ProjetType::class, $proj);

        return $this->render("portfolio/show.html.twig", [
            "p" => $proj,
            'form' => $form->createView(),

            "titre" => "Le projet "
        ]);
    }

    /**
     * @Route("/ListeProjet", name="listeprojet")
     */
    public function ListeProjet(Request $request): Response
    {

        $Project = $this->getDoctrine()->getRepository(Projet::class)->findAll();

        return $this->render('Portfolio/listProject.html.twig', [
            "liste" => $Project,
            "form_title" => "Liste des Projet"
        ]);
    }

    /**
     * @Route("admin/ListeProjet", name="listeprojetAdmin")
     */
    public function ListeProjetAdmin(Request $request): Response
    {

        $Project = $this->getDoctrine()->getRepository(Projet::class)->findAll();

        return $this->render('admin/listProject.html.twig', [
            "liste" => $Project,
            "form_title" => "Liste des Projet"
        ]);
    }






    /**
     * @Route("/admin/editerProjet/{id}", name="editerProjet")
     */
    public function editProjet(Request $request, $id)
    {
        $proj = new Projet();
        $entityManager = $this->getDoctrine()->getManager();

        $proj = $entityManager->getRepository(Projet::class)->find($id);
        $form = $this->createform(ProjetType::class, $proj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('listeprojetAdmin');
        }
        return $this->render("admin/edit.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/supprimer/{id}", name="supprimer")
     */
    public function Supprimer(Request $request, $id)
    {
        $proj = new Projet();
        $entityManager = $this->getDoctrine()->getManager();

        $proj = $entityManager->getRepository(Projet::class)->find($id);
        $entityManager->remove($proj);


        $entityManager->flush();

        return $this->redirectToRoute('listeprojetAdmin');
    }
}
