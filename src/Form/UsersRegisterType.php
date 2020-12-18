<?php

namespace App\Form;

use App\Entity\AppRoles;
use App\Entity\AppUsers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class UsersRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                "label" => "appusers.username",
                "required" => true,
                "attr" => [
                    'placeholder' => 'appusers.username'],
                "constraints" => [
                    new NotBlank,
                    new length([
                        "min" => 3,
                        "max" => 16,
                        "minMessage" => "error.min.username",
                        "maxMessage" => "error.max.username",
                    ]),
                ],
            ])

            ->add('firstname', TextType::class, [
                "label" => "appusers.firstname",
                "attr" => [
                    'placeholder' => 'appusers.firstname'],
                "constraints" => [
                    new Regex([
                        "pattern" => "/^[A-Za-z\\xC0-\\xDF][A-Za-z\\xC0-\\xDF\\xE0-\\xFF-\\s]{1,32}$/u",
                        "message" => "error.firstname",
                    ]),
                ],
            ])

            ->add('lastname', TextType::class, [
                "label" => "appusers.lastname",
                "attr" => [
                    'placeholder' => 'appusers.lastname'],
                "constraints" => [
                    new Regex([
                        "pattern" => "/^[A-Za-z\\xC0-\\xDF][A-Za-z\\xC0-\\xDF\\xE0-\\xFF-\\s]{1,32}$/u",
                        "message" => "error.lastname",
                    ]),
                ],
            ])

            ->add('password', RepeatedType::class, [
                "type" => PasswordType::class,
                "invalid_message" => "error.password",
                "help" => 'Entre 6 et 20 caractères',
                "first_options" => [
                    "label" => "appusers.password",
                    "attr" => [
                        'placeholder' => 'appusers.password'],
                    "constraints" => [
                        new NotBlank(),
                        new length([
                            "min" => 6,
                            "max" => 20,
                            "minMessage" => "error.min.password",
                            "maxMessage" => "error.max.password",
                        ]),
                    ],
                ],
                "invalid_message" => "error.confirm",
                "second_options" => [
                    "label" => "appusers.confirm",
                    "attr" => [
                        'placeholder' => 'appusers.confirm'],
                ],
            ])

            ->add('phone', TelType::class, [
                "label" => "appusers.phone",
                "help" => 'Téléphone de 10 chiffres',
                "attr" => [
                    'placeholder' => 'appusers.phone'],
                "constraints" => [
                    new Regex([
                        "pattern" => "/^0[1-68]([-. ]?[0-9]{2}){4}$/",
                        "message" => "error.phone",
                    ]),
                ],
            ])

            ->add('mail', EmailType::class, [
                "label" => "appusers.mail",
                "attr" => [
                    'placeholder' => 'appusers.mail'],
                "constraints" => [
                    new NotBlank,
                    new Regex([
                        "pattern" => "/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/",
                        "message" => "error.mail",
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppUsers::class,
        ]);
    }
}
