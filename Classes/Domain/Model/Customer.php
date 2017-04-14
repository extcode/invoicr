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
 * Customer
 *
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class Customer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * number
     *
     * @var string
     */
    protected $number = '';

    /**
     * contact
     *
     * @var \Extcode\Contacts\Domain\Model\Contact
     */
    protected $contact = null;

    /**
     * company
     *
     * @var \Extcode\Contacts\Domain\Model\Company
     */
    protected $company = null;

    /**
     * address
     *
     * @var \Extcode\Contacts\Domain\Model\Address
     */
    protected $address = null;

    /**
     * mandates
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Invoicr\Domain\Model\Mandate>
     */
    protected $mandates = null;

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return \Extcode\Contacts\Domain\Model\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param \Extcode\Contacts\Domain\Model\Contact $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return \Extcode\Contacts\Domain\Model\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param \Extcode\Contacts\Domain\Model\Company $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return \Extcode\Contacts\Domain\Model\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param \Extcode\Contacts\Domain\Model\Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     */
    protected function initStorageObjects()
    {
        $this->mandates = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Mandate
     *
     * @param \Extcode\Invoicr\Domain\Model\Mandate $mandate
     */
    public function addMandate(\Extcode\Invoicr\Domain\Model\Mandate $mandate)
    {
        $this->mandates->attach($mandate);
    }

    /**
     * Removes a Mandate
     *
     * @param \Extcode\Invoicr\Domain\Model\Mandate $mandateToRemove The Mandate to be removed
     */
    public function removeMandate(\Extcode\Invoicr\Domain\Model\Mandate $mandateToRemove)
    {
        $this->mandates->detach($mandateToRemove);
    }

    /**
     * Returns the mandates
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Invoicr\Domain\Model\Mandate> $mandates
     */
    public function getMandates()
    {
        return $this->mandates;
    }

    /**
     * Sets the mandates
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Invoicr\Domain\Model\Mandate> $mandates
     */
    public function setMandates(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $mandates)
    {
        $this->mandates = $mandates;
    }
}
