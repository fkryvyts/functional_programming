<?php
/**
 * Created by PhpStorm.
 * Author: garcher
 * Date: 21.12.16
 * Time: 00:55
 */

namespace Unity\FunctionalDemo\Helper\Order;

use Money\Money;

class Product
{
    /** @var string */
    private $code;

    /** @var string */
    private $name;

    /** @var Money */
    private $price;

    /** @var int */
    private $amount;

    /**
     * Product constructor.
     * @param string $code
     * @param string $name
     * @param Money $price
     * @param int $amount
     */
    public function __construct(string $code, string $name, Money $price, int $amount = 1)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCode() : string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return Money
     */
    public function getPrice() : Money
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getAmount() : int
    {
        return $this->amount;
    }

}