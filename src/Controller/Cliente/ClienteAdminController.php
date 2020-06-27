<?php

namespace App\Controller\Cliente;

use App\Entity\Cliente;
use App\Form\ClienteFormType;
use App\Repository\ClienteRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cliente")
 */
class ClienteAdminController extends AbstractController
{
    /**
     * @Route("/agregar", name="cliente_agregar")
     */
    public function agregar(Request $request, FileUploader $fileUploader)
    {
        $form = $this->createForm(ClienteFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            /** @var Cliente $cliente */
            $cliente = $form->getData();
            $imageFile = $form->get('imageFile')->getData();
            if($imageFile && $imageFile !== null) {
               $newFileName = $fileUploader->upload($imageFile);
               $cliente->setImage($newFileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush();

            return $this->redirectToRoute('cliente_ver', [
                'id' => $cliente->getId()
            ]);
        }

        return $this->render('dashboard/cliente/cliente_agregar.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/ver/{id}", name="cliente_ver", methods={"GET"})
     */
    public function ver(Cliente $cliente)
    {
        return $this->render('dashboard/cliente/cliente_ver.html.twig', [
            'cliente' => $cliente,
            'domicilio' => $cliente->getDomicilio(),
        ]);
    }

    /**
     * @Route("/editar/{id}", name="cliente_editar")
     */
    public function editar(Request $request, Cliente $cliente, FileUploader $fileUploader)
    {
        $form = $this->createForm(ClienteFormType::class, $cliente);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();
            if($imageFile && $imageFile !== null) {
                $this->eliminarImagen($cliente);
                $newFileName = $fileUploader->upload($imageFile);
                $cliente->setImage($newFileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('cliente_ver', [
                'id' => $cliente->getId(),
            ]);
        }

        return $this->render('dashboard/cliente/cliente_editar.html.twig', [
            'form' => $form->createView(),
            'image' => $cliente->getImage(),
            'cliente' => $cliente->getId()
        ]);
    }

    /**
     * @Route("/listar", name="cliente_listar")
     */
    public function listar(ClienteRepository $clienteRepository)
    {
        $clientes = $clienteRepository->findAll();

        return $this->render('dashboard/cliente/cliente_listar.html.twig', [
            'clientes' => $clientes
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="cliente_eliminar")
     */
    public function eliminar(Cliente $cliente, ClienteRepository $clienteRepository)
    {
        $this->eliminarImagen($cliente);
        $cliente->setImage("");
        $em = $this->getDoctrine()->getManager();
        $em->remove($cliente);
        $em->flush();

        return $this->redirectToRoute("cliente_listar");
    }

    /**
     * @Route("/cliente/imagen/eliminar/{id}", name="cliente_eliminar_imagen")
     */
    public function eliminarImagen(Cliente $cliente)
    {
        $fileName = $cliente->getImage();
        $uploadDir = $this->getParameter('uploads_directory');
        $file = $uploadDir . '/' . $fileName;
        if(file_exists($file) && $fileName !== null) {
            unlink($file);
        }

       return $this->redirectToRoute("cliente_editar", [
            'id' => $cliente->getId()
        ]);
    }
}
