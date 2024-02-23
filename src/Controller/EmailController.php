<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EmailService;

class EmailController extends AbstractController
{
    /**
     * @Route("/send-emails", name="send_emails")
     */
    public function sendEmails(EmailService $emailService): Response
    {  
        $emailService->sendEmail('abdelazizmakhlouf86@gmail.com', 'New Episode', 'Episode 15 is finally here.');
        
        return new Response('Emails sent successfully!', Response::HTTP_OK);
    }
    
}
