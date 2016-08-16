<?php

namespace Extcode\Invoicr\Tests\Unit\Controller;

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
 * Invoice Controller Test
 *
 * @package invoicr
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class InvoiceControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

    /**
     * @var \Extcode\Invoicr\Controller\InvoiceController
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = $this->getMock('Extcode\\Invoicr\\Controller\\InvoiceController',
            array('redirect', 'forward', 'addFlashMessage'), array(), '', false);
    }

    protected function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function listActionFetchesAllInvoicesFromRepositoryAndAssignsThemToView()
    {

        $allInvoices = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', false);

        $invoiceRepository = $this->getMock('Extcode\\Invoicr\\Domain\\Repository\\InvoiceRepository', array('findAll'),
            array(), '', false);
        $invoiceRepository->expects($this->once())->method('findAll')->will($this->returnValue($allInvoices));
        $this->inject($this->subject, 'invoiceRepository', $invoiceRepository);

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $view->expects($this->once())->method('assign')->with('invoices', $allInvoices);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenInvoiceToView()
    {
        $invoice = new \Extcode\Invoicr\Domain\Model\Invoice();

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $this->inject($this->subject, 'view', $view);
        $view->expects($this->once())->method('assign')->with('invoice', $invoice);

        $this->subject->showAction($invoice);
    }

    /**
     * @test
     */
    public function newActionAssignsTheGivenInvoiceToView()
    {
        $invoice = new \Extcode\Invoicr\Domain\Model\Invoice();

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $view->expects($this->once())->method('assign')->with('newInvoice', $invoice);
        $this->inject($this->subject, 'view', $view);

        $this->subject->newAction($invoice);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenInvoiceToInvoiceRepository()
    {
        $invoice = new \Extcode\Invoicr\Domain\Model\Invoice();

        $invoiceRepository = $this->getMock('Extcode\\Invoicr\\Domain\\Repository\\InvoiceRepository', array('add'),
            array(), '', false);
        $invoiceRepository->expects($this->once())->method('add')->with($invoice);
        $this->inject($this->subject, 'invoiceRepository', $invoiceRepository);

        $this->subject->createAction($invoice);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenInvoiceToView()
    {
        $invoice = new \Extcode\Invoicr\Domain\Model\Invoice();

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $this->inject($this->subject, 'view', $view);
        $view->expects($this->once())->method('assign')->with('invoice', $invoice);

        $this->subject->editAction($invoice);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenInvoiceInInvoiceRepository()
    {
        $invoice = new \Extcode\Invoicr\Domain\Model\Invoice();

        $invoiceRepository = $this->getMock('Extcode\\Invoicr\\Domain\\Repository\\InvoiceRepository', array('update'),
            array(), '', false);
        $invoiceRepository->expects($this->once())->method('update')->with($invoice);
        $this->inject($this->subject, 'invoiceRepository', $invoiceRepository);

        $this->subject->updateAction($invoice);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenInvoiceFromInvoiceRepository()
    {
        $invoice = new \Extcode\Invoicr\Domain\Model\Invoice();

        $invoiceRepository = $this->getMock('Extcode\\Invoicr\\Domain\\Repository\\InvoiceRepository', array('remove'),
            array(), '', false);
        $invoiceRepository->expects($this->once())->method('remove')->with($invoice);
        $this->inject($this->subject, 'invoiceRepository', $invoiceRepository);

        $this->subject->deleteAction($invoice);
    }
}
