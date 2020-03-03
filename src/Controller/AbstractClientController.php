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

    protected  function foursquareClient(){
        $client = FoursquareClient::factory([
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'mode'          => $this->mode,
        ]);
        return $client;
    }

    protected function getArrayCategoryName(){
        $arrayCategory = [];

        $client = $this->foursquareClient();
        $command = $client->getCommand('venues/categories');

        $categoryResult = $client->execute($command);
        $mainCategories = $categoryResult['response']["categories"];

        foreach ($mainCategories as $mainCategory){
            $arrayCategory[$mainCategory['id']] = $mainCategory['name'];
            if (count($mainCategory['categories']) > 0){
                foreach ($mainCategory['categories'] as $subCategory){
                    $arrayCategory[$subCategory['id']] = $subCategory['name'];
                }
            }
        }
        return $arrayCategory;
    }

}