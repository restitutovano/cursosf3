<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CalculadoraController extends Controller
{
    /**
     * indexAction
     * @Route(
     *     path = "/",
     *     name = "app_calculadora_index"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render(':Calculadora:index.html.twig');
    }

    /**
     * sumAction
     * @Route(
     *     path = "/sum",
     *     name = "app_calculadora_sum"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sumAction()
    {
        return $this->render(':Calculadora:form.html.twig', ['action' => 'app_calculadora_doSum']);
    }

    /**
     * doSumAction
     * @Route(
     *     path = "/do-sum",
     *     name = "app_calculadora_doSum"
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function doSumAction(Request $request)
    {
        $op1 = $request->request->get('op1');
        $op2 = $request->request->get('op2');

        $calculadora = $this->get('calculadora');
        $calculadora->setOp1($op1);
        $calculadora->setOp2($op2);
        $calculadora->sum();
        $result = $calculadora->getResult();

        return $this->render(':Calculadora:result.html.twig', [
            'op1' => $op1,
            'op2' => $op2,
            'result' => $result,
            'operacion' => '+'
            ]
        );
    }

    /**
     * resAction
     *
     * @Route(
     *     path="/res",
     *     name="app_calculadora_res"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resAction()
    {
        return $this->render(':Calculadora:form.html.twig', ['action' => 'app_calculadora_doRes']);
    }

    /**
     * doResAction
     *
     * @Route(
     *     path="/do-res",
     *     name="app_calculadora_doRes"
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function doResAction(Request $request)
    {
        $op1 = $request->request->get('op1');
        $op2 = $request->request->get('op2');

        $calculadora = $this->get('calculadora');
        $calculadora->setOp1($op1);
        $calculadora->setOp2($op2);
        $calculadora->res();
        $result = $calculadora->getResult();
        return $this->render(':Calculadora:result.html.twig', [
            'op1' => $op1,
            'op2' => $op2,
            'result' => $result,
            'operacion' => '-'
        ]);
    }

    /**
     * multAction
     *
     * @Route(
     *     path="/mult",
     *     name="app_calculadora_mult"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mult()
    {
        return $this->render(':Calculadora:form.html.twig', ['action' => 'app_calculadora_doMult']);
    }

    /**
     * doMultAction
     * @Route(
     *     path = "/do-mult",
     *     name="app_calculadora_doMult"
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function doMultAction(Request $request)
    {
        $op1 = $request->request->get('op1');
        $op2 = $request->request->get('op2');

        $calculadora = $this->get('calculadora');
        $calculadora->setOp1($op1);
        $calculadora->setOp2($op2);
        $calculadora->mult();
        $result = $calculadora->getResult();

        return $this->render(':Calculadora:result.html.twig', [
            'op1' => $op1,
            'op2' => $op2,
            'result' => $result,
            'operacion' => '*'
        ]);
    }

    /**
     * divAction
     * @Route(
     *     path="/div",
     *     name="app_calculadora_div"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function divAction()
    {
        return $this->render(':Calculadora:form.html.twig', ['action' => 'app_calculadora_doDiv']);
    }

    /**
     * doDivAction
     * @Route(
     *     path="/do-div",
     *     name="app_calculadora_doDiv"
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function doDivAction(Request $request)
    {
        $op1 = $request->request->get('op1');
        $op2 = $request->request->get('op2');

        $calculadora = $this->get('calculadora');
        $calculadora->setOp1($op1);
        $calculadora->setOp2($op2);
        $calculadora->div();
        $result = $calculadora->getResult();

        return $this->render(':Calculadora:result.html.twig', [
            'op1' => $op1,
            'op2' => $op2,
            'result' => $result,
            'operacion' => '/'
        ]);
    }

    /**
     * potAction
     * @Route(
     *     path="/pot",
     *     name="app_calculadora_pot"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function potAction()
    {
        return $this->render(':Calculadora:form.html.twig', ['action' => 'app_calculadora_doPot']);
    }

    /**
     * doPotAction
     * @Route(
     *     path="/do-pot",
     *     name="app_calculadora_doPot"
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function doPotAction(Request $request)
    {
        $op1 = $request->request->get('op1');
        $op2 = $request->request->get('op2');

        $calculadora = $this->get('calculadora');
        $calculadora->setOp1($op1);
        $calculadora->setOp2($op2);
        $calculadora->pot();
        $result = $calculadora->getResult();

        return $this->render(':Calculadora:result.html.twig', [
            'op1' => $op1,
            'op2' => $op2,
            'result' => $result,
            'operacion' => '^'
        ]);
    }

}
