<?php

namespace App\Controller;

use Throwable;
use App\Entity\Jobs;
use App\Entity\AppUsers;
use App\Entity\Contrast;
use App\Entity\UsersJobs;
use App\Entity\CategoryJob;

use App\Form\JobsRegisterType;
use Doctrine\ORM\EntityManager;

use Symfony\Component\Form\Form;
use Doctrine\ORM\Mapping\OrderBy;
use App\Form\CategoryRegisterType;
use App\Repository\JobsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AppController extends AbstractController
{

    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('app/index.html.twig');        
    }

    private function addContrast(Form $form): Form
    {
        return $form->add("contrast", EntityType::Class,[
            "label" => "appjobs.contrast",
            "class" => Contrast::Class,
            "choice_label" => "type_contrast",
            "expanded" => true,
            "multiple" => false,
        ]);
    }

    private function addCategory(Form $form): Form
    {
        return $form->add("category", EntityType::Class,[
            "label" => "appjobs.category",
            "class" => CategoryJob::Class,
            "choice_label" => "name_cat",
            "expanded" => false,
            "multiple" => false,
            "required" => true,
        ]);
    }

    /**
     * @Security("is_granted('ROLE_EMPLOYER')")
     * @Route("/newJob", name="newJob")
     */
    function newJob (Request $request, TranslatorInterface $trans) 
    {
        $newJob = new Jobs();
        $form = $this->createForm(JobsRegisterType::class, $newJob);
        $this->addContrast($form);
        $this->addCategory($form);

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user->getId();

        $usersJobs = new UsersJobs();
        $usersJobs->setJobs($newJob);
        $usersJobs->setUsers($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newJob);
            $em->persist($usersJobs);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('action', 'Enregistrement réussi');
            return $this->render('security/message.html.twig');
        }
        return $this->render('job/newJob.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function utilisateur()
    {
        return $this->render('data/utilisateur.html.twig');
    }
    
    /**
     * @Route("/showJob", name="showJob")
     */
    public function showJob(Request $request, PaginatorInterface $paginator)
    {        
        $CategoryJobs = $this->getDoctrine()->getManager()->getRepository(CategoryJob::class)->findAll();

        $em = $this->getDoctrine()->getManager()->getRepository(Jobs::class);
        $allJobsQuery = $em->createQueryBuilder('j')
            ->getQuery()
            ->getResult();

        $jobs = $paginator->paginate(
            $allJobsQuery,
            $request->query->getInt('page', 1), 5
        );
        return $this->render('job/showJob.html.twig', [
            'jobs' => $jobs,
            'CategoryJobs' => $CategoryJobs,
        ]);
    }

    /**
     * @Route("/showJobByTitle", name="showJobByTitle")
     */
    public function showJobByTitle(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager()->getRepository(Jobs::class);
        $allJobsQuery = $em->createQueryBuilder('j')
            ->orderBy('j.title_job')
            ->getQuery();
    
        // $paginator = $this->get('knp_paginator');
    
        $jobs = $paginator->paginate(
            $allJobsQuery,
            $request->query->getInt('page', 1), 5
        );
        return $this->render('job/showJob.html.twig', [
            'jobs' => $jobs,
        ]);
    }

	/**
    * @Route("/showJobCategory", name="showJobCategory")
    */
    public function showJobCategory(Request $request, PaginatorInterface $paginator)
    {
        $CategoryJobs = $this->getDoctrine()->getManager()->getRepository(CategoryJob::class)->findall();

        $request = Request::createFromGlobals();
        $valeur = $request->query->get('name_cat');

        $em = $this->getDoctrine()->getManager()->getRepository(Jobs::class);
        $allJobsQuery = $em->createQueryBuilder('j')
            ->join('j.category', 'R')
            ->where('R.name_cat = :name')
            ->setParameter('name', $valeur)
            ->getQuery()
            ->getResult();

        $jobs = $paginator->paginate(
            $allJobsQuery,
            $request->query->getInt('page', 1), 5
        );
        return $this->render('job/showJob.html.twig', [
            'jobs' => $jobs,    
            'CategoryJobs' => $CategoryJobs,
        ]);
    }
    
    /**
     * @Route("/showJobContrast", name="showJobContrast")
     */
    public function showJobContrast(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager()->getRepository(Jobs::class);
        $allJobsQuery = $em->createQueryBuilder('j')
            ->orderBy('j.contrast')
            ->getQuery();

        // $paginator = $this->get('knp_paginator');

        $jobs = $paginator->paginate(
            $allJobsQuery,
            $request->query->getInt('page', 1), 5
        );

        return $this->render('job/showJob.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * @Route("/showJobCity", name="showJobCity")
     */
    public function showJobCity(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager()->getRepository(Jobs::class);
        $allJobsQuery = $em->createQueryBuilder('j')
            ->orderBy('j.postal_code_job')
            ->getQuery();

        // $paginator = $this->get('knp_paginator');

        $jobs = $paginator->paginate(
            $allJobsQuery,
            $request->query->getInt('page', 1), 5
        );

        return $this->render('job/showJob.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * @Route("/showSpecJob/{id}", name="showSpecJob")
     */
    public function showSpecJob(Jobs $job, Request $request)
    {     
        $jobs = $this->getDoctrine()->getManager()->getRepository(Jobs::class)->findById($job);
        $UserJobs = $this->getDoctrine()->getManager()->getRepository(UsersJobs::class)->findAll();

        return $this->render('job/showSpecJob.html.twig', [
            'jobs' => $jobs,
            'UserJobs' => $UserJobs,
        ]);            
    }
    
    /**
     * @Route("/delete/{id}", name="deleteJob")
     */
    public function deleteJob(Jobs $job, Request $request, TokenStorageInterface $tokenDelete)
    {
        if ($this->isCsrfTokenValid('deleteJob', $request->get('csrf_token')))
        {
        $em = $this->getDoctrine()->getManager();
        $em->remove($job);
        $em->flush();

        $request->getSession()
        ->getFlashBag()
        ->add('action', 'Success Delete');
        return $this->render('security/message.html.twig');
        } else {
            $request->getSession()
            ->getFlashBag()
            ->add('action', 'Invalid Token. Delete not possible' );
            return $this->render('security/message.html.twig');
        }
    }

    /**
     * @Route("/update/{id}", name="updateJob")
     */
    public function updateJob(Jobs $job, Request $request, TokenStorageInterface $token)
    {
        if ($this->isCsrfTokenValid('updateJob', $request->get('csrf_token')))
        {
        $form = $this->createForm(JobsRegisterType::class, $job);
        $this->addContrast($form);
        $this->addCategory($form);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager()->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('action', 'Modification de l\'offre réussi');
            return $this->render('security/message.html.twig');
        }
        return $this->render('job/updateJob.html.twig', [
            'form' => $form->createView(),
        ]);
    } else {
        $request->getSession()
        ->getFlashBag()
        ->add('action', 'Invalid Token. Update not possible' );
        return $this->render('security/message.html.twig');
        }
    }

    /**
     * @Route("/newCv", name="newCv")
     */
    public function newCv()
    {
        return $this->render('cv/newCv.html.twig');
    }

    /**
     * @Route("/showCv", name="showCv")
     */
    public function showCv()
    {
        return $this->render('cv/showCv.html.twig');
    }

    /**
     * @Route("/candidateAccueil", name="candidateAccueil")
     */
    public function candidateAccueil()
    {
        return $this->render('cv/candidateAccueil.htlm.twig');
    }
}
