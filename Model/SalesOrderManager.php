<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\OrderBundle\Model;

use Symfony\Component\DependencyInjection\Container;

use Vespolina\OrderBundle\Model\SalesOrderInterface;
use Vespolina\OrderBundle\Model\SalesOrderItemInterface;
use Vespolina\OrderBundle\Model\SalesOrderManagerInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class SalesOrderManager {

    protected $container;
    protected $fulfillmentAgreementClass;
    protected $paymentAgreementClass;
    protected $salesOrderClass;

    public function __construct(Container $container, $salesOrderClass, $fulfillmentAgreementClass, $paymentAgreementClass) {

        $this->container = $container;
        $this->fulfillmentAgreementClass = $fulfillmentAgreementClass;
        $this->paymentAgreementClass = $paymentAgreementClass;
        $this->salesOrderClass = $salesOrderClass;

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

    public function init(SalesOrderInterface $salesOrder) {
        
    }

    public function initItem(SalesOrderItemInterface $salesOrder) {

    }
}
