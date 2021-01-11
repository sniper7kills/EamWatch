<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create Roles.
         */
        $adminRole = Role::create(['name' => 'admin']);
        $moderatorRole = Role::create(['name' => 'moderator']);

        /**
         * Telescope Permissions.
         */
        $telescopePermissions = [
            'view' => Permission::create(['name' => 'view telescope']),
        ];

        $adminRole->givePermissionTo($telescopePermissions['view']);

        /**
         * Message Permissions.
         */
        $messagePermissions = [
            'backend' => Permission::create(['name' => 'create backend message']),
            'update' => Permission::create(['name' => 'update messages']),
            'delete' => Permission::create(['name' => 'delete messages']),
        ];

        $adminRole->givePermissionTo($messagePermissions['backend']);

        $adminRole->givePermissionTo($messagePermissions['update']);
        $moderatorRole->givePermissionTo($messagePermissions['update']);

        $adminRole->givePermissionTo($messagePermissions['delete']);
        $moderatorRole->givePermissionTo($messagePermissions['delete']);

        /**
         * Recording Permissions.
         */
        $recordingPermissions = [
            'update' => Permission::create(['name' => 'update recordings']),
            'delete' => Permission::create(['name' => 'delete recordings']),
        ];

        $adminRole->givePermissionTo($recordingPermissions['update']);

        $adminRole->givePermissionTo($recordingPermissions['delete']);
        $moderatorRole->givePermissionTo($recordingPermissions['delete']);

        /**
         * Comment Permissions.
         */
        $commentPermissions = [
            'update' => Permission::create(['name' => 'update comments']),
            'delete' => Permission::create(['name' => 'delete comments']),
        ];

        $adminRole->givePermissionTo($commentPermissions['update']);
        $moderatorRole->givePermissionTo($commentPermissions['delete']);

        $adminRole->givePermissionTo($commentPermissions['delete']);
        $moderatorRole->givePermissionTo($commentPermissions['delete']);
    }
}
