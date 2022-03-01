<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;  
use App\Entity\Flight;
use App\Services\OpenskyService;
use Symfony\Component\HttpFoundation\Request;
use DateTime;

class OpenskyController extends AbstractController
{

    /**
     * Array de Flight- Aquí se guardan todos los vuelos de la consulta API
     * @access public    
     */
    public $flightArray;



    public function index(): Response
    {
      //Llamamos al método para completar el array de vuelos
     
       return $this->render('opensky/flightlist.html.twig', [
        'controller_name' => 'Lista de vuelos'        
        ]);
    }

    
    //En el constructor llamamos al servicio que nos devuelve el array de vuelos para pintarlos en la vista
    public function __construct(OpenskyService $oss)
    {
       /* $begin = new DateTime("01/01/2022"); //Fecha de prueba
        $end = new DateTime("01/04/2022"); //Fecha de prueba
        $airport = 'UUEE'; //Aeropuerto de prueba
        $this->flightArray = $oss->fetchFlightInformation('UUEE',$begin->getTimestamp(),$end->getTimestamp());*/
       
    }

    public function allAirports(OpenskyService $oss): Response{
        return $oss->fetchAllAirports();    
    }
    public function FlightInformation(Request $request,OpenskyService $oss): Response{
        $airport = $request->get('airport');
        $begin = $request->get('begin');
        $end = $request->get('end');
        return $oss->fetchFlightInformation( $airport, $begin,$end  ); 
    }
    //Buscamos todos los vuelos y sus datos y coordenadas
    public function allStates(Request $request,OpenskyService $oss): Response{
        $lamin = -180;
        $lamax = 180;
        $lomin = -180;
        $lomax = 180;
        return $oss->fetchStateInformation($lamin,$lamax ,$lomin,$lomax); 
    }

}
