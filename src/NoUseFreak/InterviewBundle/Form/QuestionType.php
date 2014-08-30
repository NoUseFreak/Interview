<?php

namespace NoUseFreak\InterviewBundle\Form;

use NoUseFreak\InterviewBundle\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('question')
            ->add('type', 'choice', array(
                'choices' => array(
                    Question::TYPE_TERM => Question::TYPE_TERM,
                    Question::TYPE_PROBLEM => Question::TYPE_PROBLEM,
                    Question::TYPE_MULTI => Question::TYPE_MULTI,
                )
            ))
            ->add('difficulty', 'entity', array(
                'class' => 'NoUseFreakInterviewBundle:QuestionDifficulty',
            ))
            ->add('category', 'entity', array(
                'class' => 'NoUseFreakInterviewBundle:QuestionCategory',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NoUseFreak\InterviewBundle\Entity\Question'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'nousefreak_interviewbundle_question';
    }
}
