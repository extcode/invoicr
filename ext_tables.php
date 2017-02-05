<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

/**
 * Register Frontend Plugins
 */

$pluginNames = [
    'Invoice',
];

foreach ($pluginNames as $pluginName) {
    $pluginSignature = strtolower(str_replace('_', '', $_EXTKEY)) . '_' . strtolower($pluginName);
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Extcode.' . $_EXTKEY,
        $pluginName,
        $_LLL . ':tx_invoicr.plugin.' . strtolower(preg_replace('/[A-Z]/', '_$0', lcfirst($pluginName)))
    );
    $flexFormPath = 'EXT:' . $_EXTKEY . '/Configuration/FlexForms/' . $pluginName . 'Plugin.xml';
    if (file_exists(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($flexFormPath))) {
        $TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
            $pluginSignature,
            'FILE:' . $flexFormPath
        );
    }
}

if (TYPO3_MODE === 'BE') {

    if (!isset($TBE_MODULES['Invoicr'])) {
        $temp_TBE_MODULES = [];
        foreach ($TBE_MODULES as $key => $val) {
            if ($key == 'file') {
                $temp_TBE_MODULES[$key] = $val;
                $temp_TBE_MODULES['Invoicr'] = '';
            } else {
                $temp_TBE_MODULES[$key] = $val;
            }
        }

        $TBE_MODULES = $temp_TBE_MODULES;
    }

    // add Main Module
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Extcode.' . $_EXTKEY,
        'Invoicr',
        '',
        '',
        [],
        [
            'access' => 'user, group',
            'icon' => 'EXT:invoicr/Resources/Public/Icons/module.' . (\TYPO3\CMS\Core\Utility\GeneralUtility::compat_version('7.0') ? 'svg' : 'gif'),
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xlf:tx_invoicr.module.main',
            'navigationComponentId' => 'typo3-pagetree',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Extcode.' . $_EXTKEY,
        'Invoicr',
        'invoice',
        '',
        [
            'Invoice' => 'list, show, new, create, edit, update, delete, generateInvoiceDocument, downloadInvoiceDocument',
            'Item' => 'show, edit, update',

        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:invoicr/Resources/Public/Icons/module_invoicr.' . (\TYPO3\CMS\Core\Utility\GeneralUtility::compat_version('7.0') ? 'svg' : 'gif'),
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xlf:tx_invoicr.module.invoices',
            'navigationComponentId' => 'typo3-pagetree',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Extcode.' . $_EXTKEY,
        'Invoicr',
        'Customer',
        '',
        [
            'Customer' => 'list',
        ],
        [
            'access' => 'user, group',
            'icon' => 'EXT:invoicr/Resources/Public/Icons/module_customer.' . (\TYPO3\CMS\Core\Utility\GeneralUtility::compat_version('7.0') ? 'svg' : 'gif'),
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xlf:tx_invoicr.module.customer',
            'navigationComponentId' => 'typo3-pagetree',
        ]
    );

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Invoicr');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY,
    'Configuration/TypoScript/ExampleWithTemplate/', 'Invoicr Example With Template');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_invoicr_domain_model_invoice',
    'EXT:invoicr/Resources/Private/Language/locallang_csh_tx_invoicr_domain_model_invoice.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_invoicr_domain_model_invoice');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_invoicr_domain_model_item',
    'EXT:invoicr/Resources/Private/Language/locallang_csh_tx_invoicr_domain_model_item.xlf');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_invoicr_domain_model_customer',
    'EXT:invoicr/Resources/Private/Language/locallang_csh_tx_invoicr_domain_model_customer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_invoicr_domain_model_customer');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_invoicr_domain_model_mandate',
    'EXT:invoicr/Resources/Private/Language/locallang_csh_tx_invoicr_domain_model_mandate.xlf');
