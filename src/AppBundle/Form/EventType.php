<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $myEntity = $builder->getForm()->getData();
        $builder
                ->add('title')
                ->add('shortTitle')
                ->add('path', 'text', ['label' => 'URL Path', 'attr' => ['help' => 'URL Path help']])
                ->add('headline')
                ->add('actionBtnText')
                ->add('description')
                ->add('startDate', 'collot_datetime', array(
                    'label' => 'Start Date',
                    'attr' => array('class' => 'datepicker'),
                    'date_format' => 'dd-MM-yyyy',
                    'pickerOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'startView' => 'month',
                        'minView' => 'month',
                        'todayBtn' => 'true',
                        'todayHighlight' => 'true',
                        'autoclose' => 'true',
                    ],
                        )
                )
                ->add('endDate', 'collot_datetime', array(
                    'label' => 'End Date',
                    'attr' => array('class' => 'datepicker'),
                    'date_format' => 'dd-MM-yyyy',
                    'pickerOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'startView' => 'month',
                        'minView' => 'month',
                        'todayBtn' => 'true',
                        'todayHighlight' => 'true',
                        'autoclose' => 'true',
                    ],
                        )
                )
                ->add('headerImage', 'comur_image', array(
                    'uploadConfig' => array(
                        'uploadRoute' => 'comur_api_upload', //optional
                        'uploadUrl' => $myEntity->getUploadRootDir(), // required - see explanation below (you can also put just a dir path)
                        'webDir' => $myEntity->getUploadDir(), // required - see explanation below (you can also put just a dir path)
                        'fileExt' => '*.jpg;*.gif;*.png;*.jpeg', //optional
                        'libraryDir' => null, //optional
                        'libraryRoute' => 'comur_api_image_library', //optional
                        'showLibrary' => true, //optional
                    //'saveOriginal' => 'originalImage'           //optional
                    ),
                    'cropConfig' => array(
                        'minWidth' => 700,
                        'minHeight' => 150,
                        'aspectRatio' => true, //optional
                        'cropRoute' => 'comur_api_crop', //optional
                        'forceResize' => false, //optional
                        'thumbs' => array(//optional
                            array(
                                'maxWidth' => 350,
                                'maxHeight' => 75,
                                'useAsFieldImage' => true  //optional
                            )
                        )
                    )
                ))
                ->add('footerText')
                ->add('reservationDeadline', 'collot_datetime', array(
                    'label' => 'Reservation Deadline',
                    'attr' => array('class' => 'datepicker'),
                    'date_format' => 'dd-MM-yyyy',
                    'pickerOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'startView' => 'month',
                        'minView' => 'month',
                        'todayBtn' => 'true',
                        'todayHighlight' => 'true',
                        'autoclose' => 'true',
                    ],
                        )
                )
                ->add('cancellationPolicy')
                ->add('paymentTerms')
                ->add('venues')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_event';
    }

}
