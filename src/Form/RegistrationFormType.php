<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Sodium\add;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('nom',TextType::class)
            ->add('prenom')
            ->add('dateNaissance',DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],

            ])
            ->add('sexe',ChoiceType::class,[
                'choices' => [
                    User::SEXE_FEMME => User::SEXE_FEMME,
                    User::SEXE_HOMME => User::SEXE_HOMME
                ]
            ])
            ->add('ville')
            ->add('pays',CountryType::class)
            ->add('tel',TextType::class,[
                'attr' => [
                    'placeholder' => "ex: 33755548507"

                ]
            ])
            ->add('codePostal')
            ->add('nbrEnfants',IntegerType::class,[
                'disabled' => true,

            ])
            ->add('adresse',TextareaType::class)
            ->add('isMarried',CheckboxType::class,[
                'required' => false,

            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
