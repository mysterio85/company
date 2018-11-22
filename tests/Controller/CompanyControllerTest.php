<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanyControllerTest extends WebTestCase
{

    /** @test */
    public function getCompanies()
    {

        /* Etant donné qu'on a 10 compagnies apres load des fixtures donc a la page 2 on aura bien 5 companies */
        $client = static::createClient();
        $client->request('GET', '/api/companies', ['page' => 2, 'size' => 5],
            array(), array('HTTP_ACCEPT' => 'application/json'));
        $response = $client->getResponse();
        $companies = json_decode($response->getContent(), true);
        // on teste le status code de la reponse
        //Todo: on aurais pu mettres des fixtures connues d'avance pour tester la sortie
        $this->assertTrue($response->getStatusCode() == 200);
        $this->assertTrue(count($companies) == 5);

        /* Etant donné qu'on a 10 compagnies apres load des fixtures donc a la page 3 on aura bien 0 companies */

        $client->request('GET', '/api/companies', ['page' => 3, 'size' => 5],
            array(), array('HTTP_ACCEPT' => 'application/json'));
        $response2 = $client->getResponse();
        $companies2 = json_decode($response2->getContent(), true);
        $this->assertTrue($response2->getStatusCode() == 200);
        $this->assertTrue(count($companies2) == 0);

    }

}