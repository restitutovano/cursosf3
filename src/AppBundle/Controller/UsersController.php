<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller
{
    /**
     * indexAction
     *
     * @Route(
     *     path = "/",
     *     name = "app_user_index"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $m =$this->getDoctrine()->getManager();

        /*
        $user1 = new Users();
        $user1
            ->setEmail('email1@email.com')
            ->setPassword('1234')
            ->setUsername('user1')
            ;
        $m->persist($user1);

        $user2 = new Users();
        $user2
            ->setEmail('email2@email.com')
            ->setPassword('1234')
            ->setUsername('user2')
        ;
        $m->persist($user2);

        $user3 = new Users();
        $user3
            ->setEmail('email3@email.com')
            ->setPassword('1234')
            ->setUsername('user3')
        ;
        $m->persist($user3);

        $m->flush();die;*/

        $repository = $m->getRepository("AppBundle:Users");

        $users = $repository->findAll();

        return $this->render(':user:index.html.twig',
            [
                'users' => $users
            ]
        );
    }

    /**
     * updateAction
     *
     * @Route(
     *     path = "/update/{id}",
     *     name = "app_user_update"
     * )
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Users');

        $user = $repository->find($id);


        return $this->render(':user:update.html.twig',
            [
                'user' => $user
            ]
        );
    }

    /**
     * doUpdateAction
     *
     * @Route(
     *     path = "/do-update",
     *     name = "app_user_doUpdate"
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function doUpdateAction(Request $request)
    {
        $m          = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Users');

        $id         = $request->request->get('id');
        $username   = $request->request->get('username');
        $email      = $request->request->get('email');
        $password   = $request->request->get('password');

        $user = $repository->find($id);

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);

        $m->flush();

        $this->addFlash('messages', 'Usuario actualizado');

        return $this->redirectToRoute('app_user_index');
    }


    /**
     * @Route(path = "/remov/{id}", name = "app_user_remov")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Users');

        $user =$repository->find($id);

        $m->remove($user);
        $m->flush();

        $this->addFlash('messages', 'Usuario Eliminado');

        return $this->redirectToRoute('app_user_index');
    }

    /**
     * @Route(
     *     path="/intro",
     *     name="app_user_intro"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introAction()
    {
        return $this->render(':user:introd.html.twig');
    }

    /**
     * doIntroAction
     * @Route(
     *     path = "/do-intro",
     *     name = "app_user_doIntro"
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function doIntroAction(Request $request)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $email = $request->request->get('email');
        var_dump($username, $password, $email);
        $m = $this->getDoctrine()->getManager();

        $user = new Users();

        $user
            ->setUsername($username)
            ->setEmail($email)
            ->setPassword($password)
            ;

        $m->persist($user);
        $m->flush();

        return $this->redirectToRoute('app_user_index');
    }
}
