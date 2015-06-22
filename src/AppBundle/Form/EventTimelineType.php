<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventTimelineType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title')
                ->add('description')
                ->add('date', 'collot_datetime', array(
                    'label' => 'Date',
                    'attr' => array('class' => 'datetimepicker'),
                    'format' => 'yyyy-mm-dd',
                    'pickerOptions' => [
                        'forceParse' => true,
                        'minuteStep' => 5,
                        'pickerReferer ' => 'default', //deprecated
                        'pickerPosition' => 'bottom-right',
                        'viewSelect' => 'hour',
                        'format' => 'mm/dd/yyyy',
                        'weekStart' => 0,
                        'startDate' => date('m/d/Y'), //example
                        'endDate' => '01/01/2020', //example 
                        'autoclose' => false,
                        'startView' => 'month',
                        'minView' => 'hour',
                        'maxView' => 'decade',
                        'todayHighlight' => 'true',
                    ],
                        )
                )
                ->add('event')
                ->add('icon', 'choice', array(
                    'attr' => ['class' => 'iconselector'],
                    'choices' => ['hotel' => 'Hotel', 'ticket' => 'Ticket', 'car' => 'Car', 'bus' => 'Bus',
                        'plane' => 'Plane', 'bicycle' => 'Bicycle', 'glass' => 'Glass', 'flash' => 'Flash',
                        'camera' => 'Camera', 'coffee' => 'Coffee', 'beer' => 'Beer', 'birthday-cake' => 'Birthday Cake',
                        'comments' => 'Comments', 'credit-card' => 'Credit Card', 'cutlery' => 'Cutlery', 'shopping-cart' => 'Shopping']
                        )
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\EventTimeline'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_eventtimeline';
    }

}
