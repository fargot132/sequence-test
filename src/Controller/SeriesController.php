<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SequenceFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\SequenceCalc;
use App\Entity\InputData;
use App\Validator\Constraints\SequenceTextareaValidator;

class SeriesController extends AbstractController
{
    
   /**
    * @Route("/", name="homepage")
    */
    public function homepage(Request $request)
    {
        $input = new InputData();
        $form = $this->createForm(SequenceFormType::class, $input);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $seq = new SequenceCalc($input);
            $seq->processData();
            return $this->render('sequence/sequence.html.twig', ['results' => $seq->getResult()]);
        }
        
        return $this->render('sequence/sequenceForm.html.twig', [
            'form' => $form->createView()]);
    }
}
