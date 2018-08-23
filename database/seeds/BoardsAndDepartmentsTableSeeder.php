<?php

use Illuminate\Database\Seeder;
use App\Board;
use App\Department;
use App\BoardDepartment;

class BoardsAndDepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boards = Board::select('id')->get();
        
        if(count($boards) == 0)
        {
        	$createdBoard = Board::create([
				        		'board_name' => 'Mumbai Board',
				        		'status' => 1
				        	]);

        	$createdDepartment = Department::create([
				        		'department_name' => 'Department 1',
				        		'status' => 1
				        	]);

        	BoardDepartment::create([
        		'board_id' => $createdBoard->id,
        		'department_id' => $createdDepartment->id
        	]);
        }
    }
}
