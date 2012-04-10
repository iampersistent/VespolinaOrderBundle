<?php

/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\OrderBundle\Model;

use Vespolina\OrderBundle\Model\FulfillmentAgreementInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class FulfillmentAgreement implements FulfillmentAgreementInterface
{
    protected $type;
    protected $serviceLevel;
    protected $state;

    /**
     * @inheritdoc
     */
    function getState()
    {

        return $this->state;
    }

    /**
     * @inheritdoc
     */
    function getServiceLevel()
    {

        return $this->serviceLevel;
    }

    /**
     * @inheritdoc
     */
    function getType()
    {

        return $this->type;
    }

    /**
     * @inheritdoc
     */
    function setServiceLevel($serviceLevel)
    {

        $this->serviceLevel = $serviceLevel;
    }

    /**
     * @inheritdoc
     */
    function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @inheritdoc
     */
    function setType($type)
    {
        $this->type = $type;
    }

}