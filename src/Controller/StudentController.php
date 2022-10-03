<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/st', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/students', name: 'students')]
    public function fecthStudent(ManagerRegistry $em): Response
    {
        $repo=$em->getRepository(Student::class);
        $result=$repo->findAll();
        
        return $this->render('student/showstudents.html.twig', [
            'students' => $result,
        ]);
    }

    #[Route('/second', name: 'second')]
    public function getStudent(StudentRepository $repo): Response
    {
        //$repo=$em->getRepository(Student::class);
        $result=$repo->findAll();
        
        return $this->render('student/showstudents.html.twig', [
            'students' => $result,
        ]);
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function removeStudent($id, ManagerRegistry $em,StudentRepository $repo): Response
    {
        $student=$repo->find($id);
        $em=$em->getManager();
        $result=$em->remove($student);//object
        $em->flush();//execute
       
        
        return  $this->redirectToRoute('students');
    }
}
