<?php

namespace App\Form;

use App\Entity\Jobs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class JobsRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title_job', TextType::class, [
                "label" => "appjobs.titleJob",
                "attr" => [
                    'placeholder' => 'appjobs.titleJob'],
                "constraints" => [
                    new NotBlank,
                    new length([
                        "min" => 3,
                        "max" => 30,
                        "minMessage" => "error.min.titleJob (mini 3 caracterers",
                        "maxMessage" => "error.max.titleJob (max 30 caracteres)",
                    ]),
                ],
            ])

            ->add('places_job', TextType::class, [
                "label" => "appjobs.placesJob",
                "attr" => [
                    'placeholder' => 'appjobs.placesJob'],
                "constraints" => [
                    new Regex([
                        "pattern" => "/^[A-Za-z\\xC0-\\xDF][A-Za-z\\xC0-\\xDF\\xE0-\\xFF-\\s]{1,32}$/u",
                        "message" => "error.placesJob",
                    ]),
                ],
            ])

            ->add('postal_code_job', TextType::class, [
                "label" => "appjobs.postalJob",
                "attr" => [
                    'placeholder' => 'appjobs.postalJob'],
                "constraints" => [
                    new notBlank,
                    new Regex([
                        "pattern" => "/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$/u",
                        "message" => "error.postalJob",
                    ]),
                ],
            ])

            ->add('nameComp_job', TextType::class, [
                "label" => "appjobs.nameComp",
                "attr" => [
                    'placeholder' => 'appjobs.nameComp'],
                "constraints" => [
                    new NotBlank,
                    new Regex([
                        "pattern" => "/^[A-Za-z1-9\\xC0-\\xDF][A-Za-z1-9\\xC0-\\xDF\\xE0-\\xFF-\\s]{1,32}$/u",
                        "message" => "error.nameComp",
                    ]),
                ],
            ])

            ->add('salaryRange_job', IntegerType::class, [
                "label" => "appjobs.salaryRange",
                "attr" => [
                    'placeholder' => 'appjobs.salaryRange'],
                "constraints" => [
                    new Regex([
                        "pattern" => "/[0-9]/u",
                        "message" => "error.salaryRange",
                    ]),
                ],
            ])

            ->add('description_job', TextareaType::class, [
                "label" => "appjobs.description",
                "attr" => [
                    'placeholder' => 'appjobs.description'],
            ])

            ->add('phone_job', TelType::class, [
                "label" => "appusers.phone",
                "attr" => [
                    'placeholder' => 'appusers.phone'],
                "constraints" => [
                    new Regex([
                        "pattern" => "/^0[1-68]([-. ]?[0-9]{2}){4}$/",
                        "message" => "error.phone",
                    ]),
                ],
            ])

            ->add('mail_job', EmailType::class, [
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
            'data_class' => Jobs::class,
        ]);
    }
}
