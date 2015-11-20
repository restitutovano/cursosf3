<?php
/**
 * Created by PhpStorm.
 * User: resvamon
 * Date: 20/11/2015
 * Time: 9:43
 */

namespace AppBundle\Service;


class CalculadoraService
{
    /**
     * @var int
     */
    private $op1;

    /**
     * @var int
     */
    private $op2;

    /**
     * @var int
     */
    private $result;

    /**
     * CalculadoraService constructor.
     * @param null $op1
     * @param null $op2
     * @param null $result
     */
    public function __construct($op1 = null, $op2 = null, $result = null)
    {
        $this->op1 = $op1;
        $this->op2 = $op2;
        $this->result = $result;
    }

    /**
     * @return int
     */
    public function getOp1()
    {
        return $this->op1;
    }

    /**
     * @param int $op1
     */
    public function setOp1($op1)
    {
        $this->op1 = (int) $op1;
    }

    /**
     * @return int
     */
    public function getOp2()
    {
        return $this->op2;
    }

    /**
     * @param int $op2
     */
    public function setOp2($op2)
    {
        $this->op2 = (int) $op2;
    }

    /**
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param int $result
     */
    public function setResult($result)
    {
        $this->result = (int) $result;
    }

    public function sum()
    {
        $this->setResult($this->getOp1() + $this->getOp2());
    }

    public function res()
    {
        $this->setResult($this->getOp1() - $this->getOp2());
    }

    public function mult()
    {
        $this->setResult($this->getOp1() * $this->getOp2());
    }

    public function div()
    {
        $this->setResult($this->getOp1() / $this->getOp2());
    }

    public function pot()
    {
        $base = $this->getOp1();
        $exp = $this->getOp2();

        $pot = $base;

        for ($i=1; $i < $exp; $i++)
        {
            $pot = $pot*$base;
        }
        $this->setResult($pot);
    }
}