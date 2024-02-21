<?php
namespace App\Controller;

use App\Entity\Post;
use App\Entity\Contact;
use App\Form\PostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository; 
use App\Repository\ContactRepository; 

class PostController extends AbstractController
{
    /**
     * @Route("/post/create", name="post_create")
     */
    public function create(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();

                // Move the file to the public directory
                $imageFile->move(
                    $this->getParameter('posts_images_directory'),
                    $newFilename
                );

                // Update the post entity with the image filename
                $post->setImage($newFilename);
            }

            // Set the creation date
            $post->setCreatedAt(new \DateTimeImmutable());

            // Persist the post to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('posts'); // Redirect to the homepage or another route
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


     /**
     * @Route("/", name="posts")
     */
    public function list(): Response
    {

        $totalSubscribers = $this->getDoctrine()->getRepository(Contact::class)->count([]);

        // Sort posts by 'id' in descending order directly in the controller.
        // Replace 'id' with the property you want to sort by, like 'createdAt' or 'updatedAt'.
        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy([], ['id' => 'DESC']);

        return $this->render('post/list.html.twig', [
            'posts' => $posts,
            'totalSubscribers' => $totalSubscribers
        ]);
    }



    /**
     * @Route("/post/{id}", name="post_show")
     */
    public function show(int $id, PostRepository $postRepository): Response
    {
        // Fetch the post from the database
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);

        // Check if the post exists
        if (!$post) {
            throw $this->createNotFoundException('The post does not exist');
        }

        // Retrieve the previous and next posts
        $previousPost = $postRepository->findPreviousPost($id);
        $nextPost = $postRepository->findNextPost($id);

        // Render the Twig template to display the post
        return $this->render('post/show.html.twig', [
            'post' => $post,
            'previous_post' => $previousPost,
            'next_post' => $nextPost,
        ]);
    }
}
