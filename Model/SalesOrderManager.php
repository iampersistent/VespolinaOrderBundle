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

    public function __construct(Container $container) {

        $this->container = $container;
    }



    public function init(SalesOrderInterface $salesOrder) {
        
    }

    public function initItem(SalesOrderItemInterface $salesOrder) {

    }
}
