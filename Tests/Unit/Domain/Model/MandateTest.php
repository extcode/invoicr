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
 * Mandate Test
 *
 * @package invoicr
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class MandateTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Extcode\Invoicr\Domain\Model\Mandate
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \Extcode\Invoicr\Domain\Model\Mandate();
    }

    protected function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getReferenceReturnsInitialValue()
    {
        $this->assertSame(
            '',
            $this->subject->getReference()
        );
    }

    /**
     * @test
     */
    public function setReferenceSetsReference()
    {
        $reference = 'M-X-10000-1';

        $this->subject->setReference($reference);

        $this->assertSame(
            $reference,
            $this->subject->getReference()
        );
    }

    /**
     * @test
     */
    public function getReferenceDateReturnsInitialValue()
    {
        $this->assertEquals(
            null,
            $this->subject->getReferenceDate()
        );
    }

    /**
     * @test
     */
    public function setReferenceDateSetsReferenceDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setReferenceDate($dateTimeFixture);

        $this->assertEquals(
            $dateTimeFixture,
            $this->subject->getReferenceDate()
        );
    }

    /**
     * @test
     */
    public function getAccountHolderReturnsInitialValue()
    {
        $this->assertSame(
            '',
            $this->subject->getAccountHolder()
        );
    }

    /**
     * @test
     */
    public function setAccountHolderSetsAccountHolder()
    {
        $accountHolder = 'Account Holder';

        $this->subject->setAccountHolder($accountHolder);

        $this->assertSame(
            $accountHolder,
            $this->subject->getAccountHolder()
        );
    }

    /**
     * @test
     */
    public function getIbanReturnsInitialValue()
    {
        $this->assertSame(
            '',
            $this->subject->getIban()
        );
    }

    /**
     * @test
     */
    public function setIbanSetsIban()
    {
        $iban = 'DE00 0000 0000 0000 0000 00';

        $this->subject->setIban($iban);

        $this->assertSame(
            $iban,
            $this->subject->getIban()
        );
    }

    /**
     * @test
     */
    public function getBicReturnsInitialValue()
    {
        $this->assertSame(
            '',
            $this->subject->getBic()
        );
    }

    /**
     * @test
     */
    public function setBicSetsBic()
    {
        $bic = 'ABCDEF11XY';

        $this->subject->setBic($bic);

        $this->assertSame(
            $bic,
            $this->subject->getBic()
        );
    }
}