<?php

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class TransformedType
 * @author cyril
 */
class TransformedType extends AbstractType implements DataTransformerInterface
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer($this);
    }
    public function getParent()
    {
        return TextType::class;
    }
    public function transform($value)
    {
        return "transformed(" . $value . ")";
    }
    public function reverseTransform($value)
    {
        return  "reverseTransform(" . $value . ")";
    }
}
