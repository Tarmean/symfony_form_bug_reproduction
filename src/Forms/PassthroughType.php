<?php

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class PassthroughContainer
 * @author cyril
 */
class PassthroughType extends AbstractType implements DataTransformerInterface
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer($this);
        $builder->add("child", TextType::class);
    }
    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        $resolver->addAllowedTypes('data_class', ["null", "string[]", "string"]);
    }
    public function transform($value)
    {
        return ["child" => "transformed(" . $value["child"] . ")"];
    }
    public function reverseTransform($value)
    {
        return ["child" => "reverseTransformed(" . $value["child"] . ")"];
    }
}

