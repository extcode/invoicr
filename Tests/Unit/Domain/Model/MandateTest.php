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