<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Stadium;
use App\Form\StadiumCreateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController{
#[Route("/stadium/{id}", name:"showStadium")]
public function getStadium($id, EntityManagerInterface $doctrine){
    $repository = $doctrine->getRepository(Stadium::class);
    $stadium=$repository->find($id);
return $this-> render("stadium/stadium.html.twig", ["stadium"=>$stadium]);
}
#[Route("/Liststadiums", name:"getStadiums")]
public function getStadiums(EntityManagerInterface $doctrine)
{
$repository = $doctrine->getRepository(Stadium::class);
$stadiums=$repository->findAll();
return $this-> render("stadium/listStadium.html.twig", ["stadiums"=>$stadiums]);
}
// #[Route("/insert/stadium")]
// public function insertStadium(EntityManagerInterface $doctrine)
// {
// $stadium1 =new Stadium();
// $stadium1 -> setName("San Siro");
// $stadium1 -> setCity("Milán");
// $stadium1 -> setCapacity(80018);
// $stadium1 -> setTeam("A.C Milán");
// $stadium1 -> setImage("https://res.cloudinary.com/dcpgr4jjn/image/upload/v1657467892/images/sansiro_nhpwv9.jpg");

// $stadium2 =new Stadium();
// $stadium2 -> setName("Santiago Bernabéu");
// $stadium2 -> setCity("Madrid");
// $stadium2 -> setCapacity(81044);
// $stadium2 -> setTeam("Real Madrid");
// $stadium2-> setImage("https://res.cloudinary.com/dcpgr4jjn/image/upload/v1657467892/images/bernabeu_ecm2nc.jpg");

// $doctrine->persist($stadium1);
// $doctrine->persist($stadium2);

// $doctrine->flush();
// return new Response("Stadiums Actualized");
// }
#[Route('/new/stadium', name: "newStadium")]
public function newStadium(Request $request, EntityManagerInterface $doctrine){

    $form=$this->createForm(StadiumCreateType::class);
    $form->handleRequest($request);
    if($form->isSubmitted()&& $form->isValid()){
        $stadium = $form->getData();
        $doctrine->persist($stadium);
        $doctrine->flush();
        return $this-> redirectToRoute('getStadiums');
    }
    return $this-> renderForm("stadium/newStadium.html.twig", ["stadiumForm"=>$form]);
}
#[Route('/edit/stadium/{id}', name: "editStadium")]
public function editStadium( $id, Request $request, EntityManagerInterface $doctrine){

    $repository = $doctrine->getRepository(Stadium::class);
    $stadium=$repository->find($id);
    $form=$this->createForm(StadiumCreateType::class, $stadium);
    $form->handleRequest($request);
    if($form->isSubmitted()&& $form->isValid()){
        $stadium = $form->getData();
        $doctrine->persist($stadium);
        $doctrine->flush();
        return $this-> redirectToRoute('getStadiums');
    }
    return $this-> renderForm("stadium/newStadium.html.twig", ["stadiumForm"=>$form]);
}
 }
?>