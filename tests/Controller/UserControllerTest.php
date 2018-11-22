<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    /** @test */
    public function getUsers()
    {

        $client = static::createClient();
        $client->request('GET', '/api/users', array(), array(),
            array('HTTP_ACCEPT' => 'application/json'));
        $response = $client->getResponse();
        $users = json_decode($response->getContent(), true);
        // on teste le status code de la reponse
        //Todo: on aurais pu mettres des fixtures connues d'avance pour tester la sortie
        $this->assertTrue($response->getStatusCode() == 200);
        $this->assertTrue(count($users) == 100);
    }

}