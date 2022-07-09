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
}
