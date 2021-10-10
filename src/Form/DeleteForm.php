<?php

namespace App\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\{
    AbstractType, FormBuilderInterface
};
use Symfony\Component\Form\Extension\Core\Type\{
    ResetType, SubmitType
};

/**
 * Форма подтверждения удаления
 *
 * Class ContractLocationDeleteForm
 * @package App\Form
 */
class DeleteForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reset', ResetType::class, [
                'label' => 'Cancel',
                'attr' => [
                    'class' => 'button button__blue',
                    'onclick' => 'history.go(-1);'
                ]
            ])
            ->add('button', SubmitType::class, [
                'label' => 'Delete',
                'attr' => [
                    'class' => 'button'
                ]
            ])
        ;
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'cascade_validation' => false,
            'error_bubbling' => true,
        ]);
    }
}
