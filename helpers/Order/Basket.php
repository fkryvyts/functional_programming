<?php
/**
 * Created by PhpStorm.
 * Author: garcher
 * Date: 21.12.16
 * Time: 00:49
 */

namespace Unity\FunctionalDemo\Helper\Order;

use PhpSlang\Collection\ListCollection;
use Unity\FunctionalDemo\Helper\ContactInformation;

class Basket
{
    /** @var ContactInformation */
    private $contactInformation;

    /** @var ListCollection */
    private $products;

    /**
     * Basket constructor.
     * @param ContactInformation $contactInformation
     * @param ListCollection $products
     */
    public function __construct(ContactInformation $contactInformation, ListCollection $products)
    {
        $this->products = $products;
        $this->contactInformation = $contactInformation;
    }

    /**
     * @return ListCollection
     */
    public function getProducts() : ListCollection
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getContactInformation() : ContactInformation
    {
        return $this->contactInformation;
    }
}