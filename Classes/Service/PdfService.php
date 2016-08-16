<?php

namespace Extcode\Invoicr\Service;

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

use TYPO3\CMS\Core\SingletonInterface;

/**
 * Pdf Service
 *
 * @package invoicr
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class PdfService
{
    /**
     * Object Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Log Manager
     *
     * @var \TYPO3\CMS\Core\Log\LogManager
     */
    protected $logManager;

    /**
     * Configuration Manager
     *
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     */
    protected $configurationManager;

    /**
     * Persistence Manager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected $persistenceManager;

    /**
     * Plugin Settings
     *
     * @var array
     */
    protected $pluginSettings;

    /**
     * Invoice Repository
     *
     * @var \Extcode\Invoicr\Domain\Repository\InvoiceRepository
     */
    protected $itemRepository;

    /**
     * Data Transfer Object PdfDemand
     *
     * @var \Extcode\Invoicr\Domain\Model\Dto\PdfDemand
     */
    protected $pdfDemand;

    /**
     * @var \Extcode\Invoicr\Service\InvoicePdf
     */
    protected $pdf;

    /**
     * PDF Path
     *
     * @var string
     */
    protected $pdf_path = 'typo3temp/invoicr/';

    /**
     * PDF Filename
     *
     * @var string
     */
    protected $pdf_filename = 'test';

    /**
     * Enable/Disable Border for debugging
     *
     * @var int
     */
    protected $border = 1;

    /**
     * Injects the Object Manager
     *
     * @param \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
     *
     * @return void
     */
    public function injectObjectManager(
        \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
    ) {
        $this->objectManager = $objectManager;
    }

    /**
     * Injects the Configuration Manager
     *
     * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
     *
     * @return void
     */
    public function injectConfigurationManager(
        \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
    ) {
        $this->configurationManager = $configurationManager;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager
     */
    public function injectPersistenceManager(
        \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager
    ) {
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * Inject the Log Manager
     *
     * @param \TYPO3\CMS\Core\Log\LogManagerInterface $logḾanager
     *
     * @return void
     */
    public function injectLog(
        \TYPO3\CMS\Core\Log\LogManagerInterface $logḾanager
    ) {
        $this->logManager = $logḾanager;
    }

    /**
     * @param \Extcode\Invoicr\Domain\Repository\InvoiceRepository $invoiceRepository
     */
    public function injectIvoiceRepository(
        \Extcode\Invoicr\Domain\Repository\InvoiceRepository $invoiceRepository
    ) {
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * @param \Extcode\Invoicr\Domain\Model\Invoice $invoice
     *
     * @return string
     */
    public function createPdf(\Extcode\Invoicr\Domain\Model\Invoice $invoice)
    {
        $this->setPluginSettings();

        $pdfFilename = '/tmp/tempfile.pdf';
        $this->renderPdf($invoice);

        $storageRepository = $this->objectManager->get(
            \TYPO3\CMS\Core\Resource\StorageRepository::class
        );

        $newFileName = $invoice->getInvoiceNumber() . '.pdf';

        if (file_exists($pdfFilename)) {
            $storage = $storageRepository->findByUid('1');
            $targetFolder = $storage->getFolder('/tx_invoicr/pdf');

            $movedNewFile = $storage->addFile($pdfFilename, $targetFolder, $newFileName);
            $newFileReference = $this->objectManager->get(
                \Extcode\Invoicr\Domain\Model\FileReference::class
            );
            $newFileReference->setFile($movedNewFile);
            $invoice->setInvoicePdf($newFileReference);
        }

        $this->invoiceRepository->update($invoice);
        // Not neccessary since 6.2
        $this->persistenceManager->persistAll();
    }

    /**
     * @param \Extcode\Invoicr\Domain\Model\Invoice $invoice
     *
     * @return void
     */
    protected function renderPdf(\Extcode\Invoicr\Domain\Model\Invoice $invoice)
    {
        //$this->pdf = new \Extcode\Invoicr\Service\InvoicePdf();
        $this->pdf = $this->objectManager->get(
            \Extcode\Invoicr\Service\InvoicePdf::class
        );

        $this->pdf->AddPage();

        if ($this->pluginSettings['invoicePdf']['font']) {
            $font = $this->pluginSettings['invoicePdf']['font'] ;
        } else {
            $font = 'Helvetica';
        }
        if ($this->pluginSettings['invoicePdf']['fontStyle']) {
            $fontStyle = $this->pluginSettings['invoicePdf']['fontStyle'] ;
        } else {
            $fontStyle = '';
        }
        if ($this->pluginSettings['invoicePdf']['fontSize']) {
            $fontSize = $this->pluginSettings['invoicePdf']['fontSize'] ;
        } else {
            $fontSize = 8;
        }


        $this->pdf->SetFont($font, $fontStyle, $fontSize);

        $this->renderMarker();

        if ($this->pluginSettings['invoicePdf']['renderParts']) {
            foreach ($this->pluginSettings['invoicePdf']['renderParts'] as $partName => $partConfig) {
                $this->renderStandaloneView($invoice, $partName, $partConfig);
            }
        }

        $this->renderInvoice($invoice);

        $this->pdf->AddPage();

        //$this->renderPaymentOptions();

        $pdfFilename = '/tmp/tempfile.pdf';

        $this->pdf->Output($pdfFilename, 'F');
    }

    /**
     *
     */
    protected function renderMarker()
    {
        $this->pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0)));

        if ($this->pdfDemand->getFoldMarks()) {
            $this->pdf->SetLineWidth(0.1);
            $this->pdf->Line(6.0, 105.0, 8.0, 105.0);
            $this->pdf->Line(6.0, 148.5, 10.0, 148.5);
            $this->pdf->Line(6.0, 210.0, 8.0, 210.0);
            $this->pdf->SetLineWidth(0.2);
        }

        if ($this->pdfDemand->getAddressFieldMarks()) {
            $this->pdf->SetLineWidth(0.1);

            $this->pdf->Line(20.0, 45.0, 21.0, 45.0);
            $this->pdf->Line(20.0, 45.0, 20.0, 46.0);

            $this->pdf->Line(105.0, 45.0, 104.0, 45.0);
            $this->pdf->Line(105.0, 45.0, 105.0, 46.0);

            $this->pdf->Line(20.0, 90.0, 21.0, 90.0);
            $this->pdf->Line(20.0, 90.0, 20.0, 89.0);

            $this->pdf->Line(105.0, 90.0, 104.0, 90.0);
            $this->pdf->Line(105.0, 90.0, 105.0, 89.0);

            $this->pdf->SetLineWidth(0.2);
        }
    }

    /**
     * @param \Extcode\Invoicr\Domain\Model\Invoice $invoice
     *
     * @return void
     */
    protected function renderStandaloneView(\Extcode\Invoicr\Domain\Model\Invoice $invoice, $type, $config)
    {
        $view = $this->getStandaloneView('/Pdf/', ucfirst($type));
        $view->assign('invoice', $invoice);

        if ($config['file']) {
            $file = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
                $config['file']
            );
            $view->assign('file', $file);
            if ($config['width']) {
                $view->assign('width', $config['width']);
            }
            if ($config['height']) {
                $view->assign('heigth', $config['heigth']);
            }
        }

        $content = $view->render();
        $content = trim(preg_replace('~[\n]+~', '', $content));

        $this->writeHtml($content, $config);
    }

    protected function writeHtml($content, $config)
    {
        $width = $config['width'];
        $height = 0;
        if ($config['height']) {
            $height = $config['height'];
        }
        $positionX = $config['positionX'];
        $positionY = $config['positionY'];
        $align = 'L';
        if ($config['align']) {
            $align = $config['align'];
        }

        if ($config['fontSize']) {
            $this->pdf->SetFontSize($config['fontSize']);
        }

        $this->pdf->writeHTMLCell(
            $width,
            $height,
            $positionX,
            $positionY,
            $content,
            $this->pdfDemand->getDebug(),
            2,
            false,
            true,
            $align,
            true
        );

        if ($config['fontSize']) {
            $this->pdf->SetFontSize($this->pdfDemand->getFontSize());
        }
    }

    /**
     * @param \Extcode\Invoicr\Domain\Model\Invoice $invoice
     */
    protected function renderInvoice(\Extcode\Invoicr\Domain\Model\Invoice $invoice)
    {
        $config = $this->pluginSettings['invoicePdf']['renderInvoiceTable'];
        $config['height'] = 0;
        $config['positionY'] = $this->pdf->GetY();

        $view = $this->getStandaloneView('/Pdf/Table/', 'Header');
        $view->assign('invoice', $invoice);
        $header = $view->render();
        $headerOut = trim(preg_replace('~[\n]+~', '', $header));

        $view = $this->getStandaloneView('/Pdf/Table/', 'Item');
        $productOut = '';
        foreach ($invoice->getItems() as $item) {
            $config['$positionY'] = $this->pdf->GetY();
            $view->assign('item', $item);
            $item = $view->render();
            $productOut .= trim(preg_replace('~[\n]+~', '', $item));
        }

        $view = $this->getStandaloneView('/Pdf/Table/', 'Footer');
        $view->assign('invoice', $invoice);
        $footer = $view->render();
        $footerOut = trim(preg_replace('~[\n]+~', '', $footer));

        $content = '<table cellpadding="3">' . $headerOut . $productOut . $footerOut . '</table>';

        $this->writeHtml($content, $config);
    }

    /**
     * Sets Plugin Settings
     *
     * @return void
     */
    protected function setPluginSettings()
    {
        $this->pluginSettings =
            $this->configurationManager->getConfiguration(
                \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
                'invoicr'
            );

        $this->pdfDemand = $this->objectManager->get(
            \Extcode\Invoicr\Domain\Model\Dto\PdfDemand::class
        );

        $this->pdfDemand->setFontSize(
            $this->pluginSettings['invoicePdf']['fontSize']
        );
        $this->pdfDemand->setDebug(
            $this->pluginSettings['invoicePdf']['debug']
        );
        $this->pdfDemand->setFoldMarks(
            $this->pluginSettings['invoicePdf']['showFoldMarks']
        );
        $this->pdfDemand->setAddressFieldMarks(
            $this->pluginSettings['invoicePdf']['showAddressFieldMarks']
        );
    }

    /**
     * This creates another stand-alone instance of the Fluid StandaloneView
     * to render an e-mail template
     *
     * @param string $templatePath
     * @param string $templateFileName
     * @param string $format
     *
     * @return \TYPO3\CMS\Fluid\View\StandaloneView Fluid instance
     */
    protected function getStandaloneView($templatePath = '/Pdf/', $templateFileName = 'Default', $format = 'html')
    {
        $templatePathAndFileName = $templatePath . $templateFileName . '.' . $format;

        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
        $view = $this->objectManager->get(
            \TYPO3\CMS\Fluid\View\StandaloneView::class
        );
        $view->setFormat($format);

        if ($this->pluginSettings['view']) {
            $view->setLayoutRootPaths($this->resolveRootPaths('layoutRootPaths'));
            $view->setPartialRootPaths($this->resolveRootPaths('partialRootPaths'));

            if ($this->pluginSettings['view']['templateRootPaths']) {
                foreach ($this->pluginSettings['view']['templateRootPaths'] as $pathNameKey => $pathNameValue) {
                    $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
                        $pathNameValue
                    );

                    $completePath = $templateRootPath . $templatePathAndFileName;
                    if (file_exists($completePath)) {
                        $view->setTemplatePathAndFilename($completePath);
                    }
                }
            }
        }

        if (!$view->getTemplatePathAndFilename()) {
            $logger = $this->logManager->getLogger(__CLASS__);
            $logger->error(
                'Cannot find Template for PdfService',
                [
                    'templateRootPaths' => $this->pluginSettings['view']['templateRootPaths'],
                    'templatePathAndFileName' => $templatePathAndFileName,
                ]
            );
        }

        // set controller extension name for translation
        $view->getRequest()->setControllerExtensionName('Invoicr');

        return $view;
    }

    /**
     * Returns the Partial Root Path
     *
     * For TYPO3 Version 6.2 it resolves the absolute file names
     *
     * @var string $type
     * @return array
     *
     * @deprecated will be removed with support for TYPO3 6.2
     */
    protected function resolveRootPaths($type)
    {
        $rootPaths = [];

        if ($this->pluginSettings['view'][$type]) {
            $rootPaths = $this->pluginSettings['view'][$type];

            if (\TYPO3\CMS\Core\Utility\GeneralUtility::compat_version('6.2')) {
                foreach ($rootPaths as $rootPathsKey => $rootPathsValue) {
                    $rootPaths[$rootPathsKey] = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
                        $rootPathsValue
                    );
                }
            }
        }

        return $rootPaths;
    }
}
