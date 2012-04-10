<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\OrderBundle\Model;

use Vespolina\PricingBundle\Model\PriceableInterface;
use Vespolina\ProductBundle\Model\ProductInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface SalesOrderItemInterface {


    /**
     * Get the customer comment of this item
     *
     * @abstract
     * @return void
     */
    function getCustomerComment();

    /**
     * The product reference which the customer used for ordering the product
     * This can be different from the real product SKU
     *
     * @abstract
     * @return void
     */
    function getCustomerProductReference();

    /**
     * Get item number
     *
     * @abstract
     * @return int
     */
    function getItemNumber();

    /**
     * Get item state (eg. "backorder", or "delivered", ...)
     *
     * @abstract
     * @return void
     */
    function getItemState();

    /**
     * Get quantity initially ordered
     *
     * @abstract
     * @return int
     */
    function getOrderedQuantity();

    /**
     * Get the product associated to this order item
     *
     * @abstract
     * @return Vespolina\ProductBundle\ProductInterface
     */
    function getProduct();


    /**
     * Get the product name
     *
     * @abstract
     * @return void
     */
    function getProductName();

    /**
     * Set the customer comment
     *
     * @abstract
     * @return void
     */
    function setCustomerComment($customerComment);

    /**
     * Set the customer product reference
     *
     * @abstract
     * @param $customerProductReference
     * @return void
     */
    function setCustomerProductReference($customerProductReference);

    /**
     * Set the item number
     *
     * @abstract
     * @param $itemNumber
     * @return void
     */
    function setItemNumber($itemNumber);


    /**
     * Set quantity ordered
     * @abstract
     * @param  $quantity
     * @return void
     */
    function setOrderedQuantity($quantity);
    
    /**
     * Set product which needs to be associated to this order item
     *
     * @abstract
     * @param \Vespolina\ProductBundle\Model\ProductInterface $product
     * @return void
     */
    function setProduct(ProductInterface $product);

    /**
     * Set the name of the product
     *
     * @abstract
     * @param $productName
     * @return void
     *
     */
    function setProductName($productName);
}