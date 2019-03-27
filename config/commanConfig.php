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
    'la_engineer' => 'la_engineer',

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

    'application_names' => [
        'ree_offer_letter' => 'ree_offer_letter',
        'conveyance' => 'conveyance',
        'renewal' => 'renewal'
    ],

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
       'Send_society_to_pay_stamp_duty' => 10,
       'Stamped_sale_&_lease_deed' => 11,
       'Stamped_signed_sale_&_lease_deed' => 12,
       'Send_society_for_registration_of_sale_&_lease' => 13,
       'Registered_sale_&_lease_deed' => 14,
       'NOC_Issued' => 15,
       'Draft_lease_deed' => 16,
       'Aproved_lease_deed' => 17,
       'Draft_Renewal_of_Lease_deed' => 18,
       'Aproved_Renewal_of_Lease' => 19,
       'NOC_Generation' => 20,
       'draft_offer_letter_generated' => 21,
       'draft_tripartite_agreement'=>22,
       'approved_tripartite_agreement'=>23,
       'OC_Approved' => 24, 
       'OC_Generation' => 25,
       'sent_for_stamp_duty_registration'=>26,
   ],



    /*'applicationStatus' => [
        'in_process' => 1,
        'forwarded' => 2,
        'reverted' => 3,
        'pending' => 4,
        'offer_letter_generation' => 5,
        'offer_letter_approved' => 6,
        'sent_to_society' => 7,
    ],*/

    'tripartite_fields' => [
        'revised_offer_letter_number',
        'revised_offer_letter_date',
        'offer_letter_number',
        'offer_letter_date',
        'noc_for_iod_purpose_number',
        'noc_for_iod_purpose_date',
        'developer_name'
    ],

//    'society_details_fields' => [
//        'layout_id',
//        ''
//    ],

    //conveyance status

    'conveyance_status' => [
        'in_process' => 1,
        'forwarded' => 2,
        'reverted' => 3,
        'pending' => 4,
        'Draft_sale_&_lease_deed' => 8,
        'Approved_sale_&_lease_deed' => 9,
        'Send_society_to_pay_stamp_duty' => 10,
        'Stamped_sale_&_lease_deed' => 11,
        'Stamped_signed_sale_&_lease_deed' => 12,
        'Send_society_for_registration_of_sale_&_lease' => 13,
        'Registered_sale_&_lease_deed' => 14,
        'NOC_Issued' => 15,
        'society_stamp_duty' => 'Pay Stamp Duty',
        'society_register_sale_lease_deed' => 'Register Sale & Lease Deed'
    ],

    //renewal status
    'renewal_status' => [
        'in_process' => 1,
        'forwarded' => 2,
        'reverted' => 3,
        'pending' => 4,
        'Draft_Renewal_of_Lease_deed' => 18,
        'Approved_Renewal_of_Lease' => 19,
        // 'NOC_Generation' => 20,
        'Send_society_to_pay_stamp_duty' => 10,
        'Stamp_Renewal_of_Lease_deed' => 24,
        'Stamp_Sign_Renewal_of_Lease_deed' => 25,
        'Send_society_for_registration_of_Lease_deed' => 27,
        'Registered_lease_deed' => 28,
    ],

    'formation_status'=>[
        'in_process' => 1,
        'forwarded' => 2,
        'reverted' => 3,
        'processed_to_DDR'=>4
    ],

    'formation_status_color'=>[
        '1' => 'danger',
        '2' => 'info',
        '3' => 'danger',
        '4' => 'success'
    ],

    // sc application agreements
     'scAgreements' => [
        'sale_deed_agreement'  => 'Sale Deed Agreement',
        'lease_deed_agreement' => 'Lease Deed Agreement',
        'renewal_lease_deed_agreement' => 'Renewal Lease Deed Agreement',
        'conveyance_text_stamp_duty_letter' => 'conveyance_text_stamp_duty_letter',
        'conveyance_draft_stamp_duty_letter' => 'conveyance_draft_stamp_duty_letter',
        'conveyance_stamp_duty_letter' => 'conveyance_stamp_duty_letter',
        'renewal_text_stamp_duty_letter' => 'renewal_text_stamp_duty_letter',
        'renewal_draft_stamp_duty_letter' => 'renewal_draft_stamp_duty_letter',
        'renewal_stamp_duty_letter' => 'renewal_stamp_duty_letter',
        'conveynace_draft_NOC' => 'conveynace_draft_NOC',
        'conveynace_text_NOC' => 'conveynace_text_NOC',
        'conveynace_uploaded_NOC' => 'conveynace_uploaded_NOC',        
        'renewal_draft_NOC' => 'renewal_draft_NOC',
        'renewal_text_NOC' => 'renewal_text_NOC',
        'renewal_uploaded_NOC' => 'renewal_uploaded_NOC',
    ],   
 
      // sc application Type
     'applicationType' => [
        'Conveyance'  => 'Conveyance',
        'Renewal'     => 'Renewal',
        'Formation' => 'Formation'
    ], 

      // sc documents
     'documents' => [
        'society' => [
            'stamp_conveyance_application' => 'stamp_conveyance_application',
            'stamp_renewal_application' => 'stamp_renewal_application',
            'list_of_members_from_society' => 'list_of_members_from_society',
            'pay_stamp_duty_letter' => 'pay_stamp_duty_letter',
            'conveyance_stamp_duty_letter' => 'conveyance_stamp_duty_letter',
            'Sale Deed Agreement' => 'Sale Deed Agreement',
            'Lease Deed Agreement' => 'Lease Deed Agreement',
            'sc_resolution' => 'sc_resolution',
            'sc_undertaking' => 'sc_undertaking',
            'Stamped_Signed' => 'Stamped_Signed',
            'Stamped_Signed_by_dycdo' => 'Stamped_Signed_by_dycdo',
            'Stamp_by_jtco' => 'Stamp_by_jtco',
            'Stamp_by_dycdo' => 'Stamp_by_dycdo',
            'Draft' => 'Draft',
            'Register' => 'Register',
            'Stamped' => 'Stamped',
            'Approved' => 'Approved',
            'Draft_Sign' => 'Draft_Sign',
            'renewal_lease_deed_agreement' => 'Renewal Lease Deed Agreement',
            'renewal_stamp_duty_letter' => 'renewal_stamp_duty_letter'
        ],
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
            ],
            'stamp_conveyance_application' => 'stamp_conveyance_application',
            'society_list' => [
                'अधिकृत सभासदांची यादी (पती व पत्नी संयुक्त नावे)'
            ]
        ],
         'em_renewal' => [
             'stamp_renewal_application' => 'stamp_renewal_application',
             'no_dues_certificate' => [
                 'renewal_text_no_dues_certificate',
                 'renewal_drafted_no_dues_certificate',
                 'renewal_uploaded_no_dues_certificate',
             ],
             'bonafide' => [
                 'renewal_bonafide_list',
             ],
             'covering_letter' => [
                 'renewal_em_covering_letter'
             ],
             'society_list' => [
                 'list_of_members_from_society'
             ]
         ],
         'la_renewal' => [
             'Lease Deed Agreement' => 'renewal_Lease Deed Agreement'
         ]
    ], 

    'tripartite_agreements'=>[
        'text'=>'text_tripartite_agreement',
        'drafted'=>'drafted_tripartite_agreement',
        'drafted_signed'=>'drafted_signed_tripartite_agreement',
        'ree_note'=>'tripartite_ree_note',
        'letter_1_draft' => 'drafted_letter_for_stamp_duty',
        'letter_1_text' => 'text_letter_for_stamp_duty',
        'letter_2_draft' => 'drafted_letter_for_execution_and_registration',
        'letter_2_text' => 'text_letter_for_execution_and_registration'

    ],

    // sc Application types 
    //  'scApplication' => [
    //     'draft_sale_agreement'       => 'draft_sale_agreement',
    // ],      

    'applicationStatusColor' => [
        '1' => 'danger',
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
        '13' => 'success',
        '14' => 'purple',
        '15' => 'success',
        '23' => 'success', 
        '26'=>'info',
        '27'=>'success'
    ],

    'architect_applicationStatus' => [
        'new_application' => 1,
        'scrutiny_pending' => 2,
        'forward' => 3,
        'approved' => 4,
        'pending' => 5
    ],
    'architect_applicationStatusColor' => [
        '1' => 'metal',
        '2' => 'danger',
        '3' => 'info',
        '4' => 'success',
        '5' => 'danger',
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

    'architect_layout_status_color' => [
        '1' => 'metal',
        '2' => 'danger',
        '3' => 'info',
        '4' => 'metal',
        '5' => 'danger',
        '6' => 'success'
    ],

    'architect_application_status' => [
        'none' => 0,
        'shortListed' => 1,
        'final' => 2,
    ],

    'ee_junior_engineer' => 'ee_junior_engineer',

    'society_offer_letter' => 'society',

    'appointing_architect' => 'appointing_architect',

    //Staging, testing, local society domain names
    'staging' => 'society',
    'testing' => 'societytest',

    // Hearing Statuses

    'joint_co' => 'Joint CO',
    'co' => 'Co',

    'joint_co_pa' => 'Joint Co PA',
    'co_pa' => 'Co PA',


    // hearing Department
    'hearing_department' => [
       'co' => 'Co',
       'joint_co' => 'Joint CO'
    ],



    'hearingStatus' => [
        'pending' => 1,
        'scheduled_meeting' => 2,
        'case_under_judgement' => 3,
        'forwarded' => 4,
        'notice_send' => 5,
        'case_closed' => 6,
    ],
    'rti_officer'=>'RTI',
    'rti_appellate'=>'RTI_Appellate',
    'rti_form_status' => 'Send RTI Officer',

    'rti_status'=>[
        'sent_to_rti_officer'=>1,
        'in_process'=>2,
        'meeting_is_scheduled'=>3,
        'closed'=>4,
        'forwarded'=>5,
        'send_to_appellate'=>6
    ],
    'rti_statusColor' => [
        '1' => 'metal',
        '2' => 'info',
        '3' => 'danger',
        '4' => 'success',
        '5'=>'info'
        // 'final' => 5
    ],
    'sc_excel_headers' => [
        'Sr No', 'Tenament No', 'Tenament Full Name', 'Residential/Non-Residential'
    ],

    'sc_excel_headers_em' => [
        'Sr No', 'Tenament No', 'Tenament Full Name', 'Residential/Non-Residential', 'Carpet area of Each Tenement (Sq.Mtrs)', 'Cost of Construction of each tenement (In Rs.)', 'Premium of Land of Each Tenement (In Rs.)'
    ],

    'optional_docs_premium' => [
        '8', '13', '15'
    ],

    'optional_docs_sharing' => [
        '11', '13', '17'
    ],

    'optional_docs_premium_reval' => [
        '82','90'
    ],

    'optional_docs_sharing_reval' => [
        '86', '94'
    ],

    'optional_docs_premium_oc' => [
        '106','130'
    ],

    'optional_docs_sharing_oc' => [
        '118', '142'
    ],

    'optional_docs_society_noc' => [
        '5', '11', '17', '23'
    ],

    'optional_docs_society_noc_cc' => [
        '3', '6'
    ],

    'new_offer_letter_master_ids' => [
        '2', '6', '13', '17'
    ],

    'revalidation_master_ids' => [
        '3', '7', '14', '18'
    ],

    'oc_master_ids' => [
        '5', '11', '16', '22'
    ],

    'noc_master_ids' => [
        '4', '8', '15', '19'
    ],

    'noc_cc_master_ids' => [
        '10', '21'
    ],

//    'oc_master_ids' => [
//        '5', '11' , '16' , '22'
//    ],

    'tripartite_master_ids' => [
        '9', '20'
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
    ],

    'preview_routes_without_id' => [
        'society_offer_letter_preview',
        'society_reval_offer_letter_preview',
        'society_oc_preview',
        'society_noc_preview',
        'society_noc_cc_preview'
    ],
    'pendency_report_periods'=>[
        '0-30'=>'0-30 days',
        '31-60'=>'31-60 days',
        '61-90'=>'61-90 days',
        '91-120'=>'91-120 days'
    ],
    'sms_settings'=>[
        'loginID'=>'t1mhada',
        'password'=>'Mh@d@18',
        'senderid'=>'MHADAB',
        'route_id'=>2,
        'Unicode'=>0,
        'IP'=>'180.149.241.179'
    ],

    'module_names'=>[
        'New - Offer Letter' => 'new_offer_letter_master_ids',
        'Revalidation Of Offer Letter'=>'revalidation_master_ids',
        'Tripartite Agreement'=>'tripartite_master_ids',
        'Application for NOC'=>'noc_master_ids',
        'Consent for OC'=>'oc_master_ids',
        'Application for CC'=>'noc_cc_master_ids'
    ],

    // email and msg content
    'email_content'=>[
        'society_registration'=>'You have successfully registered on MHADA portal with username: <username>, Now you can login to apply for various MHADA Mumbai board services, using username & password that you have created while registration.',
        'society_submission'=>'Your application for <application type> of <Society name> have been successfully sent to MHADA. Your application number is <application number>.',
        'user_application' => 'You have received new application for <application type>, of society <Society name> with application ID <application Number>',
        'head_application' => 'Your department have received new application for <application type>, of society <Society name> with application ID <application Number>.',
    ],
    'msg_content'=>[
        'society_registration'=>'Congratulations! You have registered successfully on MHADA Mumbai portal. Now you can login to apply for various MHADA Mumbai board services, using valid login credentials.',
        'society_submission'=>'Congratulations! You have successfully submitted application for <application type>. Your application number is <application number>.',
        'user_application' => 'You have received new application for <application type>, of society <Society name> with application ID <application Number>',
        'head_application' => 'Your department have received new application for <application type>, of society <Society name> with application ID <application Number>.',
    ],
    'email_subject' => [
        'society_registration'=> 'Registration on Mumbai board portal',
        'society_submission'=> 'Application for <application type> – Mumbai Board, MHADA',
        'user_application' => 'New application for <application type>',
        'head_application' => 'New application in your dept. for <application type>'
    ]

];
