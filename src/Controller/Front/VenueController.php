<?php
/**
 * Created by PhpStorm.
 * User: zakcay
 * Date: 2.03.2020
 * Time: 11:04
 */

namespace App\Controller\Front;


use App\Controller\AbstractClientController;

class VenueController extends AbstractClientController
{

    public function getCategories(){


        $client = $this->foursquareClient();

        $command = $client->getCommand('venues/categories', []);

        $result = $client->execute($command);

        return $this->render('front/venue/categories.html.twig',[
            'categories' => $result['response']["categories"]
        ]);

    }

    public function getExplore($categoryId){

        if (isset($categoryId)) {

            $client = $this->foursquareClient();
            $command = $client->getCommand('venues/explore', [
                'near' => 'valletta',
                'categoryId' => $categoryId
            ]);

            $result = $client->execute($command);
            dd($result);
            return $this->render('front/venue/explore.html.twig',[
                'categories' => $result['response']["categories"]
            ]);
        }


    }
}