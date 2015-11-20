<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Producto;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductoController extends Controller
{
    /**
     * @Route(
     *     path = "/",
     *     name = "app_producto_index"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $m = $this->getDoctrine()->getManager();

        /*
        $prod1 = new Producto();
        $prod1
            ->setNombre('PapelFA4S')
            ->setDescripcion('Papel de Fotocopiadora Formato A4 Satinado')
            ->setPrecio('5.47')
            ;
        $m->persist($prod1);

        $prod2 = new Producto();
        $prod2
            ->setNombre('PapelFA5N')
            ->setDescripcion('Papel de Fotocopiadora Formato A5 Normal')
            ->setPrecio('4.46')
        ;
        $m->persist($prod2);

        $prod3 = new Producto();
        $prod3
            ->setNombre('BicATr')
            ->setDescripcion('Caja bolígrafos Bic - Tinta Azul - Transparente')
            ->setPrecio('3.56')
        ;
        $m->persist($prod3);

        $m->flush();die;*/

        $repository = $m->getRepository("AppBundle:Producto");

        $prod = $repository->findAll();

        return $this->render(':producto:index.html.twig',
            [
                'producto' => $prod
            ]
            );
    }

    /**
     * Actualizar producto
     *
     * @Route(
     *     path = "/update/{id}",
     *     name = "app_producto_update"
     * )
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Producto');

        $prod = $repository->find($id);

        return $this->render(':producto:update.html.twig',
            [
                'prod' => $prod
            ]);
    }

    /**
     * doUpdateAction
     *
     * @Route(
     *     path = "/do-update",
     *     name = "app_producto_doUpdate"
     * )
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function doUpdateAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Producto');

        $id = $request->request->get('id');
        $nombre = $request->request->get('nombre');
        $descripcion = $request->request->get('descripcion');
        $precio = $request->request->get('precio');

        $prod = $repository->find($id);

        $prod->setNombre($nombre);
        $prod->setDescripcion($descripcion);
        $prod->setPrecio($precio);

        $m->flush();

        $this->addFlash('messages', 'Producto actualizado');

        return $this->redirectToRoute('app_producto_index');
    }

    /**
     * introdAction
     *
     * @Route(
     *     path = "/nuevo",
     *     name = "app_producto_introd"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introdAction()
    {
        return $this->render(':producto:introd.html.twig');
    }

    /**
     * doIntrodAction
     *
     * @Route(
     *     path = "/do-introd",
     *     name = "app_producto_doIntrod"
     * )
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function doIntrodAction(Request $request){

        $nombre = $request->request->get('nombre');
        $descripcion = $request->request->get('descripcion');
        $precio = $request->request->get('precio');

        $m = $this->getDoctrine()->getManager();

        $prod = new Producto();

        $prod
            ->setNombre($nombre)
            ->setDescripcion($descripcion)
            ->setPrecio($precio)
            ;

        $m->persist($prod);
        $m->flush();

        $this->addFlash('messages', 'Producto Creado');

        $repository = $m->getRepository("AppBundle:Producto");

        $prod = $repository->findAll();

        return $this->render(':producto:index.html.twig',
            [
                'producto' => $prod
            ]
        );
    }

    /**
     * removAction
     *
     * @Route(
     *     path = "/remov/{id}",
     *     name = "app_producto_remov"
     * )
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Producto');

        $prod = $repository->find($id);

        $m->remove($prod);
        $m->flush();

        $this->addFlash('messages', 'Producto eliminado.');

        return $this->redirectToRoute('app_producto_index');
    }
}
