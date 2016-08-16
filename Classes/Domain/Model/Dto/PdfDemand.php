<?php

namespace Extcode\Invoicr\Domain\Model\Dto;

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
 * Data Transfer Object PdfDemand
 *
 * @package invoicr
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class PdfDemand extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Debug
     *
     * @var int
     */
    protected $debug = 0;

    /**
     * Fold Marks
     *
     * @var bool
     */
    protected $foldMarks = false;

    /**
     * Address Field Marks
     *
     * @var bool
     */
    protected $addressFieldMarks = false;

    /**
     * Font Size
     *
     * @var int
     */
    protected $fontSize = 8;

    /**
     * Get Debug
     *
     * @return int
     */
    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * Set Debug
     *
     * @param int $debug
     * @return void
     */
    public function setDebug($debug)
    {
        if ($debug) {
            $this->debug = $debug;
        }
    }

    /**
     * Get Font Size
     *
     * @return int
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }

    /**
     * Set Font Size
     *
     * @param int $fontSize
     * @return void
     */
    public function setFontSize($fontSize)
    {
        if ($fontSize) {
            $this->fontSize = $fontSize;
        }
    }

    /**
     * Set Fold Marks
     *
     * @param bool $foldMarks
     * @return void
     */
    public function setFoldMarks($foldMarks)
    {
        $this->foldMarks = $foldMarks;
    }

    /**
     * Get Fold Marks
     *
     * @return bool
     */
    public function getFoldMarks()
    {
        return $this->foldMarks;
    }

    /**
     * Set Address Field Marks
     *
     * @param bool $addressFieldMarks
     * @return void
     */
    public function setAddressFieldMarks($addressFieldMarks)
    {
        $this->addressFieldMarks = $addressFieldMarks;
    }

    /**
     * Get Address Field Marks
     *
     * @return bool
     */
    public function getAddressFieldMarks()
    {
        return $this->addressFieldMarks;
    }
}
