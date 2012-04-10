<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\OrderBundle\Model;


/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface FulfillmentAgreementInterface
{

    /**
     * Returns the agreed service level (eg. if fulfillment type = 'shipment', a service level
     * could be "delivery_in_24h"
     *
     * @abstract
     * @return void
     */
    function getServiceLevel();

    /**
     * Fulfillment type such as "shipment", "customer comes get it", ...
     *
     * @abstract
     * @return string
     */
    function getType();

    function getState();

    function setServiceLevel($serviceLevel);

    function setState($state);

    function setType($type);

}