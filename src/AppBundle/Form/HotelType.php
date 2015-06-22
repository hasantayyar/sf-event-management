<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HotelType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name')
                ->add('stars', 'number', array('attr' => array("help" => "1-5", "type" => "number", "class" => "mask", "data-inputmask" => "'mask': '9'")))
                ->add('country', 'entity', array(
                    'label' => 'Country',
                    'class' => 'AppBundle\Entity\Country',
                    'property' => 'country_name',
                    'multiple' => false,
                    'expanded' => false,
                    'required' => false,
                    'attr' => [
                        'class' => 'select2-element validate[required]',
                    ],
                        )
                )
                ->add('city', 'text', ['attr' => ['class' => 'capitalize']])
                ->add('contact')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Hotel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_hotel';
    }

}
