<?php

namespace Extcode\Invoicr\Domain\Model;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Invoice
 *
 * @package invoicr
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class Invoice extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * customer
     *
     * @var \Extcode\Invoicr\Domain\Model\Customer
     */
    protected $customer = null;

    /**
     * invoiceNumber
     *
     * @var string
     */
    protected $invoiceNumber = '';

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * contentAbove
     *
     * @var string
     */
    protected $contentAbove = '';

    /**
     * contentBelow
     *
     * @var string
     */
    protected $contentBelow = '';

    /**
     * beginPeriodOfPerformanceDate
     *
     * @var \DateTime
     */
    protected $beginPeriodOfPerformanceDate = null;

    /**
     * endPeriodOfPerformanceDate
     *
     * @var \DateTime
     */
    protected $endPeriodOfPerformanceDate = null;

    /**
     * invoiceDate
     *
     * @var \DateTime
     */
    protected $invoiceDate = null;

    /**
     * typeOfPayment
     *
     * @var string
     */
    protected $typeOfPayment = 'transfer';

    /**
     * termsOfPayment
     *
     * @var string
     */
    protected $termsOfPayment = '';

    /**
     * wasSentAt
     *
     * @var \DateTime
     */
    protected $wasSentAt = null;

    /**
     * wasPaidAt
     *
     * @var \DateTime
     */
    protected $wasPaidAt = null;

    /**
     * invoicePdfs
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $invoicePdfs = null;

    /**
     * items
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Invoicr\Domain\Model\Item>
     * @cascade remove
     */
    protected $items = null;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->initStorageObjects();
    }

    /**
     * Initializes all \TYPO3\CMS\Extbase\Persistence\ObjectStorage properties.
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->items = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->invoicePdfs = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return \Extcode\Invoicr\Domain\Model\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param \Extcode\Invoicr\Domain\Model\Customer $customer
     * @return void
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Returns the invoiceNumber
     *
     * @return string $invoiceNumber
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * Sets the invoiceNumber
     *
     * @param string $invoiceNumber
     * @return void
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the beginPeriodOfPerformanceDate
     *
     * @return \DateTime $beginPeriodOfPerformanceDate
     */
    public function getBeginPeriodOfPerformanceDate()
    {
        return $this->beginPeriodOfPerformanceDate;
    }

    /**
     * Sets the beginPeriodOfPerformanceDate
     *
     * @param \DateTime $beginPeriodOfPerformanceDate
     * @return void
     */
    public function setBeginPeriodOfPerformanceDate(\DateTime $beginPeriodOfPerformanceDate = null)
    {
        $this->beginPeriodOfPerformanceDate = $beginPeriodOfPerformanceDate;
    }

    /**
     * Returns the endPeriodOfPerformanceDate
     *
     * @return \DateTime $endPeriodOfPerformanceDate
     */
    public function getEndPeriodOfPerformanceDate()
    {
        return $this->endPeriodOfPerformanceDate;
    }

    /**
     * Sets the endPeriodOfPerformanceDate
     *
     * @param \DateTime $endPeriodOfPerformanceDate
     * @return void
     */
    public function setEndPeriodOfPerformanceDate(\DateTime $endPeriodOfPerformanceDate = null)
    {
        $this->endPeriodOfPerformanceDate = $endPeriodOfPerformanceDate;
    }

    /**
     * Returns the invoiceDate
     *
     * @return \DateTime $invoiceDate
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * Sets the invoiceDate
     *
     * @param \DateTime $invoiceDate
     * @return void
     */
    public function setInvoiceDate(\DateTime $invoiceDate = null)
    {
        $this->invoiceDate = $invoiceDate;
    }

    /**
     * Returns the typeOfPayment
     *
     * @return string $typeOfPayment
     */
    public function getTypeOfPayment()
    {
        return $this->typeOfPayment;
    }

    /**
     * Sets the typeOfPayment
     *
     * @param string $typeOfPayment
     * @return void
     */
    public function setTypeOfPayment($typeOfPayment)
    {
        $this->typeOfPayment = $typeOfPayment;
    }

    /**
     * Returns the termsOfPayment
     *
     * @return string $termsOfPayment
     */
    public function getTermsOfPayment()
    {
        return $this->termsOfPayment;
    }

    /**
     * Sets the termsOfPayment
     *
     * @param string $termsOfPayment
     * @return void
     */
    public function setTermsOfPayment($termsOfPayment)
    {
        $this->termsOfPayment = $termsOfPayment;
    }

    /**
     * Returns the wasSentAt
     *
     * @return \DateTime $wasSentAt
     */
    public function getWasSentAt()
    {
        return $this->wasSentAt;
    }

    /**
     * Sets the wasSentAt
     *
     * @param \DateTime $wasSentAt
     * @return void
     */
    public function setWasSentAt(\DateTime $wasSentAt = null)
    {
        $this->wasSentAt = $wasSentAt;
    }

    /**
     * Returns the wasPaidAt
     *
     * @return \DateTime $wasPaidAt
     */
    public function getWasPaidAt()
    {
        return $this->wasPaidAt;
    }

    /**
     * Sets the wasPaidAt
     *
     * @param \DateTime $wasPaidAt
     * @return void
     */
    public function setWasPaidAt(\DateTime $wasPaidAt = null)
    {
        $this->wasPaidAt = $wasPaidAt;
    }

    /**
     * Adds a Item
     *
     * @param \Extcode\Invoicr\Domain\Model\Item $item
     * @return void
     */
    public function addItem(\Extcode\Invoicr\Domain\Model\Item $item)
    {
        $this->items->attach($item);
    }

    /**
     * Removes a Item
     *
     * @param \Extcode\Invoicr\Domain\Model\Item $itemToRemove The Item to be removed
     * @return void
     */
    public function removeItem(\Extcode\Invoicr\Domain\Model\Item $itemToRemove)
    {
        $this->items->detach($itemToRemove);
    }

    /**
     * Returns the items
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Invoicr\Domain\Model\Item> $items
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Sets the items
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Invoicr\Domain\Model\Item> $items
     * @return void
     */
    public function setItems(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $items)
    {
        $this->items = $items;
    }

    /**
     * Returns the invoicePdf
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function getInvoicePdfs()
    {
        return $this->invoicePdfs;
    }

    /**
     * Sets the invoicePdf
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @return void
     */
    public function setInvoicePdfs(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $invoicePdfs)
    {
        $this->invoicePdfs = $invoicePdfs;
    }

    /**
     * Adds a Invoice PDF
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $invoicePdf
     *
     * @return void
     */
    public function addInvoicePdf(\TYPO3\CMS\Extbase\Domain\Model\FileReference $invoicePdf)
    {
        $this->invoicePdfs->attach($invoicePdf);
    }

    /**
     * Removes a Invoice PDF
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $invoicePdfToRemove
     *
     * @return void
     */
    public function removeInvoicePdf(\TYPO3\CMS\Extbase\Domain\Model\FileReference $invoicePdfToRemove)
    {
        $this->invoicePdfs->detach($invoicePdfToRemove);
    }

    /**
     * Returns the price
     *
     * @return float $price
     */
    public function getPriceNet()
    {
        $price = 0.0;

        $items = $this->getItems();
        if ($items) {
            foreach ($items as $item) {
                $price += $item->getTotalPriceNet();
            }
        }

        return $price;
    }

    /**
     * Returns the price
     *
     * @return float $price
     */
    public function getPriceGross()
    {
        $price = 0.0;

        $items = $this->getItems();
        if ($items) {
            foreach ($items as $item) {
                $price += $item->getTotalPriceGross();
            }
        }

        return $price;
    }

    /**
     * Return Tax Array
     *
     * @return array
     */
    public function getTaxes()
    {
        $taxes = [];

        $items = $this->getItems();
        if ($items) {
            foreach ($items as $item) {
                $taxes[$item->getTax()] += $item->getCalculatedTax();
            }
        }

        return $taxes;
    }

    /**
     * @return string
     */
    public function getContentAbove()
    {
        return $this->contentAbove;
    }

    /**
     * @param string $contentAbove
     * @return void
     */
    public function setContentAbove($contentAbove)
    {
        $this->contentAbove = $contentAbove;
    }

    /**
     * @return string
     */
    public function getContentBelow()
    {
        return $this->contentBelow;
    }

    /**
     * @param string $contentBelow
     * @return void
     */
    public function setContentBelow($contentBelow)
    {
        $this->contentBelow = $contentBelow;
    }
}
