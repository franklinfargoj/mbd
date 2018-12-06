<?php

use Illuminate\Database\Seeder;
use App\Role;

class AddChildToReeModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Society Role ID
        $society_role_id = Role::where('name', '=', 'society')->first();

        // EE Branch Head Role ID
        $ee_head_id = Role::where('name', '=', 'ee_engineer')->first();

        // EE Deputy Role ID
        $ee_deputy_id = Role::where('name', '=', 'ee_dy_engineer')->first();

        // EE Junior Role ID
        $ee_jr_id = Role::where('name', '=', 'ee_junior_engineer')->first();

        // DyCE Head Role ID
        $dyce_head_id = Role::where('name', '=', 'dyce_engineer')->first();

        // DyCE Deputy ID
        $dyce_deputy_id = Role::where('name', '=', 'dyce_deputy_engineer')->first();

        // DyCE Junior ID
        $dyce_jr_id = Role::where('name', '=', 'dyce_junior_engineer')->first();

        // REE Head Role ID
        $ree_head_id = Role::where('name', '=', 'ree_engineer')->first();

        // REE Assistant Role ID
        $ree_ass_id = Role::where('name', '=', 'REE Assistant Engineer')->first();

        // REE Deputy Role ID
        $ree_deputy_id = Role::where('name', '=', 'REE deputy Engineer')->first();

        // REE Junior Role ID
        $ree_jr_id = Role::where('name', '=', 'REE Junior Engineer')->first();

        // CO Head Role ID
        $co_head_id = Role::where('name', '=', 'co_engineer')->first();

        // Cap Head Role ID
        $cap_head_id = Role::where('name', '=', 'cap_engineer')->first();

        // VP Head Role ID
        $vp_head_id = Role::where('name', '=', 'vp_engineer')->first();


        // Update Child ID

        $ee_head_child = json_encode([$society_role_id->id, $ee_deputy_id->id]);
        Role::where('id', $ee_head_id->id)->update(['child_id' => $ee_head_child]);

        $ee_deputy_child = json_encode(([$ee_jr_id->id]));
        Role::where('id', $ee_deputy_id->id)->update(['child_id' => $ee_deputy_child]);

        $dyce_head_child = json_encode([$ee_head_id->id, $dyce_deputy_id->id]);
        Role::where('id', $dyce_head_id->id)->update(['child_id' => $dyce_head_child]);

        $dyce_deputy_child = json_encode([$dyce_jr_id->id]);
        Role::where('id', $dyce_deputy_id->id)->update(['child_id' => $dyce_deputy_child]);

        $ree_head_child = json_encode([$ee_head_id->id, $dyce_head_id->id, $ree_ass_id->id]);
        Role::where('id', $ree_head_id->id)->update(['child_id' => $ree_head_child]);

        $ree_ass_child = json_encode([$ree_deputy_id->id]);
        Role::where('id', $ree_ass_id->id)->update(['child_id' => $ree_ass_child]);

        $ree_deputy_child = json_encode([$ree_jr_id->id]);
        Role::where('id', $ree_deputy_id->id)->update(['child_id' => $ree_deputy_child]);

        $co_head_child = json_encode([$ee_head_id->id, $dyce_head_id->id, $ree_head_id->id]);
        Role::where('id', $co_head_id->id)->update(['child_id' => $co_head_child]);

        $cap_head_child = json_encode([$co_head_id->id]);
        Role::where('id', $cap_head_id->id)->update(['child_id' => $cap_head_child]);

        $vp_head_child = json_encode([$cap_head_id->id]);
        Role::where('id', $vp_head_id->id)->update(['child_id' => $vp_head_child]);
    }
}
