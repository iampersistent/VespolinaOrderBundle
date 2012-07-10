<?php

namespace Vespolina\OrderBundle\Tests\Model;

use Vespolina\OrderBundle\Model\SalesOrderManager;
use Vespolina\OrderBundle\Tests\OrderTestCommon;

class SalesOrderTest extends OrderTestCommon
{

    /**
     * @covers Vespolina\OrderBundle\Service\OrderService::create
     */
    public function testOrderCreate()
    {

        $salesOrderManager = $this->createSalesOrderManager();
        $salesOrder = $salesOrderManager->createSalesOrder();
        $productA = $this->createProduct();
        $productB = $this->createProduct();

        //Header data
        $salesOrder->setCustomer($this->createCustomer());
        $salesOrder->setOrderDate(new \DateTime());
        $salesOrder->setOrderState('awaiting_payment');
        $salesOrder->setSalesChannel('webshop-foo.com');


        $paymentAgreement = $salesOrderManager->createPaymentAgreement();
        $paymentAgreement->setType('COD');
        $paymentAgreement->setState('unpaid');
        $salesOrder->setPaymentAgreement($paymentAgreement);

        $fulfillmentAgreement = $salesOrderManager->createFulfillmentAgreement();
        $fulfillmentAgreement->setType('shipment');
        $fulfillmentAgreement->setState('warehouse notice');
        $fulfillmentAgreement->setServiceLevel('express_delivery');

        $salesOrder->setFulfillmentAgreement($fulfillmentAgreement);
        $salesOrder->setCustomerComment('Hey, If possible can I get a free bag?');

        $salesOrderItem1 = $salesOrderManager->addItemToSalesOrder($salesOrder, $productA);
        $salesOrderManager->setItemOrderedQuantity($salesOrderItem1, 10);

        $salesOrderItem1->setCustomerComment('please deliver one with a green print');
        $salesOrderItem1->setCustomerProductReference('PROMO_2012_T_SHIRT_CUSTOM_COLOR');

        $this->assertEquals(count($salesOrder->getItems()), 1);
        $this->assertEquals(($salesOrderItem1->getOrderedQuantity()), 10);

        $salesOrderItem2 = $salesOrderManager->addItemToSalesOrder($salesOrder, $productB);
        $salesOrderManager->setItemOrderedQuantity($salesOrderItem2, 5);
        $salesOrderManager->setItemState($salesOrderItem1, 'shipped');  //Force state to be "shipped"

        $this->assertEquals(count($salesOrder->getItems()), 2);
        $this->assertEquals(($salesOrderItem2->getOrderedQuantity()), 5);
    }

    protected function createCustomer()
    {

        $customer = array('name' => 'Enron');
        return $customer;
    }

    protected function createSalesOrderManager()
    {
        $salesOrderManager =  $this->getMockForAbstractClass('Vespolina\OrderBundle\Model\SalesOrderManager',
            array(  'Vespolina\OrderBundle\Document\SalesOrder',
                    'Vespolina\OrderBundle\Document\SalesOrderItem',
                    'Vespolina\OrderBundle\Document\FulfillmentAgreement',
                    'Vespolina\OrderBundle\Document\PaymentAgreement'));
        return $salesOrderManager;

    }
    protected function createProduct()
    {
        $product = $this->getMockForAbstractClass('Vespolina\Entity\Product');

        return $product;
    }
}
