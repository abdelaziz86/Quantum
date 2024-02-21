<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;

class SubscriptionController extends AbstractController
{
    /**
     * @Route("/subscribe-newsletter", name="subscribe_newsletter", methods={"POST"})
     */
    public function subscribeNewsletter(Request $request): Response
    {
        $email = $request->request->get('email');

        // Validate the email address (optional)
        // Implement your validation logic here
        
        // Create a new Contact entity and set the email address
        $contact = new Contact();
        $contact->setEmail($email);
        
        // Set the creation date
        $contact->setCreatedAt(new \DateTimeImmutable());

        // Persist the entity to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($contact);
        $entityManager->flush();

        // Optionally, send a confirmation email
        // Implement your email sending logic here

        // Add a success flash message
        $this->addFlash('success', 'You have successfully subscribed.');

        // Redirect the user to the lists page
        return $this->redirectToRoute('posts');
    }
}
