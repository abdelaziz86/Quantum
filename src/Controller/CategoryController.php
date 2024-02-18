<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Form\CategoryFormType;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/create", name="category_create")
     */
    public function create(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload
            $imageFile = $form->get('image')->getData();
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

            // Move the file to the public directory
            $imageFile->move(
                $this->getParameter('category_images_directory'),
                $newFilename
            );

            // Store the filename in the database
            $category->setImage($newFilename);

            // Persist the category to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_list'); // Redirect to the homepage or another route
        }

        return $this->render('category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/categories", name="category_list")
     */
    public function list(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('category/list.html.twig', [
            'categories' => $categories,
        ]);
    }
}
    