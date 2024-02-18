<?php
namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('desc_arabic', TextareaType::class, [
                'required' => false,
                'attr' => ['maxlength' => 1500]
            ])
            ->add('desc_french', TextareaType::class, [
                'required' => false,
                'attr' => ['maxlength' => 1500]
            ])
            ->add('desc_spanish', TextareaType::class, [
                'required' => false,
                'attr' => ['maxlength' => 1500]
            ])
            ->add('link', TextType::class, ['required' => false])
            ->add('image', FileType::class, ['required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
