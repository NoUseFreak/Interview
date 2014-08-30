<?php

namespace NoUseFreak\InterviewBundle\Form\Type;

use NoUseFreak\InterviewBundle\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InlineQuestionType extends AbstractType
{
    protected $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', 'hidden', array(
                'data' => $this->question->getId(),
            ))
            ->add('answer', 'textarea', array(
                    'required' => false,
                    'label' => $this->question->getQuestion(),
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'label' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'nousefreak_interviewbundle_type_inline_question';
    }
}
