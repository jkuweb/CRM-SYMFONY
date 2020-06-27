<?php


namespace App\Controller\Pedido;


use App\Entity\Pedido;
use App\Entity\ProductoPedido;
use App\Form\PedidoFormType;
use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pedido")
 */
class PedidoAdminController extends AbstractController
{
    /**
     * @Route("/agregar", name="pedido_agregar")
     */
    public function agregar(Request $request, ProductoRepository $productoRepository)
    {
        $form = $this->createForm(PedidoFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Pedido $pedido */
            $pedido = $form->getData();
            $productoIds = $request->request->get("pedido_form")['producto'];
            foreach ($productoIds as $productoId ) {
                // ProductoPedido
                $productoPedido = new ProductoPedido();
                // Pedido
                $productoPedido->setPedido($pedido);
                // Producto
                $producto = $productoRepository->findOneBy(['id' => $productoId]);
                $productoPedido->setProducto($producto);

                // cantidad
                $cantidad = $request->request->get("pedido_form")['cantidad'];
                $productoPedido->setCantidad($cantidad);
                // total
                $total = $producto->getPrecio() * $productoPedido->getCantidad();
                $productoPedido->setTotal($total);


                $pedido->addProductoPedido($productoPedido);
                $pedido->setFecha(new \DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($pedido);

                $em->flush();
            }
            return $this->redirectToRoute("pedido_ver", [
                'id' => $pedido->getId()
            ]);
        }

        return $this->render('dashboard/pedido/pedido_agregar.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/ver/{id}", name="pedido_ver")
     */
    public function ver(Pedido $pedido)
    {
        return $this->render('dashboard/pedido/pedido_ver.html.twig', [
            'pedido' => $pedido
        ]);
    }

}