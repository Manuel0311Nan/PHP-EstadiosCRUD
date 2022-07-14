<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Stadium;
use App\Form\StadiumCreateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{

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
#[Route("/delete/stadium/{id}", name:"deleteStadium")]
public function deleteStadium($id, EntityManagerInterface $doctrine){
    $repository =  $doctrine->getRepository(Stadium::class);
    $stadium = $repository->find($id);

    $doctrine->remove($stadium);
    $doctrine->flush();
    return $this->redirectToRoute('getStadiums');
}
}
?>