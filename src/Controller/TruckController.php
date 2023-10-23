<?php

namespace App\Controller;

use App\Entity\Truck;
use App\Form\CrudType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TruckController extends AbstractController
{

    /**
     * @Route("/" , name="Main")
     */    

     public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Truck::class)->findAll();

        return $this->render('truck/truck.html.twig', [
            'list' => $data,
        ]);
    }


    
     /**
     * @Route("/create" , name="create")
     */
     public function create(Request $request)
     {
       $Truck = new Truck();
       $form = $this->createForm(CrudType::class, $Truck);
       $form->handleRequest($request);
             
         if ($form->isSubmitted() && $form->isValid()){
             $em = $this->getDoctrine()->getManager();
             $em->persist($Truck);
             $em->flush();
                   $this->addFlash('notice','create Successfully!!');
                   
             return $this->redirectToRoute('Main'); // Replace 'your_route_name' with the actual route you want to redirect to.
         }
         
       return $this->render('truck/create.html.twig',[
         'form' => $form->createView(),
       ]);
     }


    /**
     * @Route("/update/{id}" , name="update")
     */
    public function update(Request $request , $id)
    {
      $Truck = $this->getDoctrine()->getRepository(Truck::class)->find($id);
      $form = $this->createForm(CrudType::class, $Truck);
      $form->handleRequest($request);
            
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($Truck);
            $em->flush();
                  $this->addFlash('notice','update Successfully!!');
                  
            return $this->redirectToRoute('Main'); // Replace 'your_route_name' with the actual route you want to redirect to.
        }
        
      return $this->render('truck/update.html.twig',[
        'form' => $form->createView(),
      ]);
    }


    /**
     * @Route("/delete/{id}" , name="delete")
     */
public function delete(Request $request , $id ){

    $Truck =$this->getDoctrine()->getRepository(Truck::class)->find($id);
  
    $em = $this->getDoctrine()->getManager();
    $em->remove($Truck);
    $em->flush();
  
    $this->addFlash('notice','Delete Successfully!!');
  
    return $this->redirectToRoute('Main'); // Replace 'your_route_name' with the actual r
  }
  
  
  
 
 
 




}
