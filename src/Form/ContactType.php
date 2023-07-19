<?php

namespace App\Form;

use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user-lastname', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
                    'class' => 'contact-form-field'
                ]
            ])
            -> add('user-firstname', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'class' => 'contact-form-field'
                ]
            ])
            ->add('user-email', EmailType::class, [
                'label' => 'Votre email',
                'attr' => [
                    'class' => 'contact-form-field'
                ]
            ])
            ->add('user-telephone', TextType::class, [
                'label' => 'Votre numéro de téléphone',
                'attr' => [
                    'class' => 'contact-form-field'
                ]
            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'attr' => [
                    'class' => 'contact-form-field field-subject',
                ]
            ])
            ->add('user-message', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => [
                    'class' => 'contact-form-field'
                ]
            ])
            ->add('submit-form', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
