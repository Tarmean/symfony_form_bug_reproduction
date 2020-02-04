<?php

namespace App\Controller;

use App\Forms\PassthroughType;
use App\Forms\TransformedType;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class DefaultController
 * @author cyril
 */
class DefaultController extends AbstractController
{
    public function index(): Response
    {
        $b = Forms::createFormFactoryBuilder()->getFormFactory()->createBuilder();
        $b->add("direct", TransformedType::class)
            ->add("indirect", PassthroughType::class);
        $form = $b->getForm();
        $form->submit([
            "direct" => "direct",
            "indirect" => ["child" => "indirect"]
        ]);
        $form = $b->getForm()->setData($form->getData());
        return $this->render('defaulttemplate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
