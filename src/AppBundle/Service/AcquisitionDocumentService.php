<?php

namespace AppBundle\Service;

use AppBundle\Entity\Document;

/**
 * Class AcquisitionDocumentService
 * @package AppBundle\Service
 */
class AcquisitionDocumentService extends DocumentService
{
    /**
     * @param Document $document
     * @return array
     */
    public function fillPlaceholders(Document $document)
    {
        parent::fillPlaceholders($document);

        return array(
            'PLACEHOLDER_DEPARTMENT' => 'Software Development',
            'PLACEHOLDER_APPLICANT_NAME' => 'John Doe',
            'PLACEHOLDER_APPLICANT_JOB_TITLE' => 'Manager',
            'PLACEHOLDER_SUPPLIER_NAME' => 'DELL',
            'PLACEHOLDER_SUPPLIER_CODE' => 'DEL12345',
            'PLACEHOLDER_PAYMENT_METHOD' => 'Cash',
            'PLACEHOLDER_BILL_DATE' => '12 Feb 2017',
            'PLACEHOLDER_BILL_DUE_DATE' => '12 Apr 2017',
            'PLACEHOLDER_REQUESTED_SERVICES' => 'Equipments',
            'PLACEHOLDER_BILL_NUMBER' => 'FF 3345',
            'PLACEHOLDER_COMPANY_COST_CENTER' => '12AB456789',
            'PLACEHOLDER_TOTAL_FOR_SERVICE' => '123.09',
            'PLACEHOLDER_SUPPLIER_BANK_NAME' => 'Bank AAA',
            'PLACEHOLDER_SUPPLIER_BANK_NAME_2' => 'BANK BBB',
            'PLACEHOLDER_SUPPLIER_BANK_ACCOUNT' => 'BANK ACC0 UNT1 0000 1111',
            'PLACEHOLDER_SUPPLIER_BANK_ACCOUNT_2' => 'BANK ACC0 UNT2 3333 4444',
            'PLACEHOLDER_AQUISITION_TOTAL' => '123.09 RON',
            'PLACEHOLDER_FINANCIAL_MANAGER' => 'Alice Finance-Mng',

            'PLACEHOLDER_COMPANY_NAME' => 'Software Company',
            'PLACEHOLDER_COMPANY_CODE' => '11223344',
            'PLACEHOLDER_COMPANY_COMMERCIAL_CODE' => '01/12/1234',
            'PLACEHOLDER_COMPANY_PHONE' => '021 123 4567',
        );
    }
}
