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
 * Item
 *
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class Item extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * sku
     *
     * @var string
     */
    protected $sku = '';

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
     * quantity
     *
     * @var float
     */
    protected $quantity = 0.0;

    /**
     * price
     *
     * @var float
     */
    protected $price = 0.0;

    /**
     * tax
     *
     * @var float
     */
    protected $tax = 0.0;

    /**
     * invoice
     *
     * @var \Extcode\Invoicr\Domain\Model\Invoice
     */
    protected $invoice = null;

    /**
     * Returns the sku
     *
     * @return string $sku
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Sets the sku
     *
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
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
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the quantity
     *
     * @return float $quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Sets the quantity
     *
     * @param float $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Returns the price
     *
     * @return float $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Sets the price
     *
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    /**
     * @return \Extcode\Invoicr\Domain\Model\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param \Extcode\Invoicr\Domain\Model\Invoice $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * @return float
     */
    public function getCalculatedTax()
    {
        $tax = ($this->getTax() / 100.0);

        $calculatedTax = $this->getPrice() * $this->getQuantity() * $tax;

        return $calculatedTax;
    }

    /**
     * Returns Total Net Price
     *
     * @return float
     */
    public function getTotalPriceNet()
    {
        $totalPriceNet = $this->getPrice() * $this->getQuantity();

        return $totalPriceNet;
    }

    /**
     * Returns Total Gross Price
     *
     * @return float
     */
    public function getTotalPriceGross()
    {
        $tax = 1 + ($this->getTax() / 100.0);

        $totalPriceGross = $this->getPrice() * $this->getQuantity() * $tax;

        return $totalPriceGross;
    }
}
