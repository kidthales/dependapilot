<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

final class AppController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    #[Template(template: 'dashboard.html.twig')]
    public function index(): array
    {
        return [];
    }

    #[Route('/login', name: 'app_login')]
    #[Template(template: 'login.html.twig')]
    public function login(): array
    {
        return [];
    }
}
