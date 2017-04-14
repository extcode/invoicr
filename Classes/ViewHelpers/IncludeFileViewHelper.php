<?php

namespace Extcode\Invoicr\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Daniel Lorenz <ext.invoicr@extco.de>, extco.de UG (haftungsbeschränkt)
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * ViewHelper to include a css/js file
 */
class IncludeFileViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Include a CSS/JS file
     *
     * @param string $path Path to the CSS/JS file which should be included
     * @param bool $compress Define if file should be compressed
     */
    public function render($path, $compress = false)
    {
        $pageRenderer = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Page\\PageRenderer');
        if (TYPO3_MODE === 'FE') {
            $path = $GLOBALS['TSFE']->tmpl->getFileName($path);
        }

        if (strtolower(substr($path, -3)) === '.js') {
            $pageRenderer->addJsFile($path, null, $compress);
        } elseif (strtolower(substr($path, -4)) === '.css') {
            $pageRenderer->addCssFile($path, 'stylesheet', 'all', '', $compress);
        }
    }
}
