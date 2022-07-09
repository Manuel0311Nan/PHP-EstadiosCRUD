<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController

{

    #[Route("/pokemon/{id}", name:"showpokemon")]
    public function getPokemon($id,EntityManagerInterface $doctrine)
    {
        $repository=$doctrine->getRepository(Pokemon::class);
        $pokemon=$repository->find($id);

        return $this->render("pokemon/showpkmn.html.twig", ["pokemon" => $pokemon]);
    }


    #[Route("/pokemons", name:"getpokemons")]
    public function getPokemons(EntityManagerInterface $doctrine){
        $repository=$doctrine->getRepository(Pokemon::class);
        $pokemons=$repository->findAll();
        return $this->render("pokemon/listPokemon.html.twig", ["pokemons" => $pokemons]);

    }
    #[Route("/insert/pokemon")]
        public function insertpokemon(EntityManagerInterface $doctrine){
            
            $pokemon1=new Pokemon();
            $pokemon1-> setName("Bulbasaur");
            $pokemon1-> setDescription("There is a plant seed on its back right from the day this Pokémon is born. The seed slowly grows larger.");
            $pokemon1-> setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png");
            $pokemon1-> setCode(1);

            $pokemon2=new Pokemon();
            $pokemon2-> setName("Heliolisk");
            $pokemon2-> setDescription("A now-vanished desert culture treasured these Pokémon. Appropriately, when Heliolisk came to the Galar region, treasure came with them.");
            $pokemon2-> setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/695.png");
            $pokemon2-> setCode(2);

            $pokemon3=new Pokemon();
            $pokemon3-> setName("Baltoy");
            $pokemon3-> setDescription("It moves while spinning around on its single foot. Some Baltoy have been seen spinning on their heads.");
            $pokemon3-> setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/343.png");
            $pokemon3-> setCode(3);

            $doctrine->persist($pokemon1);
            $doctrine->persist($pokemon2);
            $doctrine->persist($pokemon3);
            $doctrine->flush();
            return new Response("pokemon insertados correctamente");
        }
}
