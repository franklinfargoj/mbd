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
        // $this->call(UsersTableSeeder::class);
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

        // $this->call(RtiFormTableSeeder::class);
    }
}