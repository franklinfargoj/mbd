<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */ 
    public function run()
    {
        $this->call(AddEEDivisionsSeeder::class);
        // $this->call(MasterLayoutSeeder::class);
        $this->call(ResolutionTypesTableSeeder::class);
        $this->call(BoardsAndDepartmentsTableSeeder::class);
        $this->call(ApplicationTypeSeeder::class);
        $this->call(HearingStatusSeeder::class);

        $this->call(LandSourceSeeder::class);
        $this->call(OtherLandSeeder::class);

        $this->call(MasterRtiStatusTableSeeder::class);
        $this->call(MasterMonthTableSeeder::class);

        $this->call(LanguageMasterTableSeeder::class);
        $this->call(OlApplicationMasterTableSeeder::class);

        $this->call(OlDcrRateMasterTableSeeder::class);
        $this->call(OlSocietyDocumentsMasterTableSeeder::class);

        $this->call(OlConsentVerificationQuestion::class);
        $this->call(OlDemarcationVerificationQuestion::class);
        $this->call(OlRgRelocationVerificationQuestion::class);
        $this->call(OlTitBitVerificationQuestion::class);
        $this->call(SocietyPermissionSeeder::class);
        
        $this->call(EEUserSeeder::class);
        $this->call(DYCEPermissionSeeder::class);
        $this->call(LmPermissionSeeder::class);

        $this->call(HearingPermissionSeeder::class);
        $this->call(ReePermissionSeeder::class);
        $this->call(CapPermissionSeeder::class);
        $this->call(CoPermissionSeeder::class);
        $this->call(ResolutionPermissionSeeder::class);
        $this->call(RTIPermissionSeeder::class);
        $this->call(VpPermission::class);
        $this->call(AddChildToReeModuleSeeder::class);
        $this->call(AddSuperAdminToRoleTableSeeder::class);
        $this->call(ArchitectUserSeeder::class);
        $this->call(SelectionCommiteeSeeder::class);

         $this->call(EmPermissionSeeder::class);
         $this->call(RCUserSeeder::class);
        $this->call(ArchitectLayoutLmScrtinyQuestionMasterSeeder::class);
        $this->call(ArchitectLayoutEmScrtinyQuestionMasterSeeder::class);
        $this->call(ArchitectLayoutReeScrtinyQuestionMasterSeeder::class);
        $this->call(ArchitectLayoutEEScrtinyQuestionMasterSeeder::class);
        // $this->call(RtiFormTableSeeder::class);

        $this->call(MasterTables::class);
         // $this->call(RtiFormTableSeeder::class);

        
        // $this->call(SocietyConveyanceDocumentMasterSeeder::class);
        $this->call(DYCOPermissions::class);
        $this->call(AppointingArchitectPermissionSeeder::class);
        $this->call(AddChildParentToConveyanceModule::class);
        $this->call(LAPermission::class);
        $this->call(sc_checklist_master::class);
        $this->call(SocietyConveyanceApplicationTypeSeeder::class);
        $this->call(SocietyConveyanceDocumentMasterSeeder::class);
        $this->call(ApplicationStatusMasterSeeder::class);
        $this->call(SapPermissionSeeder::class);
        $this->call(OlCustomCalculationMaster::class);

//        $this->call(SfScrtinyByEmMasterSeeder::class);

        $this->call(AccountPermissionSeeder::class);
        $this->call(SfScrtinyByEmMasterSeeder::class);

        $this->call(NocScrutinyQuestionMasterTable::class);
        $this->call(NocSocietyDocumentsMasterTableSeeder::class);

        $this->call(NocCCSocietyDocumentsMasterTableSeeder::class);
        $this->call(ChangeSomeFieldValuesInDatabase::class);

        $this->call(OcScrutinyQuestionMasterTable::class);

        $this->call(NatureOfBuildingSeeder::class);
        $this->call(ServiceChargeTableSeeder::class);
    }
}