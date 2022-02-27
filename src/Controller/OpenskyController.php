<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Flight

class OpenskyController extends AbstractController
{

    private $client;
   
    public function index(): Response
    {
        return $this->render('opensky/index.html.twig', [
            'controller_name' => 'OpenskyController',
        ]);
    }

    /**
     * Return a JSON with the information of preccess 
     * @access public
     * @param request
     * @return JSON
     */

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchFlightInformation(): array
    {
        $response = $this->client->request(
            'GET',
            'https://opensky-network.org/api/flights/arrival?airport=EDDF&begin=1517227200&end=1517230800'
        );

        
      // $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        echo  $content;
    }





}
