<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOffsiteInfrastructureInNocRequestFormDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //NOC request table add feilds
        Schema::table('noc_request_form_details', function (Blueprint $table){
            if (!Schema::hasColumn('noc_request_form_details', 'offsite_infra_charges')){
                $table->string('offsite_infra_charges')->after('demand_draft_bank')->nullable();                
            }
            if (!Schema::hasColumn('noc_request_form_details', 'offsite_infra_receipt')){
                $table->string('offsite_infra_receipt')->after('offsite_infra_charges')->nullable();                
            }
            if (!Schema::hasColumn('noc_request_form_details', 'offsite_infra_charges_receipt_date')){
                $table->string('offsite_infra_charges_receipt_date')->after('offsite_infra_receipt')->nullable();                 
            }
            if (!Schema::hasColumn('noc_request_form_details', 'water_charges_amount')){
                $table->string('water_charges_amount')->after('offsite_infra_charges_receipt_date')->nullable();                
            }
             if (!Schema::hasColumn('noc_request_form_details', 'water_charges_receipt_number')){
                $table->string('water_charges_receipt_number')->after('water_charges_amount')->nullable();                
            }          
        });

        // add fields in noc_society_documents_master
        Schema::table('noc_society_documents_master', function (Blueprint $table){
            if (!Schema::hasColumn('noc_society_documents_master', 'parent')){
                $table->tinyInteger('parent')->after('is_optional')->default(0);                
            }
            if (!Schema::hasColumn('noc_society_documents_master', 'is_deleted')){
                $table->tinyInteger('is_deleted')->after('parent')->default(0);                
            } 
            if (!Schema::hasColumn('noc_society_documents_master', 'sort_by')){
                $table->tinyInteger('sort_by')->after('has_many')->default(0);                
            }        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('noc_request_form_details', function (Blueprint $table) {
            if (Schema::hasColumn('noc_request_form_details', 'water_charges_receipt_number')){
                 $table->dropColumn('water_charges_receipt_number');               
            } 
            if (Schema::hasColumn('noc_request_form_details', 'offsite_infra_charges')){
                 $table->dropColumn('offsite_infra_charges');               
            } 
            if (Schema::hasColumn('noc_request_form_details', 'offsite_infra_receipt')){
                 $table->dropColumn('offsite_infra_receipt');               
            } 
            if (Schema::hasColumn('noc_request_form_details', 'offsite_infra_charges_receipt_date')){
                 $table->dropColumn('offsite_infra_charges_receipt_date');               
            } 
            if (Schema::hasColumn('noc_request_form_details', 'water_charges_amount')){
                 $table->dropColumn('water_charges_amount');               
            }             
        });

        Schema::table('noc_society_documents_master', function (Blueprint $table){
            if (Schema::hasColumn('noc_society_documents_master', 'parent')){
                $table->dropColumn('parent');                
            }
            if (Schema::hasColumn('noc_society_documents_master', 'is_deleted')){
                $table->dropColumn('is_deleted');                
            } 
            if (Schema::hasColumn('noc_society_documents_master', 'sort_by')){
                $table->dropColumn('sort_by');                
            }        
        });
    }
}
