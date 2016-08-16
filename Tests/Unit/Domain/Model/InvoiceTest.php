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
 * Invoice Test
 *
 * @package invoicr
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class InvoiceTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Extcode\Invoicr\Domain\Model\Invoice
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \Extcode\Invoicr\Domain\Model\Invoice();
    }

    protected function tearDown()
    {
        unset($this->subject);
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
    public function setDescriptionForStringSetsDescription()
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
    public function getBeginPeriodOfPerformanceDateReturnsInitialValue()
    {
        $this->assertEquals(
            null,
            $this->subject->getBeginPeriodOfPerformanceDate()
        );
    }

    /**
     * @test
     */
    public function setBeginPeriodOfPerformanceDateSetsBeginPeriodOfPerformanceDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setBeginPeriodOfPerformanceDate($dateTimeFixture);

        $this->assertEquals(
            $dateTimeFixture,
            $this->subject->getBeginPeriodOfPerformanceDate()
        );
    }

    /**
     * @test
     */
    public function getEndPeriodOfPerformanceDateReturnsInitialValue()
    {
        $this->assertEquals(
            null,
            $this->subject->getEndPeriodOfPerformanceDate()
        );
    }

    /**
     * @test
     */
    public function setEndPeriodOfPerformanceDateSetsEndPeriodOfPerformanceDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setEndPeriodOfPerformanceDate($dateTimeFixture);

        $this->assertEquals(
            $dateTimeFixture,
            $this->subject->getEndPeriodOfPerformanceDate()
        );
    }

    /**
     * @test
     */
    public function getInvoiceDateReturnsInitialValue()
    {
        $this->assertEquals(
            null,
            $this->subject->getInvoiceDate()
        );
    }

    /**
     * @test
     */
    public function setInvoiceDateSetsInvoiceDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setInvoiceDate($dateTimeFixture);

        $this->assertEquals(
            $dateTimeFixture,
            $this->subject->getInvoiceDate()
        );
    }

    /**
     * @test
     */
    public function getTypeOfPaymentReturnsInitialValue()
    {
        $this->assertSame(
            'transfer',
            $this->subject->getTypeOfPayment()
        );
    }

    /**
     * @test
     */
    public function setTypeOfPaymentSetsTermsOfPayment()
    {
        $typeOfPayment = 'direct_debit';

        $this->subject->setTypeOfPayment($typeOfPayment);

        $this->assertSame(
            $typeOfPayment,
            $this->subject->getTypeOfPayment()
        );
    }

    /**
     * @test
     */
    public function getTermsOfPaymentReturnsInitialValue()
    {
        $this->assertSame(
            '',
            $this->subject->getTermsOfPayment()
        );
    }

    /**
     * @test
     */
    public function setTermsOfPaymentSetsTermsOfPayment()
    {
        $termsOfPayment = 'Terms Of Payment';

        $this->subject->setTermsOfPayment($termsOfPayment);

        $this->assertSame(
            $termsOfPayment,
            $this->subject->getTermsOfPayment()
        );
    }

    /**
     * @test
     */
    public function getWasSentAtReturnsInitialValue()
    {
        $this->assertEquals(
            null,
            $this->subject->getWasSentAt()
        );
    }

    /**
     * @test
     */
    public function setWasSentAtSetsWasSentAt()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setWasSentAt($dateTimeFixture);

        $this->assertEquals(
            $dateTimeFixture,
            $this->subject->getWasSentAt()
        );
    }

    /**
     * @test
     */
    public function getWasPaidAtReturnsInitialValue()
    {
        $this->assertEquals(
            null,
            $this->subject->getWasPaidAt()
        );
    }

    /**
     * @test
     */
    public function setWasPaidAtSetsWasPaidAt()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setWasPaidAt($dateTimeFixture);

        $this->assertEquals(
            $dateTimeFixture,
            $this->subject->getWasPaidAt()
        );
    }

    /**
     * @test
     */
    public function getInvoicePdfReturnsInitialValueForFileReference()
    {
        $this->assertEquals(
            null,
            $this->subject->getInvoicePdf()
        );
    }

    /**
     * @test
     */
    public function setInvoicePdfForFileReferenceSetsInvoicePdf()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setInvoicePdf($fileReferenceFixture);

        $this->assertAttributeEquals(
            $fileReferenceFixture,
            'invoicePdf',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getItemsReturnsInitialValueForItem()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->assertEquals(
            $newObjectStorage,
            $this->subject->getItems()
        );
    }

    /**
     * @test
     */
    public function setItemsForObjectStorageContainingItemSetsItems()
    {
        $item = new \Extcode\Invoicr\Domain\Model\Item();
        $objectStorageHoldingExactlyOneItems = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneItems->attach($item);
        $this->subject->setItems($objectStorageHoldingExactlyOneItems);

        $this->assertAttributeEquals(
            $objectStorageHoldingExactlyOneItems,
            'items',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addItemToObjectStorageHoldingItems()
    {
        $item = new \Extcode\Invoicr\Domain\Model\Item();
        $itemsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'),
            array(), '', false);
        $itemsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($item));
        $this->inject($this->subject, 'items', $itemsObjectStorageMock);

        $this->subject->addItem($item);
    }

    /**
     * @test
     */
    public function removeItemFromObjectStorageHoldingItems()
    {
        $item = new \Extcode\Invoicr\Domain\Model\Item();
        $itemsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'),
            array(), '', false);
        $itemsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($item));
        $this->inject($this->subject, 'items', $itemsObjectStorageMock);

        $this->subject->removeItem($item);

    }
}
