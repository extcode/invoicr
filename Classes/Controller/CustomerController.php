<?php

namespace Extcode\Invoicr\Controller;

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
 * Customer Controller
 *
 * @package invoicr
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class CustomerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * customerRepository
     *
     * @var \Extcode\Invoicr\Domain\Repository\CustomerRepository
     * @inject
     */
    protected $customerRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $customers = $this->customerRepository->findAll();
        $this->view->assign('customers', $customers);
    }
}