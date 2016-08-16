<?php

defined('TYPO3_MODE') or die();

$_LLL = 'LLL:EXT:invoicr/Resources/Private/Language/locallang_db.xlf';

return [
    'ctrl' => [
        'title' => 'LLL:EXT:invoicr/Resources/Private/Language/locallang_db.xlf:tx_invoicr_domain_model_invoice',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,

        'versioningWS' => 2,
        'versioning_followPages' => true,

        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'requestUpdate' => 'type_of_payment',
        'searchFields' => 'title,description,begin_period_of_performance_date,end_period_of_performance_date,invoice_date,was_sent_at,was_paid_at,invoice_pdf,items,',
        'iconfile' => 'EXT:invoicr/Resources/Public/Icons/tx_invoicr_domain_model_invoice.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, customer, invoice_number, title, description, content_above, content_below, begin_period_of_performance_date, end_period_of_performance_date, invoice_date, type_of_payment, terms_of_payment, was_sent_at, was_paid_at, invoice_pdf, items, price, tax, total_price',
    ],
    'types' => [
        '1' => [
            'showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,
                customer,
                --palette--;LLL:EXT:invoicr/Resources/Private/Language/locallang_db.xlf:tx_invoicr_domain_model_invoice.palette.offer_data;offer_data,
                --palette--;LLL:EXT:invoicr/Resources/Private/Language/locallang_db.xlf:tx_invoicr_domain_model_invoice.palette.invoice_data;invoice_data,
                title, description, content_above, content_below,
                --palette--;LLL:EXT:invoicr/Resources/Private/Language/locallang_db.xlf:tx_invoicr_domain_model_invoice.palette.period_of_performance;period_of_performance,
                type_of_payment, terms_of_payment, was_sent_at, was_paid_at, items, invoice_pdf,
                price, tax, total_price'
        ],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
        'offer_data' => ['showitem' => 'offer_date, offer_number', 'canNotCollapse' => 1],
        'invoice_data' => ['showitem' => 'invoice_date, invoice_number', 'canNotCollapse' => 1],
        'period_of_performance' => [
            'showitem' => 'begin_period_of_performance_date, end_period_of_performance_date',
            'canNotCollapse' => 1
        ],
    ],
    'columns' => [

        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_invoicr_domain_model_invoice',
                'foreign_table_where' => 'AND tx_invoicr_domain_model_invoice.pid=###CURRENT_PID### AND tx_invoicr_domain_model_invoice.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],

        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],

        'invoice_date' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.invoice_date',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'size' => 7,
                'eval' => 'date',
                'checkbox' => 0,
                'default' => '0000-00-00'
            ],
        ],
        'invoice_number' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.invoice_number',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ],
        ],
        'offer_date' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.offer_date',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'size' => 7,
                'eval' => 'date',
                'checkbox' => 0,
                'default' => '0000-00-00'
            ],
        ],
        'offer_number' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.offer_number',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ],
        ],
        'title' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'description' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'eval' => 'trim',
                'wizards' => [
                    'RTE' => [
                        'icon' => 'wizard_rte2.gif',
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
                        'type' => 'script',
                        'module' => array(
                            'name' => 'wizard_rte',
                        ),
                    ]
                ]
            ],
        ],
        'content_above' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.content_above',
            'config' => [
                'type' => 'text',
                'cols' => 80,
                'rows' => 5,
                'eval' => 'trim',
                'wizards' => [
                    'RTE' => [
                        'icon' => 'wizard_rte2.gif',
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
                        'type' => 'script',
                        'module' => array(
                            'name' => 'wizard_rte',
                        ),
                    ]
                ]
            ],
        ],
        'content_below' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.content_below',
            'config' => [
                'type' => 'text',
                'cols' => 80,
                'rows' => 5,
                'eval' => 'trim',
                'wizards' => [
                    'RTE' => [
                        'icon' => 'wizard_rte2.gif',
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
                        'type' => 'script',
                        'module' => array(
                            'name' => 'wizard_rte',
                        ),
                    ]
                ]
            ],
        ],
        'begin_period_of_performance_date' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.begin_period_of_performance_date',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'size' => 7,
                'eval' => 'date',
                'checkbox' => 0,
                'default' => '0000-00-00'
            ],
        ],
        'end_period_of_performance_date' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.end_period_of_performance_date',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'size' => 7,
                'eval' => 'date',
                'checkbox' => 0,
                'default' => '0000-00-00'
            ],
        ],
        'type_of_payment' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.type_of_payment',
            'config' => [
                'type' => 'select',
                'items' => [
                    [
                        $_LLL . ':tx_invoicr_domain_model_invoice.type_of_payment.transfer',
                        'transfer'
                    ],
                    [
                        $_LLL . ':tx_invoicr_domain_model_invoice.type_of_payment.direct_debit',
                        'direct_debit'
                    ],
                ],
                'eval' => 'required'
            ],
        ],
        'terms_of_payment' => [
            'exclude' => 1,
            'displayCond' => 'FIELD:type_of_payment:=:transfer',
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.terms_of_payment',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'was_sent_at' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.was_sent_at',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'size' => 7,
                'eval' => 'date',
                'checkbox' => 0,
                'default' => '0000-00-00'
            ],
        ],
        'was_paid_at' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.was_paid_at',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'size' => 7,
                'eval' => 'date',
                'checkbox' => 0,
                'default' => '0000-00-00'
            ],
        ],
        'invoice_pdf' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.invoice_pdf',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'invoicePdf',
                ['maxitems' => 1],
                '*'
            ),
        ],
        'items' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.items',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_invoicr_domain_model_item',
                'foreign_field' => 'invoice',
                'maxitems' => 9999,
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 0,
                    'showPossibleLocalizationRecords' => 0,
                    'showAllLocalizationLink' => 0,
                    'useSortable' => 1,
                    'useCombination' => 1,
                    'newRecordLinkPosition' => 'bottom',
                ],
            ],
        ],
        'price' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.price',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'tax' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.tax',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'total_price' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.total_price',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'customer' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_invoice.customer',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_invoicr_domain_model_customer',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
];
