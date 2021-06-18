<?php

namespace App\Form;

use App\Entity\Candidat;

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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class RegistrationFormType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)
            ->add('nom',TextType::class)
            ->add('prenom')
            ->add('dateNaissance',DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],

            ])
            ->add('sexe',ChoiceType::class,[
                'choices' => [
                    Candidat::SEXE_FEMME => Candidat::SEXE_FEMME,
                    Candidat::SEXE_HOMME => Candidat::SEXE_HOMME
                ]
            ])
            ->add('ville')
            ->add('pays',CountryType::class)
            ->add('tel',TelType::class)
            ->add('codePostal')
            ->add('isMarried',CheckboxType::class)

            ->add('isHaveChildren',CheckboxType::class)
            ->add('nbrEnfants',IntegerType::class)
            ->add('adresse',TextareaType::class)



        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
