<?php

namespace App\Form\Type;

use App\Entity\DiscountCoupons;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddDiscountCouponType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
                array('required' => true,
                    'label' => 'Name',
                    'label_attr' => array('style' => 'font-size:20px;')
                ))
            ->add('description', TextareaType::class,
                array(
                    'required' => true,
                    'label' => 'Description',
                    'attr' => array('style' => "height:150px;"),
                    'label_attr' => array(
                        'style' => 'font-size:20px;'
                    )))
            ->add('start_date',  DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('save', SubmitType::class,
                array('attr' => array('class' => 'pull-left btn btn-success'))
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => DiscountCoupons::class));
    }

    public function getName()
    {
        return 'DiscountCoupons';
    }
}