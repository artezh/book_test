<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Component\Form\{
    AbstractType, FormBuilderInterface, FormEvent, FormEvents
};
use Symfony\Component\Form\Extension\Core\Type\{NumberType, SubmitType, TextType};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class BookFormType
 * @package App\Form
 */
class BookFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Название',
                'required' => true,
                'error_bubbling' => true,
            ])
            ->add('author', EntityType::class, [
                'label' => 'Автор',
                'class' => Author::class,
                'choice_label' => 'name',
                'required' => true,
                'error_bubbling' => true,
            ])
            ->add('price', NumberType::class, [
                'label' => 'Цена в копейках',
                'required' => true,
                'error_bubbling' => true,
            ])
            ->add('button', SubmitType::class, [
                'label' => 'Редактировать',
                'attr' => [
                    'class' => 'btn_blue'
                ]
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            if ($book = $event->getData()) {
                $form = $event->getForm();

                if (null === $book->getId()) {
                    // Меняем название кнопки
                    $attr = $form->get('button')->getConfig()->getAttributes();
                    if (array_key_exists('data_collector/passed_options', $attr)) {
                        $options = $attr['data_collector/passed_options'];
                        $options['label'] = 'Добавить';

                        $form->add('button', SubmitType::class, $options);
                    }
                }
            }
        });
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
            'cascade_validation' => false,
            'error_bubbling' => true
        ]);
    }
}