<?php

namespace Vespolina\OrderBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\OrderBundle\Model\SalesOrderManager;
use Vespolina\OrderBundle\Document\FulfillmentAgreement;
use Vespolina\OrderBundle\Document\PaymentAgreement;


class OrderDocumentCreateTest extends WebTestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = $this->createClient();
    }

    public function getKernel(array $options = array())
    {
        if (!self::$kernel) {
            self::$kernel = $this->createKernel($options);
            self::$kernel->boot();
        }

        return self::$kernel;
    }

    /**
     * @covers Vespolina\OrderBundle\Service\OrderService::create
     */
    public function testSalesOrderCreate()
    {

        $salesOrderManager = $this->getKernel()->getContainer()->get('vespolina_sales_order.sales_order_manager');


        $salesOrder = $salesOrderManager->createSalesOrder();

        //Header data
        $salesOrder->setCustomer($this->createCustomer());
        $salesOrder->setOrderDate(new \DateTime());
        $salesOrder->setOrderState('awaiting_payment');
        $salesOrder->setSalesChannel('webshop-foo.com');


        $paymentAgreement = new PaymentAgreement();
        $paymentAgreement->setType('COD');
        $paymentAgreement->setState('unpaid');

        $salesOrder->setPaymentAgreement($paymentAgreement);


        $fulfillmentAgreement = new FulfillmentAgreement();
        $fulfillmentAgreement->setType('shipment');
        $fulfillmentAgreement->setState('warehouse notice');
        $fulfillmentAgreement->setServiceLevel('express_delivery');

        $salesOrder->setFulfillmentAgreement($fulfillmentAgreement);

        //Item data
        $salesOrderItem1 = $salesOrderManager->createItem($salesOrder);

        $productA = $this->createProduct();
        $productB = $this->createProduct();

        $salesOrderItem1->setProduct($productA);
        $salesOrderItem1->setOrderedQuantity(10);
        $salesOrderItem1->setCustomerComment('please deliver one with a green print');
        $salesOrderItem1->setCustomerProductReference('PROMO_2012_T_SHIRT_CUSTOM_COLOR');
        $salesOrderItem1->setItemState('shipped');

        $this->assertEquals(count($salesOrder->getItems()), 1);
        $this->assertEquals(($salesOrderItem1->getOrderedQuantity()), 10);

        $salesOrderItem2 = $salesOrderManager->createItem($salesOrder);
        $salesOrderItem2->setProduct($productB);
        $salesOrderItem2->setOrderedQuantity(5);
        $salesOrderItem2->setItemState('shipped');

        $this->assertEquals(count($salesOrder->getItems()), 2);
        $this->assertEquals(($salesOrderItem2->getOrderedQuantity()), 5);


        $salesOrderManager->updateSalesOrder($salesOrder);
    }

    protected function createCustomer()
    {

        $customerManager = $this->getKernel()->getContainer()->get('vespolina_customer.customer_manager');
        $customer = $customerManager->createCustomer();
        $customer->setName('Enron');
        $customer->setCustomerId('ABC10000');

        return $customer;
    }

    protected function createProduct()
    {
        $product = $this->getMock('Vespolina\ProductBundle\Model\Product', array('createProductIdentifierSet'), array('ProductIdentifierSet'));
        $product->expects($this->any())
            ->method('createProductIdentifierSet')
            ->withAnyParameters()
            ->will($this->returnCallback(array($this, 'createProductIdentifierSetCallback')));

        $pis = $this->createProductIdentifierSet(array('primary' => 'primary'));

        $ip = new \ReflectionProperty('Vespolina\ProductBundle\Model\Product', 'identifiers');
        $ip->setAccessible(true);
        $identifiers = $ip->getValue($product);
        $identifiers->set('primary:primary;', $pis);
        $ip->setValue($product, $identifiers);

        return $product;
    }

    protected function createProductIdentifierSet($options)
    {
        $pis = $this->getMock('Vespolina\ProductBundle\Model\Identifier\ProductIdentifierSet', null, array($options), '', false);

        $op = new \ReflectionProperty('Vespolina\ProductBundle\Model\Identifier\ProductIdentifierSet', 'options');
        $op->setAccessible(true);
        $op->setValue($pis, $options);

        return $pis;
    }
}