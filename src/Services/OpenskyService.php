<?php
    namespace App\Services;
   
    use Symfony\Contracts\HttpClient\HttpClientInterface;    
    use Symfony\Component\HttpFoundation\JsonResponse;   
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;    
       
    use App\Entity\Flight;
    use App\Entity\Airport;
    use App\Entity\State;

use function PHPUnit\Framework\isNull;

    class OpenSkyService{ 
        /**
		 * Cliente para recoger los datos de la intefaz de cliente HTTP
		 * @access private
		 * @var HttpClientInterface
		 */
		private $client;
        private $airportArray = []; 
        private $flightArray = []; 
        private $stateArray = []; 
        public function __construct(HttpClientInterface $client)
        {
            //Asigna el HttpClientInterface a la propiedad del servicio
            $this->client = $client;
        
        }
        
        /**
		 * Método que obtiene una respuesta de la API con varios valores GET y crea objetos Flight. Devuelve un array de Flight
         * Recibe los valores de aeropuerto, fecha de inicio y fin formato timestamp
		 * @access public
		 * @var string airport
         * @var string begin
         * @var string end
		 */
        
        public function fetchFlightInformation($airport, $begin, $end): Response
        {
                
            //Recogemos el JSON de los vuelos
            $response = $this->client->request(
                'GET',
                'https://opensky-network.org/api/flights/arrival',[
                    'query' => [
                        'airport' => $airport,
                        'begin' => $begin,
                        'end' => $end
                    ],
                ]);
        
            //Decodificamos el objeto JSON recibido
            $data = json_decode($response->getContent(), true);
            
            //Recorremos todos los elementos de JSON        
            foreach ($data as $key => $value) {
                //Para cada elemento creamos un nuevo objeto Flight y le asignamos sus valores 
                $myFlight = new Flight();
                $myFlight->setIcao24($value['icao24']);
                $myFlight->setFirstSeen($value['firstSeen']);
                $myFlight->setEstDepartureAirport($value['estDepartureAirport']);
                $myFlight->setLastSeen($value['lastSeen']);
                $myFlight->setEstArrivalAirport($value['estArrivalAirport']);
                $myFlight->setCallsign($value['callsign']);
                $myFlight->setEstDepartureAirportHorizDistance($value['estDepartureAirportHorizDistance']);
                $myFlight->setEstDepartureAirportVertDistance($value['estDepartureAirportVertDistance']);
                $myFlight->setEstArrivalAirportHorizDistance($value['estArrivalAirportHorizDistance']);
                $myFlight->setEstArrivalAirportVertDistance($value['estArrivalAirportVertDistance']);
                $myFlight->setDepartureAirportCandidatesCount($value['departureAirportCandidatesCount']);
                $myFlight->setArrivalAirportCandidatesCount($value['arrivalAirportCandidatesCount']);
                
                //Añadimos el objeto creado al array de vuelos $flightArray
               
                array_push($this->flightArray, $myFlight); 
            }    
            return $this->resjson($this->flightArray);
            
        }


        /**
		 * Método que recibe un array de objetos serializables y devuelve una respuesta JSON       
		 * @access public
		 * @var array data         
		 */
        
    
    private function resjson($data){
        //Serializar los datos con servicio serializer en la variable $json
       // $json = $this->airportArray->get('serializer')->serialize($data,'json');
        $json = json_encode($data);
        //Resposnse con httpfoundation
        $response = new Response();

        //Asignar contenido de respuesta
        $response->setContent($json);

        //Indicar el formato de respuesta
        $response->headers->set('Content-Type','application/json');       

        //Devolver la respuesta
        return $response;

    }

    public function fetchAllAirports(){
        //Este método devuelve todos aeropuetos
        
        //Recogemos el JSON de los todos los vuelos entre dos fechas
        $response = $this->client->request(
            'GET',
            'https://opensky-network.org/api/flights/all',[
                'query' => [                    
                    'begin' => 1517227200,
                    'end' => 1517230800
                ],
            ]);
        //Decodificamos el objeto JSON recibido
        $data = json_decode($response->getContent(), true);
        
        //La idea es hacer un listado de Aeropuertos ya que la API de openSky no ofrece este resultado
        foreach ($data as $key => $value) {
            
            $eda = new Airport;           
                     
            //BUSCAMOS LOS AEROPUERTOS DE SALIDA
            if($value['estDepartureAirport'] != null){               
                $eda->setName($value['estDepartureAirport']); //Aeropuerto de salida
                //Si el aeropuerto no es nulo/vacío buscamos en el array del aeropuerto
                $findOut=false;
                foreach ($this->airportArray as $a) {
                    if($a->getName()==$eda->getName()) $findOut=true;
                }
                if(!$findOut){
                    //Si no encontramos el aeropuerto en la lista, lo añadimos                    
                    array_push($this->airportArray, $eda);                   
                }
            }
           
            $eaa = new Airport;
            //BUSCAMOS LOS AEROPUERTOS DE LLEGADA
            if($value['estArrivalAirport'] != null){
                $eaa->setName($value['estArrivalAirport']); //Aeropuerto de llegada
                //Si el aeropuerto no es nulo buscamos en el array del aeropuerto
                $findOut=false;
                foreach ($this->airportArray as $a) {
                    if($a->getName()==$eaa->getName()) $findOut=true;
                }
                if(!$findOut){
                    //Si no encontramos el aeropuerto en la lista, lo añadimos                    
                    array_push($this->airportArray, $eaa);    
                }
            }            
        }
       // var_dump ($this->airportArray);        
        return $this->resjson($this->airportArray);


    }


    public function fetchStateInformation($lamin,$lamax ,$lomin,$lomax){
        //Este método devuelve todos estados actales de vuelos
        
        //Recogemos el JSON de los todos los vuelos 
        $response = $this->client->request(
            'GET',
            'https://opensky-network.org/api/states/all',[
                'query' => [                    
                    'lamin' => $lamin,
                    'lamax' => $lamax,
                    'lomin' => $lomin,
                    'lomax' => $lomax
                ],
            ]);

        
        //Decodificamos el objeto JSON recibido
        $data = json_decode($response->getContent(), true);
       
        //La idea es hacer un listado de los vuelos actuales y algunos datos de ellos para representarlos en un amapa
        $data = $data['states']; //porque tengo un array dentro del otro. Solo me interesa el array de 'states'
        
        foreach ($data as $key => $value) {
         
            $state = new State; 
            $state->setIcao24($value[0]);
            $state->setLatitud($value[6]);
            $state->setLongitud($value[5]);
            $state->setCallsign($value[1]);
            $state->setOriginCountry($value[2]);            

            array_push($this->stateArray, $state);  
           
        }         
        return $this->resjson($this->stateArray);
        
    }
}