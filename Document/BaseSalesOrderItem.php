<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\OrderBundle\Document;

use Vespolina\CartBundle\Pricing\PricingSet;    //Todo: remove Cart bundle dependency
use Vespolina\OrderBundle\Model\SalesOrderItem as AbstractSalesOrderItem;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class BaseSalesOrderItem extends AbstractSalesOrderItem
{

    protected $pricingSetData;

    public function postLoadSalesOrderItem()
    {
        $this->pricingSet = new PricingSet();
        $this->pricingSet->setAll($this->pricingSetData);
    }

    public function prePersistSalesOrderItem()
    {
        $this->pricingSetData = $this->pricingSet->all();
    }
}