<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransferPointType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name')
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
                ->add('city')
                ->add('fullAddress')
                ->add('latitude', 'text', array('attr' => array('class' => 'gllpLatitude'), 'label' => 'Latitude'))
                ->add('longitude', 'text', array('attr' => array('class' => 'gllpLongitude'), 'label' => 'Longitude'))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TransferPoint'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_transferpoint';
    }

}
