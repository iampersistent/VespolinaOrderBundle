<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\OrderBundle\Tests\Model;

use Vespolina\OrderBundle\Model\SalesOrderManager;
use Vespolina\OrderBundle\Tests\OrderTestCommon;

class OrderManipulatorTest extends OrderTestCommon
{

    /**
     * @covers Vespolina\OrderBundle\Util\SalesOrderManipulator::createSalesOrderFromCart
     */
    public function testSalesOrderManipulator()
    {

        $salesOrderManager = $this->createSalesOrderManager();
        $salesOrderManipulator = $this->createSalesOrderManipulator($salesOrderManager);
        $cart = $this->createCart();

        $salesOrder = $salesOrderManipulator->createSalesOrderFromCart($cart);

    }
}
