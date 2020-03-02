<?php
/**
 * Created by PhpStorm.
 * User: zakcay
 * Date: 2.03.2020
 * Time: 12:23
 */

namespace App\Controller;


use Jcroll\FoursquareApiClient\Client\FoursquareClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AbstractClientController extends AbstractController
{
    private $clientId = "1A1H50SXAVAAKDYPXLDNUW2RYTSMU20JCTCYRXXV0ET00VNI";
    private $clientSecret = "DNP2E3BGZLOTQKZZQYHVA4VAU2H3IOA0T32OLRI0PS11MZE3";
    private $mode = "foursquare";

    public  function foursquareClient(){
        $client = FoursquareClient::factory([
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'mode'          => $this->mode,
        ]);
        return $client;
    }

}