<?php

namespace App\Controller\admin;

use App\Entity\Jobs;
use App\Entity\AppRoles;
use App\Entity\AppUsers;
use App\Entity\Contrast;
use App\Entity\CategoryJob;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Form\UsersRegisterType;
use Symfony\Component\Form\Form;
use App\Repository\AppUsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController  extends AbstractController
{
    /**
     * @Route("/newRoles", name="newRoles")
     * 
     */
    public function newRoles(Request $request)
    {
        $nameRoles = new AppRoles();
        $nameRoles->setName('');

        $form = $this->createFormBuilder($nameRoles)
            ->add('name', TextType::class, [                
                "attr" => [
                    'placeholder' => 'admin.role.name'],])
            ->add('value', TextType::class, [                
                "attr" => [
                    'placeholder' => 'admin.role.value'],])
            ->add('save', SubmitType::class, array('label' => 'Create Roles'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nameRoles = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($nameRoles);
            $em->flush();

            return new Response("Roles ajouté");
        }
        return $this->render('newDataAdmin/newRoles.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/newCategoryJob", name="newCategoryJob")
     * 
     */
    public function newCategoryJob(Request $request)
    {
        $nameCategory = new CategoryJob();
        $nameCategory->setNameCat('');

        $form = $this->createFormBuilder($nameCategory)
            ->add('name_cat', TextType::class, [                
                "attr" => [
                    'placeholder' => 'admin.category.name'],])
            ->add('save', SubmitType::class, array('label' => 'Create Categorie'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nameRoles = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($nameCategory);
            $em->flush();

            return new Response("Categorie ajouté");
        }
        return $this->render('newDataAdmin/newCategoryJob.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/newContrast", name="newContrast")
     * 
     */
    public function newContrast(Request $request)
    {
        $nameContrast = new Contrast();
        $nameContrast->setTypeContrast('');

        $form = $this->createFormBuilder($nameContrast)
            ->add('type_contrast', TextType::class, [                
                "attr" => [
                    'placeholder' => 'admin.contrast.type'],])
            ->add('save', SubmitType::class, array('label' => 'Create Contrast'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nameRoles = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($nameContrast);
            $em->flush();

            return new Response("Contrat ajouté");
        }
        return $this->render('newDataAdmin/newCategoryJob.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}