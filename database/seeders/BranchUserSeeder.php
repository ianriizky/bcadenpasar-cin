<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BranchUserSeeder extends Seeder
{
    /**
     * Return list of branch and user data.
     *
     * @return array[]
     */
    protected function data(): array
    {
        return require database_path('seeders/users.php');
    }

    /**
     * Store user data with role "admin" into storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return void
     */
    protected function generateAdmin(Branch $branch)
    {
        if ($branch->name === 'BCA KCU Denpasar') {
            $user = new User([
                'username' => env('ADMIN_USERNAME', 'admin'),
                'name' => env('ADMIN_FULLNAME', 'Administrator'),
                'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
                'password' => env('ADMIN_PASSWORD', 'admin12345'),
                'is_verified' => true,
            ]);

            $user->setBranchRelationValue($branch);
            $user->save();

            $user->syncRoles(Role::ROLE_ADMIN);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            foreach ($this->data() as $branch) {
                $users = $branch['users'] ?? [];

                $branch = new Branch(Arr::except($branch, 'users'));

                $branch->save();

                $this->generateAdmin($branch);

                foreach ($users as $user) {
                    $role = $user['role'];

                    $user = new User(Arr::except($user, 'role'));

                    $user->setBranchRelationValue($branch);
                    $user->save();

                    $user->syncRoles($role);
                }
            }
        });
    }
}
