<?php
/**
 * Created by PhpStorm.
 * User: zakcay
 * Date: 2.03.2020
 * Time: 11:04
 */

namespace App\Controller\Front;


use App\Controller\AbstractClientController;
use Symfony\Component\HttpFoundation\Request;

class VenueController extends AbstractClientController
{

    public function getCategories(){

        $categories = [];

        $client = $this->foursquareClient();

        $command = $client->getCommand('venues/categories', []);

        $result = $client->execute($command);

        if (isset($result)){
            $categories = $result['response']["categories"];
        }

        return $this->render('front/venue/categories.html.twig',[
            'categories' => $categories
        ]);

    }

    public function getExplore($categoryId){

        $places = [];

        if (isset($categoryId)) {

            $arrayCategoryName = $this->getArrayCategoryName();

            $client = $this->foursquareClient();

            $command = $client->getCommand('venues/explore', [
                'near' => 'valletta',
                'query' => $arrayCategoryName[$categoryId]
            ]);

            $result = $client->execute($command);
            if (isset($result)){
                $places = $result['response']["groups"][0]['items'];
            }
        }

        return $this->render('front/venue/explore.html.twig',[
            'places' => $places
        ]);
    }


}