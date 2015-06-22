<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class VenueHallType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $venue = $options['venue'];
        $builder
                ->add('name')
                ->add('shortName')
                ->add('capacity')
                ->add('venue', 'entity', array(
                    'class' => 'AppBundle:Venue',
                    'query_builder' => function (EntityRepository $er) use($venue) {
                        $qb = $er->createQueryBuilder('v');
                        if ($venue) {
                            $qb->where('v.id = ?1')
                            ->setParameter(1, $venue->getId());
                        }
                        return $qb;
                    }
                        )
                )
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\VenueHall',
            'venue' => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_venuehall';
    }

}
