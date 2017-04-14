<?php

namespace Extcode\Invoicr\Tests\Unit\Domain\Model;

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
 * Item Test
 *
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class ItemTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Extcode\Invoicr\Domain\Model\Item
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \Extcode\Invoicr\Domain\Model\Item();
    }

    protected function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getSkuReturnsInitialValue()
    {
        $this->assertSame(
            '',
            $this->subject->getSku()
        );
    }

    /**
     * @test
     */
    public function setSkuSetsSku()
    {
        $sku = 'SKU';

        $this->subject->setSku($sku);

        $this->assertSame(
            $sku,
            $this->subject->getSku()
        );
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValue()
    {
        $this->assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle()
    {
        $title = 'Title';

        $this->subject->setTitle($title);

        $this->assertSame(
            $title,
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function getDescriptionReturnsInitialValue()
    {
        $this->assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionSetsDescription()
    {
        $description = 'Description';

        $this->subject->setDescription($description);

        $this->assertSame(
            $description,
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function getQuantityReturnsInitialValue()
    {
        $this->assertSame(
            0.0,
            $this->subject->getQuantity()
        );
    }

    /**
     * @test
     */
    public function setQuantitySetsQuantity()
    {
        $this->subject->setQuantity(12.5);

        $this->assertSame(
            12.5,
            $this->subject->getQuantity()
        );
    }

    /**
     * @test
     */
    public function getPriceReturnsInitialValue()
    {
        $this->assertSame(
            0.0,
            $this->subject->getPrice()
        );
    }

    /**
     * @test
     */
    public function setPriceSetsPrice()
    {
        $price = 3.14;
        $this->subject->setPrice($price);

        $this->assertSame(
            $price,
            $this->subject->getPrice()
        );
    }
}
