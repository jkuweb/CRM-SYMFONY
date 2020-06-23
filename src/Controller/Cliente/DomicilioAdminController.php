<?php


namespace App\Controller\Cliente;


use App\Entity\Cliente;
use App\Form\DomicilioFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DomicilioAdminController extends AbstractController
{
    /**
     * @Route("domicilio/ver/{id}", name="domicilio_ver")
     */
    public function ver(Cliente $cliente)
    {
        $domilicio = $cliente->getDomicilio();

        return $this->render('dashboard/domicilio/domicilio_ver.html.twig', [
            'domicilio' => $domilicio,
            'clienteId' => $cliente->getId()
        ]);
    }

    /**
     * @Route("/domicilio/editar/{id}", name="domicilio_editar")
     */
    public function editar(Cliente $cliente, Request $request)
    {
        $form = $this->createForm(DomicilioFormType::class, $cliente->getDomicilio());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $domicilio = $form->getData();
            $cliente->setDomicilio($domicilio);
            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush();

            return $this->redirectToRoute("domicilio_ver", [
                'id' => $cliente->getId()
            ]);
        }

        return $this->render('dashboard/domicilio/domicilio_editar.html.twig', [
            'form' => $form->createView()
        ]);
    }

}