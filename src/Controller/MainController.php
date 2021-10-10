<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\{
    Security, User\User
};
/**
 * Контроллер для главной станицы
 */
class MainController extends AbstractController
{
    /**
     * @var Security $security
     */
    private $security;

    /**
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * Обрабротка запроса главной страницы
     * @Route ("/", name="home", methods={"GET"})
     *
     * @return Response
     */
    public function index(): Response
    {
        /**
         * @var User $user
         */
        $user = $this->security->getUser();
        if (null === $user) {
            return $this->redirectToRoute('app_login');
        }
    }
}