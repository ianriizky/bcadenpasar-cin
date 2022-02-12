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

    /**
     * Generate list of branch data.
     *
     * @return \Illuminate\Database\Eloquent\Collection<string, \App\Models\Branch>
     */
    protected function generateBranch(): Collection
    {
        return (new Collection($this->data()))->mapWithKeys(fn (array $branch) => [
            $branch['name'] => new Branch(Arr::only($branch, ['name', 'address'])),
        ]);
    }

    /**
     * Generate list of role and branch with its user data.
     *
     * @return array<string, array<string, \App\Models\User>>
     */
    protected function generateUser(): array
    {
        return [
            'BCA KCU Denpasar' => [
                [
                    'username' => env('ADMIN_USERNAME', 'admin'),
                    'name' => env('ADMIN_FULLNAME', 'Administrator'),
                    'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
                    'password' => env('ADMIN_PASSWORD', 'admin12345'),
                    'is_verified' => true,
                    'role' => Role::ROLE_ADMIN,
                ],
                [
                    'username' => 'manager',
                    'name' => 'Manager',
                    'email' => 'manager@manager.com',
                    'password' => 'manager12345',
                    'is_verified' => true,
                    'role' => Role::ROLE_MANAGER,
                ],
                [
                    'username' => 'staff',
                    'name' => 'Staff',
                    'email' => 'staff@staff.com',
                    'password' => 'staff12345',
                    'is_verified' => true,
                    'role' => Role::ROLE_STAFF,
                ],
            ],
        ];
    }
}
