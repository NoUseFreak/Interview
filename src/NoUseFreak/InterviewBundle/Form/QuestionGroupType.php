<?php

namespace NoUseFreak\InterviewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionGroupType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('questions', 'entity', array(
                    'class' => 'NoUseFreakInterviewBundle:Question',
                    'multiple'    => true,
                    'by_reference' => false,
                    'required' => false,
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NoUseFreak\InterviewBundle\Entity\QuestionGroup'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'nousefreak_interviewbundle_questiongroup';
    }
}
