<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ListeCourseController extends AbstractController
{
    #[Route('/liste/course', name: 'app_liste_course')]
    public function index(): Response
    {
        return $this->render('liste_course/index.html.twig', [
            'controller_name' => 'ListeCourseController',
        ]);
    }
}
