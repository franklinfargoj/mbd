<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class AppointingArchitectPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name'         => 'appointing_architect.index',
                'display_name' => 'index',
                'description'  => 'index'
            ]
        ];
        $appointing_architect = Role::where('name', '=', 'appointing_architect')->select('id')->first();

        if($appointing_architect)
        {
            $role_id=$appointing_architect->id;
        }else
        {
            $role_id = Role::insertGetId([
                'name'         => 'appointing_architect',
                'redirect_to'  => '/appointing_architect/index',
                'parent_id'    => NULL,
                'display_name' => 'appointing_architect',
                'description'  => 'appointing_architect'
            ]);
        }

        $permission_role = [];

        foreach($permissions as $per)
        {
            $permission=Permission::where(['name'=>$per['name']])->first();
            if($permission)
            {
                $permission_id=$permission->id;
            }else
            {
                $permission_id = Permission::insertGetId($per);
            }
            
            if(PermissionRole::where(['permission_id' => $permission_id,'role_id' => $role_id])->first())
            {

            }else
            {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id,
                ];
            }
            
        }
        if(count($permission_role)>0)
        {
            PermissionRole::insert($permission_role); 
        }
               
    }
}
