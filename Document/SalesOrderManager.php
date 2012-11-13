<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\OrderBundle\Document;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\DependencyInjection\Container;

use Vespolina\Entity\Order\ItemInterface;
use Vespolina\Entity\Order\OrderInterface;
use Vespolina\OrderBundle\Document\SalesOrder;
use Vespolina\OrderBundle\Model\SalesOrderManager as BaseSalesOrderManager;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
class SalesOrderManager extends BaseSalesOrderManager
{
    protected $dm;
    protected $primaryIdentifier;
    protected $salesOrderRepo;

    public function __construct(DocumentManager $dm, $salesOrderClass, $salesOrderItemClass, $fulfillmentAgreementClass, $paymentAgreementClass)
    {
        $this->dm = $dm;
        $this->salesOrderRepo = $this->dm->getRepository($salesOrderClass); // TODO make configurable

        parent::__construct($salesOrderClass, $salesOrderItemClass, $fulfillmentAgreementClass, $paymentAgreementClass);
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->salesOrderRepo->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritdoc
     */
    public function findSalesOrderById($id)
    {

        return $this->salesOrderRepo->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findSalesOrderByIdentifier($name, $code)
    {

    }

    /**
     * @inheritdoc
     */
    public function updateSalesOrder(OrderInterface $salesOrder, $andFlush = true)
    {
        $this->dm->persist($salesOrder);
        if ($andFlush) {
            $this->dm->flush();
        }
    }
}
