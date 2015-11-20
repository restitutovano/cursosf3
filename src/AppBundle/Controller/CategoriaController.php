<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categoria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoriaController extends Controller
{
    /**
     * indexAction
     *
     * @Route(
     *     path = "/",
     *     name = "app_categoria_index"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $m = $this->getDoctrine()->getManager();

        /*
        $categoria1 = New Categoria();

        $categoria1
            ->setNombre('Oficina')
            ->setDescripcion('Productos para utilizar en una oficina')
            ;
        $m->persist($categoria1);

        $categoria2 = new Categoria();

        $categoria2
            ->setNombre('Deporte')
            ->setDescripcion('Material y productos de deporte')
            ;
        $m->persist($categoria2);

        $categoria3 = new Categoria();

        $categoria3
            ->setNombre('Libreria')
            ->setDescripcion('Libros, Revistas, Lecturas especializadas.')
            ;
        $m->persist($categoria3);

        $m->flush();die;*/

        $repository = $m->getRepository('AppBundle:Categoria');

        $cat = $repository->findAll();

        return $this->render(':categorias:index.html.twig', [
            'categories' => $cat
            ]
        );
    }

    /**
     * nuevoAction
     *
     * @Route(
     *     path = "/nuevo",
     *     name = "app_categoria_nuevo"
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function nuevoAction()
    {
        return $this->render('categorias/introd.html.twig');
    }

    /**
     * doNuevoAction
     *
     * @Route(
     *     path = "/do-nuevo",
     *     name = "app_categoria_doNuevo"
     * )
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function doNuevoAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();

        $nombre = $request->request->get('nombre');
        $descripcion = $request->request->get('descripcion');

        $cat = new Categoria();

        $cat
            ->setNombre($nombre)
            ->setDescripcion($descripcion)
            ;
        $m->persist($cat);
        $m->flush();

        return $this->redirectToRoute('app_categoria_index');
    }

    /**
     * updateAction
     *
     * @Route(
     *     path = "/update/{id}",
     *     name = "app_categoria_update"
     * )
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Categoria');

        $cat = $repository->find($id);


        return $this->render(':categorias:update.html.twig', [
            'cat' => $cat
            ]
        );
    }

    /**
     * doUpdateAction
     *
     * @Route(
     *     path="/do-update",
     *     name="app_categoria_doUpdate"
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function doUpdateAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Categoria');

        $id = $request->request->get('id');
        $nombre = $request->request->get('nombre');
        $descripcion = $request->request->get('descripcion');

        $cat = $repository->find($id);

        $cat->setNombre($nombre);
        $cat->setDescripcion($descripcion);

        $m->flush();

        $this->addFlash('messages', 'Categoria Actualizada');

        return $this->redirectToRoute('app_categoria_index');
    }

    /**
     * removAction
     *
     * @Route(
     *     path = "/remov/{id}",
     *     name = "app_categoria_remov"
     * )
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Categoria');

        $cat = $repository->find($id);

        $m->remove($cat);
        $m->flush();

        $this->addFlash('messages', 'Categoría eliminada.');

        return $this->redirectToRoute('app_categoria_index');
    }
}
