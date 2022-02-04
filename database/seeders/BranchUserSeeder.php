<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BranchUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            foreach ($this->generateBranch() as $branchName => $branch) {
                $branch->save();

                foreach ($this->generateAdmin($branchName) as $user) {
                    $user->setBranchRelationValue($branch);
                    $user->save();

                    $user->syncRoles(Role::ROLE_ADMIN);
                }

                foreach ($this->generateStaff($branchName) as $user) {
                    $user->setBranchRelationValue($branch);
                    $user->save();

                    $user->syncRoles(Role::ROLE_STAFF);
                }
            }
        });
    }

    /**
     * Generate the specified branch data into storage.
     *
     * @return \App\Models\Branch[]
     */
    protected function generateBranch(): array
    {
        /** @var \App\Models\Branch $branch_1 */
        $branch_1 = Branch::make([
            'name' => 'BCA KCU Denpasar',
            'address' => 'Jl. Hasanuddin No.58, Pemecutan, Kec. Denpasar Bar., Kota Denpasar, Bali 80232',
        ]);

        /** @var \App\Models\Branch $branch_2 */
        $branch_2 = Branch::make([
            'name' => 'BCA KCP Gianyar',
            'address' => 'Jl. By Pass Dharma Giri, Gianyar, Kec. Gianyar, Kabupaten Gianyar, Bali 80511',
        ]);

        return [
            $branch_1->name => $branch_1,
            $branch_2->name => $branch_2,
        ];
    }

    /**
     * Generate the specified user model class with admin role.
     *
     * @param  string  $branchName
     * @return \App\Models\User[]
     */
    protected function generateAdmin(string $branchName): array
    {
        $users = [
            'BCA KCU Denpasar' => [
                User::make([
                    'username' => env('ADMIN_USERNAME', 'admin'),
                    'name' => env('ADMIN_FULLNAME', 'Administrator'),
                    'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
                    'email_verified_at' => Carbon::now(),
                    'password' => env('ADMIN_PASSWORD', 'admin12345'),
                ]),
            ],
        ];

        return $users[$branchName] ?? [];
    }

    /**
     * Generate the specified user model class with staff role.
     *
     * @param  string  $branchName
     * @return \App\Models\User[]
     */
    protected function generateStaff(string $branchName): array
    {
        $users = [
            'BCA KCU Denpasar' => [
                User::make([
                    'username' => 'staff',
                    'name' => 'Staff',
                    'email' => 'staff@staff.com',
                    'email_verified_at' => Carbon::now(),
                    'password' => 'staff12345',
                ]),
            ],
        ];

        return $users[$branchName] ?? [];
    }
}
