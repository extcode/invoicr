<?php

defined('TYPO3_MODE') or die();

$_LLL = 'LLL:EXT:invoicr/Resources/Private/Language/locallang_db.xlf';

return [
    'ctrl' => [
        'title' => 'LLL:EXT:invoicr/Resources/Private/Language/locallang_db.xlf:tx_invoicr_domain_model_mandate',
        'label' => 'reference',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,

        'versioningWS' => 2,
        'versioning_followPages' => true,

        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'reference,',
        'iconfile' => 'EXT:invoicr/Resources/Public/Icons/tx_invoicr_domain_model_mandate.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, reference, mandate_type, granting_date, revocation_date, account_holder, credit_institution, iban, bic',
    ],
    'types' => [
        '1' => ['showitem' => 'hidden;;1, reference, mandate_type, granting_date, revocation_date, account_holder, credit_institution, iban, bic, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
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
        'reference' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_invoicr_domain_model_mandate.reference',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'required, trim'
            ],
        ],
        'mandate_type' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_invoicr_domain_model_mandate.mandate_type',
            'config' => [
                'type' => 'select',
                'items' => [
                    [
                        $_LLL . ':tx_invoicr_domain_model_mandate.mandate_type.recurring_payment',
                        'recurring_payment'
                    ],
                    [
                        $_LLL . ':tx_invoicr_domain_model_mandate.mandate_type.one_off_payment',
                        'one_off_payment'
                    ],
                ],
                'eval' => 'required'
            ],
        ],
        'granting_date' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => $_LLL . ':tx_invoicr_domain_model_mandate.granting_date',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'require, datetime',
                'checkbox' => 0,
                'default' => 0,
            ],
        ],
        'revocation_date' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => $_LLL . ':tx_invoicr_domain_model_mandate.revocation_date',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
            ],
        ],
        'account_holder' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_invoicr_domain_model_mandate.account_holder',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'required, trim'
            ],
        ],
        'credit_institution' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_invoicr_domain_model_mandate.credit_institution',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'iban' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_invoicr_domain_model_mandate.iban',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'required, trim'
            ],
        ],
        'bic' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_invoicr_domain_model_mandate.bic',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'customer' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

    ],
];
