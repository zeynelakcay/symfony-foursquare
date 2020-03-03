<?php
/**
 * Created by PhpStorm.
 * User: zakcay
 * Date: 2.03.2020
 * Time: 11:04
 */

namespace App\Controller\Api;


use App\Controller\AbstractClientController;

class VenueController extends AbstractClientController
{

    public function getCategories(){

        $response = new ReturnObj();

        $client = $this->foursquareClient();

        $command = $client->getCommand('venues/categories');
        $result =  $client->execute($command);
        if (isset($result)){
            $response->status = true;
            $response->data =  $result['response']["categories"];
        }
        return $this->json($response);
    }

    public function getExplore($categoryId){
        $response = new ReturnObj();

        if (isset($categoryId)) {
            $arrayCategoryName = $this->getArrayCategoryName();
            $client = $this->foursquareClient();
            $command = $client->getCommand('venues/explore', [
                'near' => 'valletta',
                'categoryId' => $arrayCategoryName[$categoryId]
            ]);
            $result = $client->execute($command);
            if (isset($result)){
                $response->status = true;
                $response->data = $result['response']["groups"][0]['items'];
            }
        }
        return $this->json($response);
    }

}