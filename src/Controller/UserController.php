<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends FOSRestController
{

    /** @var EntityRepository */
    private $entityManager;

    /**
     * UserController constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager->getRepository(User::class);;
    }

    /**
     * Récupère la liste des Users sans l'identifiant
     * @Rest\Get("/api/users")
     *
     */
    public function getUsers()
    {
        $users = $this->entityManager->findAll();

        $view = $this->view($users, Response::HTTP_OK);
        return $this->handleView($view);
    }


}