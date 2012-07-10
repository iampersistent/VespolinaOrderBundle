<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\OrderBundle\Util;

use Vespolina\Entity\ItemInterface;
use Vespolina\Entity\ProductInterface;
use Vespolina\Entity\OrderInterface;
use Vespolina\OrderBundle\Model\SalesOrderManagerInterface;

/**
 * Handles advanced sales order manipulations such as:
 *  - creating a sales order oout of a cart
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class SalesOrderManipulator
{
    protected $salesOrderManager;

    public function __construct(SalesOrderManagerInterface $salesOrderManager) {

        $this->salesOrderManager = $salesOrderManager;
    }

    public function createSalesOrderFromCart(OrderInterface $cart) {

        $salesOrder = $this->salesOrderManager->createSalesOrder('default');
        $salesOrder->setCustomer($cart->getOwner());
        $salesOrder->setOrderDate(new \DateTime());
        $this->salesOrderManager->setOrderState($salesOrder, 'unprocessed');
        $salesOrder->setPricingSet($cart->getPricingSet());

        $fulfillmentAgreement = $this->salesOrderManager->createFulfillmentAgreement();
        $paymentAgreement = $this->salesOrderManager->createPaymentAgreement();

        $salesOrder->setFulfillmentAgreement($fulfillmentAgreement);
        $salesOrder->setPaymentAgreement($paymentAgreement);

        $items = $cart->getItems();

        if (null != $items) {

            foreach($cart->getItems() as $cartItem) {

                $salesOrderItem = $this->salesOrderManager->addItemToSalesOrder($salesOrder, $cartItem->getProduct());
                $salesOrderItem->setPricingSet($cartItem->getPricingSet());
                $this->salesOrderManager->setItemOrderedQuantity($salesOrderItem, $cartItem->getQuantity());
                $this->salesOrderManager->setItemState($salesOrderItem, 'unprocessed');
            }
        }

        return $salesOrder;
    }
}