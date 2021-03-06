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
 * Invoice Controller
 *
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class InvoiceController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * invoiceRepository
     *
     * @var \Extcode\Invoicr\Domain\Repository\InvoiceRepository
     */
    protected $invoiceRepository = null;

    /**
     * @param \Extcode\Invoicr\Domain\Repository\InvoiceRepository $invoiceRepository
     */
    public function injectInvoiceRepository(
        \Extcode\Invoicr\Domain\Repository\InvoiceRepository $invoiceRepository
    ) {
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * Initialize Action
     */
    protected function initializeAction()
    {
        if (TYPO3_MODE === 'BE') {
            $pageId = (int)(\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('id')) ? \TYPO3\CMS\Core\Utility\GeneralUtility::_GET('id') : 1;

            $this->pageinfo = \TYPO3\CMS\Backend\Utility\BackendUtility::readPageAccess(
                $pageId,
                $GLOBALS['BE_USER']->getPagePermsClause(1)
            );

            $configurationManager = $this->objectManager->get(
                'TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface'
            );

            $frameworkConfiguration =
                $configurationManager->getConfiguration(
                    \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
                );
            $persistenceConfiguration = ['persistence' => ['storagePid' => $pageId]];
            $configurationManager->setConfiguration(array_merge($frameworkConfiguration, $persistenceConfiguration));

            $this->settings = $configurationManager->getConfiguration(
                \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
                $this->request->getControllerExtensionName(),
                $this->request->getPluginName()
            );

            $arguments = $this->request->getArguments();
            if ($arguments['search']) {
                $this->searchArguments = $arguments['search'];
            }
        }
    }

    /**
     * initialize create action
     *
     * @param void
     */
    public function initializeUpdateAction()
    {
        if (isset($this->arguments['invoice'])) {
            $this->arguments['invoice']
                ->getPropertyMappingConfiguration()
                ->forProperty('beginPeriodOfPerformanceDate')
                ->setTypeConverterOption(
                    'TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter',
                    \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,
                    \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_invoicr_domain_model_invoice.dateFormat',
                        'invoicr')
                );
            $this->arguments['invoice']
                ->getPropertyMappingConfiguration()
                ->forProperty('endPeriodOfPerformanceDate')
                ->setTypeConverterOption(
                    'TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter',
                    \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,
                    \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_invoicr_domain_model_invoice.dateFormat',
                        'invoicr')
                );
        }

        if (isset($this->arguments['newInvoice'])) {
            $this->arguments['newInvoice']
                ->getPropertyMappingConfiguration()
                ->forProperty('beginPeriodOfPerformanceDate')
                ->setTypeConverterOption(
                    'TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter',
                    \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,
                    \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_invoicr_domain_model_invoice.dateFormat',
                        'invoicr')
                );
            $this->arguments['newInvoice']
                ->getPropertyMappingConfiguration()
                ->forProperty('endPeriodOfPerformanceDate')
                ->setTypeConverterOption(
                    'TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter',
                    \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,
                    \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_invoicr_domain_model_invoice.dateFormat',
                        'invoicr')
                );
        }
    }

    /**
     * action list
     */
    public function listAction()
    {
        $invoices = $this->invoiceRepository->findAll();
        $this->view->assign('invoices', $invoices);
    }

    /**
     * action show
     *
     * @param \Extcode\Invoicr\Domain\Model\Invoice $invoice
     */
    public function showAction(\Extcode\Invoicr\Domain\Model\Invoice $invoice)
    {
        $this->view->assign('invoice', $invoice);
    }

    /**
     * action new
     *
     * @param \Extcode\Invoicr\Domain\Model\Invoice $newInvoice
     * @ignorevalidation $newInvoice
     */
    public function newAction(\Extcode\Invoicr\Domain\Model\Invoice $newInvoice = null)
    {
        if (TYPO3_MODE === 'BE') {
            $this->view->assign('newInvoice', $newInvoice);
        } else {
            $this->redirect('list');
        }
    }

    /**
     * action create
     *
     * @param \Extcode\Invoicr\Domain\Model\Invoice $newInvoice
     */
    public function createAction(\Extcode\Invoicr\Domain\Model\Invoice $newInvoice)
    {
        if (TYPO3_MODE === 'BE') {
            $this->invoiceRepository->add($newInvoice);
        }

        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Extcode\Invoicr\Domain\Model\Invoice $invoice
     * @ignorevalidation $invoice
     */
    public function editAction(\Extcode\Invoicr\Domain\Model\Invoice $invoice)
    {
        if (TYPO3_MODE === 'BE') {
            $this->view->assign('invoice', $invoice);
        } else {
            $this->redirect('list');
        }
    }

    /**
     * action update
     *
     * @param \Extcode\Invoicr\Domain\Model\Invoice $invoice
     */
    public function updateAction(\Extcode\Invoicr\Domain\Model\Invoice $invoice)
    {
        if (TYPO3_MODE === 'BE') {
            $this->invoiceRepository->update($invoice);
            $this->redirect('show');
        }

        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Extcode\Invoicr\Domain\Model\Invoice $invoice
     */
    public function deleteAction(\Extcode\Invoicr\Domain\Model\Invoice $invoice)
    {
        if (TYPO3_MODE === 'BE') {
            $this->invoiceRepository->remove($invoice);
        }

        $this->redirect('list');
    }

    /**
     * Generate InvoiceDocument Action
     *
     * @param \Extcode\Invoicr\Domain\Model\Invoice $invoice
     */
    public function generateInvoiceDocumentAction(\Extcode\Invoicr\Domain\Model\Invoice $invoice)
    {
        $pdfService = $this->objectManager->get(
            \Extcode\Invoicr\Service\PdfService::class
        );

        $pdf = $pdfService->createPdf($invoice);

        if ($pdf) {
            $invoice->addInvoicePdf($pdf);
        }

        $this->redirect('show', null, null, ['invoice' => $invoice]);
    }

    /**
     * Downlaod InvoiceDocument Action
     *
     * @param \Extcode\Invoicr\Domain\Model\Invoice $invoice
     */
    public function downloadInvoiceDocumentAction(\Extcode\Invoicr\Domain\Model\Invoice $invoice)
    {
        $pdfs = $invoice->getInvoicePdfs();
        $originalPdf = end($pdfs->toArray())->getOriginalResource();
        $file = PATH_site . $originalPdf->getPublicUrl();

        $fileName = $originalPdf->getName();

        if (is_file($file)) {
            $fileLen = filesize($file);

            $headers = [
                'Pragma' => 'public',
                'Expires' => 0,
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Content-Description' => 'File Transfer',
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Transfer-Encoding' => 'binary',
                'Content-Length' => $fileLen
            ];

            foreach ($headers as $header => $data) {
                $this->response->setHeader($header, $data);
            }

            $this->response->sendHeaders();
            @readfile($file);
        }
    }
}
