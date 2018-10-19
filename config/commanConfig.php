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
    ],

    'applicationStatusColor' => [
        '1' => 'metal',
        '2' => 'info',
        '3' => 'danger',
        '4' => 'metal',
        '5' => 'purple',
        '6' => 'purple',
        '7' => 'success',
    ],

    'architect_applicationStatus' => [
        'new_application' => 1,
        'scrutiny_pending' => 2,
        'forward' => 3,
        // 'shortListed' => 4,
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
        'Sr No', 'Tenament No', 'Tenament Name'
    ],

    'optional_docs_premium' => [
        '8', '13', '15', '19'
    ],

    'optional_docs_sharing' => [
        '11', '13', '17'
    ],

    'storage_server' => 'http://storage.mhada.php-dev.in',
];
