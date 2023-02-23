<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        $addUser = 'add user';
        $editUser = 'edit user';
        $deleteUser = 'delete user';
        $viewUser = 'view user';

        $addActicle = 'add article';
        $editAllActicle = 'edit All article';
        $editMyActicle = 'edit My article';
        $deleteAllActicle = 'delete All article';
        $deleteMyActicle = 'delete My article';

        $addCategory = 'add category';
        $editCategory = 'edit category';
        $deleteCategory = 'delete category';
        $viewCategory = 'view category';

        $addComment = 'add comment';
        $editAllComment = 'edit All comment';
        $editMyComment = 'edit My comment';
        $deleteAllComment = 'delete All comment';
        $deleteMyComment = 'delete My comment';

        $addTag = 'add tag';
        $editTag = 'edit tag';
        $deleteTag = 'delete tag';
        $viewTag = 'view tag';

        Permission::create(['name' => $addUser]);
        Permission::create(['name' => $editUser]);
        Permission::create(['name' => $deleteUser]);
        Permission::create(['name' => $viewUser]);

        Permission::create(['name' => $addActicle]);
        Permission::create(['name' => $editAllActicle]);
        Permission::create(['name' => $editMyActicle]);
        Permission::create(['name' => $deleteAllActicle]);
        Permission::create(['name' => $deleteMyActicle]);

        Permission::create(['name' => $addCategory]);
        Permission::create(['name' => $editCategory]);
        Permission::create(['name' => $deleteCategory]);
        Permission::create(['name' => $viewCategory]);

        Permission::create(['name' => $addComment]);
        Permission::create(['name' => $editAllComment]);
        Permission::create(['name' => $editMyComment]);
        Permission::create(['name' => $deleteAllComment]);
        Permission::create(['name' => $deleteMyComment]);

        Permission::create(['name' => $addTag]);
        Permission::create(['name' => $editTag]);
        Permission::create(['name' => $deleteTag]);
        Permission::create(['name' => $viewTag]);

        // Define roles available
        $admin = 'admin';
        $author = 'author';
        $user = 'user';

        Role::create(['name' => $admin])->givePermissionTo(Permission::all());

        Role::create(['name' => $author])->givePermissionTo([
            $addActicle,
            $editMyActicle,
            $deleteMyActicle,
            $addComment,
            $editMyComment,
            $deleteMyComment
        ]);

        Role::create(['name' => $user])->givePermissionTo([
            $addComment,
            $editMyComment,
            $deleteMyComment
        ]);
    }
}
