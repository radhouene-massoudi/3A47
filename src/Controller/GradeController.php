<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\GradeType;
use App\Form\StType;
use App\Form\StudentType;
use App\Repository\GradeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GradeController extends AbstractController
{
   

    #[Route('/grade', name: 'gradde')]
    public function fecthStudent(GradeRepository $repo): Response
    {
      
        $result=$repo->findAll();
        
        return $this->render('grade/grades.html.twig', [
            'grades' => $result,
        ]);
    }

    #[Route('/add/{id}', name: 'addpath')]
    public function addStudent(ManagerRegistry $mg,Request $req,$id,GradeRepository $g): Response
    {
        $st1=new Student();
        $form=$this->createForm(StudentType::class,$st1);
        $form->handleRequest($req);
if($form->isSubmitted()){
    $grade=$g->find($id);
    if($grade!=null){
        $st1->setGt($grade);
      $em= $mg->getManager();
      $em->persist($st1);
      $em->flush();
      return $this->redirectToRoute('gradde');
    }else{
        dd('id not found ');
    }
    
    }
        return  $this->render('student/addst.html.twig', [
            'f'=>$form->createView()
        ]);
    }
}
