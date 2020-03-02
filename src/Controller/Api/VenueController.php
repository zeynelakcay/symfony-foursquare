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
        $command = $client->getCommand('venues/categories', []);

        $response->status = true;
        $response->data = (array) $client->execute($command);

        return $this->json($response);
    }

    public function getExplore($categoryId){
        $response = new ReturnObj();

        if (isset($categoryId)) {

            $client = $this->foursquareClient();
            $command = $client->getCommand('venues/explore', [
                'near' => 'valletta',
                'categoryId' => $categoryId
            ]);

            $response->status = true;
            $response->data = (array)$client->execute($command);
        }

        return $this->json($response);
    }

}