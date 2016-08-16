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
 * Item Controller
 *
 * @package invoicr
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class ItemController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * itemRepository
     *
     * @var \Extcode\Invoicr\Domain\Repository\ItemRepository
     * @inject
     */
    protected $itemRepository = null;

    /**
     * action show
     *
     * @param \Extcode\Invoicr\Domain\Model\Item $item
     * @return void
     */
    public function showAction(\Extcode\Invoicr\Domain\Model\Item $item)
    {
        $this->view->assign('item', $item);
    }

    /**
     * action edit
     *
     * @param \Extcode\Invoicr\Domain\Model\Item $item
     * @return void
     */
    public function editAction(\Extcode\Invoicr\Domain\Model\Item $item)
    {
        if (TYPO3_MODE === 'BE') {
            $this->view->assign('item', $item);
        } else {
            $this->redirect('list', 'Invoice');
        }
    }

    /**
     * action update
     *
     * @param \Extcode\Invoicr\Domain\Model\Item $item
     * @return void
     */
    public function updateAction(\Extcode\Invoicr\Domain\Model\Item $item)
    {
        if (TYPO3_MODE === 'BE') {
            $this->itemRepository->update($item);
            $this->redirect('show', 'Invoice', null, array('invoice' => $item->getInvoice()));
        }

        $this->redirect('list', 'Invoice');
    }
}
