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

    //Branch Head 
    'ee_branch_head'   => 'ee_engineer',
    'dyce_branch_head' => 'dyce_engineer',
    'ree_branch_head'  => 'ree_engineer',

    'junior_architect'=>'junior_architect',
    'senior_architect'=>'senior_architect',
    'architect'=>'architect',

    'selection_commitee'=>'selection_commitee',

    'applicationStatus' => [
        'in_process' => 1,
        'forwarded' => 2,
        'reverted' => 3,
        'pending' => 4,
        'offer_letter_generation' => 5,
        'offer_letter_approved' => 6,
        'sent_to_society' => 7
    ],
   
    'architect_applicationStatus' => [
        'new_application' => 1,
        'scrutiny_pending' => 2,
        'forward' => 3,
        // 'shortListed' => 4,
        // 'final' => 5
    ],
    'architect_application_status' => [
        'none'=>0,
        'shortListed' => 1,
        'final' => 2
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

    'storage_server' => 'http://storage.mhada.php-dev.in',
];