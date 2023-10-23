<?php

namespace App\Controller;

use App\Entity\Factory;
use App\Form\CrudTypeeType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FactoryController extends AbstractController
{
    
    /**
     * @Route("/factory" , name="app_factory")
     */
    public function index(): Response
    {

        $data = $this->getDoctrine()->getRepository(Factory::class)->findAll();

        return $this->render('factory/index.html.twig', [
            'list' => $data
        ]);
    }



    /**
     * @Route("/fac/create" , name="createe")
     */
    public function create(Request $request)
    {
      $Factory = new Factory();
      $form = $this->createForm(CrudTypeeType::class, $Factory);
      $form->handleRequest($request);
            
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($Factory);
            $em->flush();
                  $this->addFlash('notice','create Successfully!!');
                  
            return $this->redirectToRoute('app_factory'); 
        }
        
      return $this->render('factory/createe.html.twig',[
        'form' => $form->createView(),
      ]);
    }


    /**
     * @Route("/fac/update/{id}" , name="updatee")
     */
    public function update(Request $request , $id)
    {
      $Factory =  $this->getDoctrine()->getRepository(Factory::class)->find($id);

      $form = $this->createForm(CrudTypeeType::class, $Factory);
      $form->handleRequest($request);
            
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($Factory);
            $em->flush();
                  $this->addFlash('notice','create Successfully!!');
                  
            return $this->redirectToRoute('app_factory'); 
        }
        
      return $this->render('factory/update.html.twig',[
        'form' => $form->createView(),
      ]);
    }


    
    /**
     * @Route("/delete/{id}" , name="deletee")
     */
public function delete(Request $request , $id ){

    $Factory =  $this->getDoctrine()->getRepository(Factory::class)->find($id);
  
    $em = $this->getDoctrine()->getManager();
    $em->remove($Factory);
    $em->flush();
  
    $this->addFlash('notice','Delete Successfully!!');
  
    return $this->redirectToRoute('app_factory'); // Replace 'your_route_name' with the actual r
  }
  


}
