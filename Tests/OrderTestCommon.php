<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\OrderBundle\Tests;

use Vespolina\OrderBundle\Model\SalesOrderManager;

abstract class OrderTestCommon extends \PHPUnit_Framework_TestCase
{

    protected function createCustomer()
    {
        $customer = array('name' => 'Enron');
        return $customer;
    }

    protected function createSalesOrderManipulator($salesOrderManager)
    {
        return $this->getMockForAbstractClass('Vespolina\OrderBundle\Util\SalesOrderManipulator',
            array($salesOrderManager));
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

    protected function createCart()
    {
        $product = $this->getMockForAbstractClass('Vespolina\Entity\Cart');

        return $product;
    }

    protected function createProduct()
    {
        $product = $this->getMockForAbstractClass('Vespolina\Entity\Product');

        return $product;
    }
}
