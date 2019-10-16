<?php
/*
* Author: 		Intralix - http://intralix.com/
* Description:	Example for Consume Las Positions Webservice
* Date: 		27/03/2019
* License:		
############################################################################
#    Coded by: Intralix (https://github.com/intralix)
############################################################################
#
#    This program is free software: you can redistribute it and/or modify
#    it under the terms of the GNU Affero General Public License as
#    published by the Free Software Foundation, either version 3 of the
#    License, or (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
##############################################################################
*/

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

/**
 * Class to call Lgps Ws
 *
 * @package Lgps\WsClient
 * @author  Lgps
 **/
class LgpsWsClient
{
    /* Http Client **/
    protected $client;
    /* Configuration **/
    protected $config;
    /* Parameters **/
    protected $params;

    /**
     * Class Constructor
     *
     * @return void
     * @author Lgps
     **/   
    public function __construct( $config, $params = [] )
    {
        $this->config = $config;
        $this->client = new Client([]);
        $this->params = $params;
    }  

    /**
     * Returns Last Positions from Webservice
     *
     * @return array $response
     * @author Lgps
     **/
    public function getLastPositions()
    {                               
        $response = [];       

        try {
            // Http Headers
            $headers = [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
                'Authorization' =>  'Bearer '.$this->config['bearer_token'],
               
            ];
            // Call Webservice
            $response = $this->client->request('POST', $this->config['endpoints']['last_positions'], [
                'headers' => $headers,
                'json' => $this->params // Post Parameters if there are
            ]);
           
           // echo 'WS Http Code.<hr>'; var_dump($response->getStatusCode());

            $response = json_decode($response->getBody(), true); // Response as Array           
            // $response = json_decode($response->getBody()); // Response as Object
            $response = ($response !== null) ? $response : [];
    
        } catch (Exception $e) {                               
           
            $response = ['error' => $e->getMessage()];
        }          
             
        return $response;                               
    }

}
