<?php

namespace App\Controller;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends FOSRestController
{

    /** @var EntityRepository */
    private $entityManager;

    /**
     * CompanyController constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager->getRepository(Company::class);;
    }

    /**
     * Recuperation de la liste des company : http://localhost:8000/api/companies/?page=2&size=2
     *
     * @Rest\Get("/api/companies")
     * @Rest\QueryParam(name="page", requirements="\d+", default="1", description="Numéro de la page 1 par défaut")
     * @Rest\QueryParam(name="size", requirements="\d+", default="10", description="Nombre d'éléments à afficher par page 10/defaut")
     *
     */
    public function getCompanies(Request $request, ParamFetcher $paramFetcher)
    {
        $page = $paramFetcher->get('page');
        $size = $paramFetcher->get('size');

        $companies = $this->entityManager->getCompanyPaged($page, $size);

        $view = $this->view($companies, Response::HTTP_OK);
        return $this->handleView($view);
    }


}