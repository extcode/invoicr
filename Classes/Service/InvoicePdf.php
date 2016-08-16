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

/**
 * Invoice Pdf
 *
 * @package invoicr
 * @author Daniel Lorenz <ext.invoicr@extco.de>
 */
class InvoicePdf extends \TCPDF
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
     * Plugin Settings
     *
     * @var array
     */
    protected $pluginSettings;

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

    // Page header
    public function Header() {
        $this->pluginSettings =
            $this->configurationManager->getConfiguration(
                \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
                'invoicr'
            );

        $this->SetY(10);
        // Set font
        $this->SetFont('helvetica', '', 8);

        if ($this->pluginSettings['invoicePdf']['header']) {
            foreach ($this->pluginSettings['invoicePdf']['header'] as $partName => $partConfig) {
                $this->renderStandaloneView($partName, $partConfig);
            }
        }
    }

    // Page footer
    public function Footer() {
        $this->pluginSettings =
            $this->configurationManager->getConfiguration(
                \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
                'invoicr'
            );

        // Position at 40 mm from bottom
        $this->SetY(-30);
        // Set font
        $this->SetFont('helvetica', '', 8);

        $view = $this->getStandaloneView('/Pdf/', 'Footer');

        $content = $view->render();
        $content = trim(preg_replace('~[\n]+~', '', $content));

        $this->WriteHTMLCell(
            0, 0, '', '', $content
        );

        // Page number
        $this->Cell(0, 40, $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    /**
     *
     * @return void
     */
    protected function renderStandaloneView($type, $config)
    {
        $view = $this->getStandaloneView('/Pdf/Header/', ucfirst($type));

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

        $this->WriteHtmlCellWithConfig($content, $config);
    }

    protected function WriteHtmlCellWithConfig($content, $config)
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
            $oldFontSize = $this->GetFontSize();
            $this->SetFontSize($config['fontSize']);
        }

        $this->writeHTMLCell(
            $width,
            $height,
            $positionX,
            $positionY,
            $content,
            false,
            2,
            false,
            true,
            $align,
            true
        );

        if ($config['fontSize']) {
            $this->SetFontSize($oldFontSize);
        }
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
