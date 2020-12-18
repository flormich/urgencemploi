<?php

namespace App\Controller\security;

use App\Entity\AppRoles;
use App\Entity\AppUsers;

use App\Controller\security;
use App\Form\UsersRegisterType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use App\Repository\AppUsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    // /**
    //  * @Route("/user/index", name="index")
    //  */
    // public function index()
    // {
    //     return $this->render('security/index.html.twig');
    // }

    /**
     * @Route("/login", name="security_login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() : void
    {
    }

    public function multi($a, $b)
    {
        return $a * $b;
    }

    private function addRole(Form $form): Form
    {
        return $form->add("role", EntityType::Class,[
            "label" => "administration.role.yourRole",
            "class" => AppRoles::Class,
            "choice_label" => function($choiceValue, $key, $value) {
                if ($key === 2) {
                    return ' ';
                } else if ($value == 1) {
                    return 'Employeur';
                }
                return 'Candidat';
            },
            "choice_attr" => function ($choiceValue, $key, $value){
                if ($key === 2){
                    return ['disabled' => 'disabled', 'style' => 'display:none'];
                }
                return ['disabled' => false];
            },
            "constraints" => [
                new NotBlank
            ],
            "expanded" => true,
            "multiple" => false,
        ]);
    }

    /**
     * @Route("/new", name="usersNew")
     */
    function new (AppUsersRepository $usersRepo, Request $request, TranslatorInterface $trans, UserPasswordEncoderInterface $passwordEncoder) 
    {
        $newUsers = new AppUsers();
        $form = $this->createForm(UsersRegisterType::class, $newUsers);
        $this->addRole($form);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $password = $passwordEncoder->encodePassword($newUsers, $newUsers->getPassword());
            $newUsers->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($newUsers);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('action', 'Enregistrement réussi');
            // return $this->redirectToRoute('login');
            return $this->render('security/message.html.twig');
        }
        return $this->render('security/usersNew.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/validate", name="validate")
     */
    public function validate()
    {
        return $this->render('validate');
    }
}
