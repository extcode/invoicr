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
 * Mandate
 *
 * @package invoicr
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class Mandate extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * reference
     *
     * @var string
     */
    protected $reference = '';

    /**
     * referenceDate
     *
     * @var \DateTime
     */
    protected $referenceDate = null;

    /**
     * accountHolder
     *
     * @var string
     */
    protected $accountHolder = '';

    /**
     * iban
     *
     * @var string
     */
    protected $iban = '';

    /**
     * bic
     *
     * @var string
     */
    protected $bic = '';

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return void
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return \DateTime
     */
    public function getReferenceDate()
    {
        return $this->referenceDate;
    }

    /**
     * @param \DateTime $referenceDate
     * @return void
     */
    public function setReferenceDate($referenceDate)
    {
        $this->referenceDate = $referenceDate;
    }

    /**
     * @return string
     */
    public function getAccountHolder()
    {
        return $this->accountHolder;
    }

    /**
     * @param string $accountHolder
     * @return void
     */
    public function setAccountHolder($accountHolder)
    {
        $this->accountHolder = $accountHolder;
    }

    /**
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @param string $bic
     * @return void
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     * @return void
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }
}
