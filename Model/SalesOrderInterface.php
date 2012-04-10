<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\OrderBundle\Model;

use Vespolina\PartnerBundle\Model\PartnerInterface;
use Vespolina\OrderBundle\Model\FulfillmentAgreementInterface;
use Vespolina\OrderBundle\Model\PaymentAgreementInterface;
use Vespolina\OrderBundle\Model\SalesOrderItemInterface;


/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface SalesOrderInterface
{

    /**
     * Attach a sales order item
     *
     * @abstract
     * @param SalesOrderItemInterface $item
     * @return void
     */
    function addItem(SalesOrderItemInterface $item);

    /**
     * Get the date on which this sales order was initially created
     *
     * @abstract
     * @return void
     */
    function getCreatedAt();

    /**
     * Get the customer for this sales order
     *
     * @abstract
     * @return void
     */
    function getCustomer();

    /**
     * Retrieve all sales order items
     *
     * @abstract
     * @return void
     */
    function getItems();

    /**
     * Get the date on which this order was posted
     *
     * @abstract
     * @return void
     */
    function getOrderDate();

    /**
     * What it the current state of the order
     *
     * @abstract
     * @return void
     */
    function getOrderState();

    /**
     * Get the payment agreement (how is this sales order going to be paid?)
     *
     * @abstract
     * @return void
     */
    function getPaymentAgreement();

    /**
     * Get the price information
     *
     * @abstract
     * @return void
     */
    function getPricingSet();


    /**
     * Name of the sales channel (eg. webshop1-blabla, reseller-network1)
     *
     * @abstract
     * @return void
     */
    function getSalesChannel();

    /**
     * Get the date on which this sales order was lastly updated
     *
     * @abstract
     * @return void
     */
    function getUpdatedAt();

    /**
     * Set the sales order customer
     *
     * @abstract
     * @param $customer
     * @return void
     */
    function setCustomer(PartnerInterface $customer);

    /**
     * Set a customer comment
     *
     * @abstract
     * @param $customerComment
     * @return void
     */
    function setCustomerComment($customerComment);

    /**
     * Set the date on which this sales order was posted
     *
     * @abstract
     * @param $orderDate
     * @return void
     */
    function setOrderDate($orderDate);

    /**
     * Set the current state of the sales order
     *
     * @abstract
     * @param $orderState
     * @return void
     */
    function setOrderState($orderState);

    /**
     * Set the way it was agreed upon to fulfill this sales order
     *
     * @abstract
     * @param FulfillmentAgreementInterface $fulfillmentAgreement
     * @return void
     */
    function setFulfillmentAgreement(FulfillmentAgreementInterface $fulfillmentAgreement);

    /*
     * Set the payment agreement
     *
     */
    function setPaymentAgreement(PaymentAgreementInterface $paymentAgreement);

    /**
     * Set pricing information
     *
     * @abstract
     * @param $pricingSet
     * @return void
     */
    function setPricingSet($pricingSet);

}