<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function Permission()
    {
        try {
            // $dev_permission = Permission::where('slug', 'create-tasks')->first();
            // $manager_permission = Permission::where('slug', 'edit-users')->first();

            //RoleTableSeeder.php
            $owner_role = new Role();
            $owner_role->slug = 'shop';
            $owner_role->name = 'owner';
            $owner_role->save();
            // $dev_role->permissions()->attach($dev_permission);

            $customer_role = new Role();
            $customer_role->slug = 'user';
            $customer_role->name = 'customer';
            $customer_role->save();
            // $manager_role->permissions()->attach($manager_permission);

            $delivery_role = new Role();
            $delivery_role->slug = 'rider';
            $delivery_role->name = 'delivery person';
            $delivery_role->save();
            // $manager_role->permissions()->attach($manager_permission);

            // $dev_role = Role::where('slug', 'developer')->first();
            // $manager_role = Role::where('slug', 'manager')->first();

            // $createTasks = new Permission();
            // $createTasks->slug = 'create-tasks';
            // $createTasks->name = 'Create Tasks';
            // $createTasks->save();
            // $createTasks->roles()->attach($dev_role);

            // $editUsers = new Permission();
            // $editUsers->slug = 'edit-users';
            // $editUsers->name = 'Edit Users';
            // $editUsers->save();
            // $editUsers->roles()->attach($manager_role);

            // $dev_role = Role::where('slug', 'developer')->first();
            // $manager_role = Role::where('slug', 'manager')->first();
            // $dev_perm = Permission::where('slug', 'create-tasks')->first();
            // $manager_perm = Permission::where('slug', 'edit-users')->first();

            // $developer = new User();
            // $developer->name = 'Mahedi Hasan';
            // $developer->email = 'mahedi@gmail.com';
            // $developer->password = bcrypt('secrettt');
            // $developer->save();
            // $developer->roles()->attach($dev_role);
            // $developer->permissions()->attach($dev_perm);

            // $manager = new User();
            // $manager->name = 'Pipat';
            // $manager->email = 'tao.pipat@gmail.com';
            // $manager->password = bcrypt('12341234');
            // $manager->save();
            // $manager->roles()->attach($manager_role);
            // $manager->permissions()->attach($manager_perm);

            // $user = $request->user();
        } catch (\Throwable $th) {
            throw $th;
        }
        return response()->json(['success' => true], 200);
    }
}
