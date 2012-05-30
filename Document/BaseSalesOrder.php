<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\OrderBundle\Document;

use Vespolina\CartBundle\Pricing\PricingSet;    //Todo: remove Cart bundle dependency
use Vespolina\OrderBundle\Model\SalesOrder as AbstractSalesOrder;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class BaseSalesOrder extends AbstractSalesOrder
{
    protected $id;
    protected $pricingSetData;

    public function getId()
    {

        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function postLoadSalesOrder()
    {
        $this->pricingSet = new PricingSet();
        $this->pricingSet->setAll($this->pricingSetData);
    }

    public function prePersistSalesOrder()
    {
        $this->pricingSetData = $this->pricingSet->all();
    }
}