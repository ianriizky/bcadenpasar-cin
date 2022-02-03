<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BranchUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \App\Models\Branch $branch_1 */
        $branch_1 = Branch::create([
            'name' => 'BCA KCU Denpasar',
            'address' => 'Jl. Hasanuddin No.58, Pemecutan, Kec. Denpasar Bar., Kota Denpasar, Bali 80232',
        ]);

        /** @var \App\Models\User $admin_1 */
        $admin_1 = User::make([
            'username' => env('ADMIN_USERNAME', 'admin'),
            'name' => env('ADMIN_FULLNAME', 'Administrator'),
            'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
            'email_verified_at' => Carbon::now(),
            'password' => env('ADMIN_PASSWORD', 'admin12345'),
        ])->setBranchRelationValue($branch_1);

        $admin_1->save();

        $admin_1->syncRoles(Role::ROLE_ADMIN);

        /** @var \App\Models\Branch $branch_2 */
        $branch_2 = Branch::create([
            'name' => 'BCA KCP Gianyar',
            'address' => 'Jl. By Pass Dharma Giri, Gianyar, Kec. Gianyar, Kabupaten Gianyar, Bali 80511',
        ]);
    }
}
