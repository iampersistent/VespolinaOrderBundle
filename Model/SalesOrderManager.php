<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\OrderBundle\Model;

use Symfony\Component\DependencyInjection\Container;

use Vespolina\Entity\ItemInterface;
use Vespolina\Entity\OrderInterface;
use Vespolina\Entity\ProductInterface;
use Vespolina\OrderBundle\Model\SalesOrderManagerInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class SalesOrderManager implements SalesOrderManagerInterface {

    protected $eventDispatcher;
    protected $fulfillmentAgreementClass;
    protected $paymentAgreementClass;
    protected $salesOrderClass;
    protected $salesOrderItemClass;

    public function __construct($salesOrderClass, $salesOrderItemClass, $fulfillmentAgreementClass, $paymentAgreementClass) {

        $this->fulfillmentAgreementClass = $fulfillmentAgreementClass;
        $this->paymentAgreementClass = $paymentAgreementClass;
        $this->salesOrderClass = $salesOrderClass;
        $this->salesOrderItemClass = $salesOrderItemClass;
    }

    public function addItemToSalesOrder(OrderInterface $salesOrder, ProductInterface $product)
    {
        $item = $this->doAddItemToSalesOrder($salesOrder, $product);

        return $item;
    }

    /**
     * @inheritdoc
     */
    public function createSalesOrder($salesOrderType = 'default')
    {
        $salesOrder = new $this->salesOrderClass($salesOrderType);
        $this->init($salesOrder);

        return $salesOrder;
    }

    /**
     * @inheritdoc
     */
    public function createItem(ProductInterface $product = null) {

        $salesOrderItem = new $this->salesOrderItemClass($product);
        $this->initItem($salesOrderItem);

        return $salesOrderItem;
    }

    public function createFulfillmentAgreement()
    {
        $fulfillmentAgreement = new $this->fulfillmentAgreementClass();

        return $fulfillmentAgreement;
    }

    public function createPaymentAgreement()
    {
        $paymentAgreement = new $this->paymentAgreementClass();

        return $paymentAgreement;
    }

    public function init(OrderInterface $salesOrder) {
        
    }

    public function initItem(ItemInterface $salesOrder) {

    }

    public function setOrderState(OrderInterface $salesOrder, $state)
    {
        $rp = new \ReflectionProperty($salesOrder, 'state');
        $rp->setAccessible(true);
        $rp->setValue($salesOrder, $state);
        $rp->setAccessible(false);
    }

    public function setItemOrderedQuantity(ItemInterface $orderItem, $quantity)
    {
        // add item to cart
        $rm = new \ReflectionMethod($orderItem, 'setOrderedQuantity');
        $rm->setAccessible(true);
        $rm->invokeArgs($orderItem, array($quantity));
        $rm->setAccessible(false);
    }

    public function setItemState(ItemInterface $orderItem, $state)
    {
        $rp = new \ReflectionProperty($orderItem, 'state');
        $rp->setAccessible(true);
        $rp->setValue($orderItem, $state);
        $rp->setAccessible(false);
    }

    protected function doAddItemToSalesOrder(OrderInterface $salesOrder, ProductInterface $product)
    {

        $item = $this->createItem($product);

        // add item to order
        $rm = new \ReflectionMethod($salesOrder, 'addItem');
        $rm->setAccessible(true);
        $rm->invokeArgs($salesOrder, array($item));
        $rm->setAccessible(false);

        return $item;
    }
}
