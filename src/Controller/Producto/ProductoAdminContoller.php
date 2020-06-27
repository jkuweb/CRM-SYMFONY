<?php


namespace App\Controller\Producto;


use App\Entity\Producto;
use App\Form\ProductoFormType;
use App\Repository\ProductoRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/producto")
 */
class ProductoAdminContoller extends AbstractController
{
    /**
     * @Route("/agregar", name="producto_agregar")
     */
    public function agregar(Request $request, FileUploader $fileUploader)
    {
        $form = $this->createForm(ProductoFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Producto $producto */
            $producto = $form->getData();
            $fileNames = [];
            foreach ($request->files->get('producto_form')['imagenes'] as $imageFile) {
                if($imageFile && $imageFile !== null) {
                    $fileNames[] = $fileUploader->upload($imageFile);
                }
            }
            $producto->setImagenes($fileNames);
            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush();

            return $this->redirectToRoute('producto_ver', [
                'id' => $producto->getId()
            ]);
        }
        return $this->render('dashboard/producto/producto_agregar.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/ver/{id}", name="producto_ver")
     */
    public function ver(Producto $producto)
    {
        return $this->render('dashboard/producto/producto_ver.html.twig', [
            'producto' => $producto
        ]);
    }

    /**
     * @Route("/editar/{id}", name="producto_editar")
     */
    public function editar(Producto $producto, Request $request, FileUploader $fileUploader)
    {
        $form = $this->createForm(ProductoFormType::class, $producto);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $fileNames = [];
            foreach ($request->files->get('producto_form')['imagenes'] as $imageFile) {
                if($imageFile && $imageFile !== null) {
                    $fileNames[] = $fileUploader->upload($imageFile);
                }
            }
            $producto->setImagenes($fileNames);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('producto_ver', [
                'id' => $producto->getId()
            ]);
        }
        return $this->render('dashboard/producto/producto_editar.html.twig', [
            'form' => $form->createView(),
            'imagenes' => $producto->getImagenes() //  FIXME revisar si se puede hacer de otra forma
        ]);
    }

    /**
     * @Route("/listar", name="producto_listar")
     */
    public function listar(ProductoRepository $productoRepository)
    {
        $productos = $productoRepository->findAll();

        return $this->render('dashboard/producto/producto_listar.html.twig', [
            'productos' => $productos
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="producto_eliminar")
     */
    public function eliminar(Producto $producto)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($producto);
        $em->flush();

        return $this->redirectToRoute("producto_listar");
    }

}