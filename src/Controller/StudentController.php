<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StType;
use App\Form\UpdateyassineType;
use App\Repository\StudentclsRepository;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/student')]
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

    #[Route('/addStudent', name: 'add')]
    public function addStudent(ManagerRegistry $mg,Request $req): Response
    {
        $st1=new Student();
        $form=$this->createForm(StType::class,$st1);
        $form->handleRequest($req);
if($form->isSubmitted()){
      $em= $mg->getManager();
      $em->persist($st1);
      $em->flush();
      return $this->redirectToRoute('second');
    }
        return  $this->render('student/addst.html.twig', [
            'f'=>$form->createView()
        ]);
    }


    #[Route('/update/{id}', name: 'update')]
    public function updateStudent(ManagerRegistry $mg,Request $req,$id,StudentRepository $repo): Response
    {
        $st1=$repo->find($id);
        $form=$this->createForm(UpdateyassineType::class,$st1);
        $form->handleRequest($req);
if($form->isSubmitted()){
      $repo->add($st1,true);
      return $this->redirectToRoute('second');
    }
        return  $this->render('student/addst.html.twig', [
            'f'=>$form->createView()
        ]);
    }

    
    #[Route('/dql/{id}', name: 'dql')]
    public function dql(EntityManagerInterface $em,$id)
    {
$req=$em->createQuery("select s.ref,c.name from App\Entity\Student s join s.classroom c where c.name=:name");
$req->setParameter('name',$id);
$result=$req->getResult();
dd($result);
    }
    #[Route('/searchByClass', name: 'searchByClass')]
    public function searchByClass(StudentclsRepository $repo)
    {
$res=$repo->fetchStudentByClass('347');
return  $this->render('student/dql.html.twig', [
    'result'=>$res
]);
    }

    #[Route('/qb', name: 'qb')]
    public function qb(StudentRepository $repo)
    {
$res=$repo->myfindAll('347');
dd($res);
return  $this->render('student/dql.html.twig', [
    'result'=>$res
]);
    }
}
