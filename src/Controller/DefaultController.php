<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController

{

    #[Route("/pokemon")]
    public function getPokemon()
    {
        $pokemon = [
            "name" => "Bulbasaur",
            "description" => "There is a plant seed on its back right from the day this Pokémon is born. The seed slowly grows larger.",
            "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png",
            "number" => "001"
        ];

        return $this->render("pokemon/showpkmn.html.twig", ["pokemon" => $pokemon]);
    }


    #[Route("/pokemons")]
    public function getPokemons(){
        $pokemons = [
            [
            "name" => "Bulbasaur",
            "description" => "There is a plant seed on its back right from the day this Pokémon is born. The seed slowly grows larger.",
            "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png",
            "number" => "001"

            ],
            [
                "name" => "Heliolisk",
                "description" => "A now-vanished desert culture treasured these Pokémon. Appropriately, when Heliolisk came to the Galar region, treasure came with them.",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/695.png",
                "number" => "695"
    
            ],
            [
                "name" => "Baltoy",
                "description" => "It moves while spinning around on its single foot. Some Baltoy have been seen spinning on their heads.",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/343.png",
                "number" => "343"
        
            ]
           
        ];

        return $this->render("pokemon/listPokemon.html.twig", ["pokemons" => $pokemons]);

    }
}
