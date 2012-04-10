<?php

/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\OrderBundle\Model;

use Vespolina\OrderBundle\Model\SalesOrderItemInterface;
use Vespolina\ProductBundle\Model\ProductInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class SalesOrderItem implements SalesOrderItemInterface
{
    protected $createdAt;
    protected $customerComment;
    protected $customerProductReference;
    protected $itemNumber;
    protected $itemState;
    protected $orderedQuantity;
    protected $pricingSet;
    protected $product;
    protected $productName;
    protected $updatedAt;
    
    /**
     * @inheritdoc
     */
    public function getCreatedAt()
    {

        return $this->createdAt;
    }

    /**
     * @inheritdoc
     */
    public function getCustomerComment()
    {

        return $this->customerComment;
    }

    /**
     * @inheritdoc
     */
    public function getCustomerProductReference()
    {

        return $this->customerProductReference;
    }

    /**
     * @inheritdoc
     */
    public function getItemNumber()
    {

        return $this->itemNumber;
    }

    /**
     * @inheritdoc
     */
    public function getItemState()
    {

        return $this->itemState;
    }

    /**
     * @inheritdoc
     */
    public function getOrderedQuantity()
    {

        return $this->orderedQuantity;
    }
    
    /**
     * @inheritdoc
     */
    public function getPricingSet()
    {

        return $this->pricingSet;
    }

    /**
     * @inheritdoc
     */
    public function getProduct()
    {

        return $this->product;
    }

    /**
     * @inheritdoc
     */
    public function getProductName()
    {

        return $this->productName;
    }
    
    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {

        return $this->updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function setCustomerComment($customerComment)
    {

        $this->customerComment = $customerComment;
    }


    /**
     * @inheritdoc
     */
    public function setCustomerProductReference($customerProductReference)
    {

        $this->customerProductReference = $customerProductReference;
    }


    /**
     * @inheritdoc
     */
    public function setItemNumber($itemNumber)
    {

        $this->itemNumber = $itemNumber;
    }

    /**
     * @inheritdoc
     */
    public function setItemState($itemState)
    {

        $this->itemState = $itemState;
    }

    /**
     * @inheritdoc
     */
    public function setOrderedQuantity($orderedQuantity)
    {
        $this->orderedQuantity = $orderedQuantity;
    }

    /**
     * @inheritdoc
     */
    public function setPricingSet($pricingSet)
    {
        $this->pricingSet = $pricingSet;
    }

    /**
     * @inheritdoc
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @inheritdoc
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
    }
}