<?php

return [

    /*
    |
    | List number of records per page while pagination
    |
     */

    'list_num_of_records_per_page' => 10,
    'dateFormat' => 'd-m-Y',

    'dyce_jr_user' => 'dyce_junior_engineer',
    'ee_junior_engineer' => 'ee_junior_engineer',
    'co_engineer' => 'co_engineer',
    'cap_engineer' => 'cap_engineer',
    'vp_engineer' => 'vp_engineer',
    'ree_junior' => 'REE Junior Engineer',
    'dycdo_engineer' => 'dycdo_engineer',
    'dyco_engineer' => 'dyco_engineer',

    'senior_architect_planner'=>'senior_architect_planner',

    //Branch Head 
    'ee_branch_head' => 'ee_engineer',
    'dyce_branch_head' => 'dyce_engineer',
    'ree_branch_head' => 'ree_engineer',

    //deputy
    'ee_deputy_engineer' => 'ee_dy_engineer',
    'dyce_deputy_engineer' => 'dyce_deputy_engineer',
    'ree_deputy_engineer' => 'REE deputy Engineer',
    'ree_assistant_engineer' => 'REE Assistant Engineer',

    'junior_architect' => 'junior_architect',
    'senior_architect' => 'senior_architect',
    'architect' => 'architect',

    'land_manager'=>'LM',

    'legal_advisor'=>'la_engineer',

    'estate_manager'=>'EM',

    'selection_commitee' => 'selection_commitee',

    'applicationStatus' => [
        'in_process' => 1,
        'forwarded' => 2,
        'reverted' => 3,
        'pending' => 4,
        'offer_letter_generation' => 5,
        'offer_letter_approved' => 6,
        'sent_to_society' => 7,
        'Draft_sale_&_lease_deed' => 8,
        'Aproved_sale_&_lease_deed' => 9,
        'Sent_society_to_pay_stamp_duety' => 10,
        'Stamped_sale_&_lease_deed' => 11,
        'Stamped_signed_sale_&_lease_deed' => 12,
        'Sent_society_for_registration_of_sale_&_lease' => 13,
        'Registered_sale_&_lease_deed' => 14,
        'NOC_Issued' => 15,
    ],

    // sc application agreements
     'scAgreements' => [
        'sale_deed_agreement'  => 'Sale Deed Agreement',
        'lease_deed_agreement' => 'Lease Deed Agreement',
    ],   

      // sc application Type
     'applicationType' => [
        'Conveyance'  => 'Conveyance',
        'Renewal'     => 'Renewal',
    ], 

      // sc documents
     'documents' => [
        'dycdo_note'  => 'dycdo_note',
        'architect_conveyance_map' => 'architect_conveyance_map',
        'em_conveyance' => [
            'no_dues_certificate' => [
                'text_no_dues_certificate',
                'drafted_no_dues_certificate',
                'uploaded_no_dues_certificate',
            ],
            'bonafide' => [
                'bonafide_list',
            ],
            'covering_letter' => [
                'em_covering_letter'
            ]
        ]
    ], 

    // sc Application types 
    //  'scApplication' => [
    //     'draft_sale_agreement'       => 'draft_sale_agreement',
    // ],      

    'applicationStatusColor' => [
        '1' => 'metal',
        '2' => 'info',
        '3' => 'danger',
        '4' => 'metal',
        '5' => 'purple',
        '6' => 'purple',
        '7' => 'success', 
        '8' => 'purple', 
        '9' => 'purple', 
        '10' => 'success', 
        '11' => 'purple', 
        '12' => 'purple', 
        '13' => 'success', 
        '14' => 'purple', 
        '15' => 'success', 
    ],

    'architect_applicationStatus' => [
        'new_application' => 1,
        'scrutiny_pending' => 2,
        'forward' => 3,
         'approved' => 4,
        // 'final' => 5
    ],
    'architect_layout_status' => [
        'new_application' => 1,
        'scrutiny_pending' => 2,
        'forward' => 3,
        'sent_for_revision' => 4,
        'reverted' => 5,
        'approved'=> 6
    ],
    'architect_application_status' => [
        'none' => 0,
        'shortListed' => 1,
        'final' => 2,
    ],

    'ee_junior_engineer' => 'ee_junior_engineer',

    'society_offer_letter' => 'society',

    'appointing_architect' => 'appointing_architect',

    // Hearing Statuses

    'joint_co' => 'Joint CO',
    'co' => 'Co',

    'joint_co_pa' => 'Joint Co PA',
    'co_pa' => 'Co PA',
    'hearingStatus' => [
        'pending' => 1,
        'scheduled_meeting' => 2,
        'case_under_judgement' => 3,
        'forwarded' => 4,
        'notice_send' => 5,
        'case_closed' => 6,
    ],

    'rti_form_status' => 'Send RTI Officer',

    'sc_excel_headers' => [
        'Sr No', 'Tenament No', 'Tenament Name', 'Residential/Non-Residential'
    ],

    'optional_docs_premium' => [
        '8', '13', '15', '19'
    ],

    'optional_docs_sharing' => [
        '11', '13', '17'
    ],

    'storage_server' => 'http://storage.mhada.php-dev.in',


    'eoa_panel_categories'=>[
        'HOUSING'=>1,
        'LANDSCAPE'=>2
    ],
    'eoa_imp_senior_professionals_category'=>[
        'AR'=>'ARCHITECT',
        'EN'=>'ENGINEER',
        'OT'=>'OTHER'
    ],
    'eoa_imp_senior_professionals_qualifications'=>[
        'DIP'=>'DIPLOMA',
        'DEG'=>'DEGREE',
        'PG'=>'POST GRADUATE',
        'DR'=>'DOCTORATE'
    ],

    'mhada_code' => 'MHD',


    'SOCIETY_LEVEL_BILLING' => '1',
    'TENANT_LEVEL_BILLING' => '2',
    'PAYMENT_STATUS_NOT_PAID' => '0',
    'PAYMENT_STATUS_PAID' => '1',

    'no_dues_certificate' => [
        'db_columns' => [
            'draft' => 'drafted_no_dues_certificate',
            'text' => 'text_no_dues_certificate',
            'upload' => 'uploaded_no_dues_certificate',
        ],
        'redirect_message' => [
            'draft_text' => 'No dues certificate generated successfully.',
            'upload' => 'Uploaded No dues certificate successfully.',
        ],
        'redirect_message_status' => [
            'draft_text' => 'drafted',
            'upload' => 'uploaded',
        ]
    ]
];
