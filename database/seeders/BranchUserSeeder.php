<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Branch>
     */
    protected function generateBranch(): Collection
    {
        $branches = new Collection([
            [
                'name' => 'BCA KCU Denpasar',
                'address' => 'Jl. Hasanuddin No.58, Pemecutan, Kec. Denpasar Bar., Kota Denpasar, Bali 80232',
            ],
            [
                'name' => 'BCA KCP Gianyar',
                'address' => 'Jl. By Pass Dharma Giri, Gianyar, Kec. Gianyar, Kabupaten Gianyar, Bali 80511',
            ],
            [
                'name' => 'BCA KCP Cokroaminoto',
                'address' => 'Pemecutan Kaja, North Denpasar, Denpasar City, Bali',
            ],
            [
                'name' => 'BCA KCP Gatot Subroto Barat',
                'address' => 'Jl. Gatot Subroto Barat No.508-509, Padangsambian Kaja, Kec. Denpasar Bar., Kota Denpasar, Bali 80117',
            ],
            [
                'name' => 'BCA KCP Gatot Subroto',
                'address' => 'Jl. Gatot Subroto Barat No.80, Dangin Puri Kaja, Kec. Denpasar Utara, Kota Denpasar, Bali 80234',
            ],
            [
                'name' => 'BCA KCP Gatot Subroto Timur',
                'address' => 'Jl. Gatot Subroto Tim. No.42- 43, Kesiman Kertalangu, Kec. Denpasar Tim., Kota Denpasar, Bali 80237',
            ],
            [
                'name' => 'BCA KCP Gianyar',
                'address' => 'Jl. By Pass Dharma Giri, Gianyar, Kec. Gianyar, Kabupaten Gianyar, Bali 80511',
            ],
            [
                'name' => 'BCA KCP Klungkung',
                'address' => 'Jl. Puputan Galiran No.88C, Semarapura Kelod, Kec. Klungkung, Kabupaten Klungkung, Bali 80715',
            ],
            [
                'name' => 'BCA KCP Mahendradata',
                'address' => 'Jl. Mahendradatta No.99, Pemecutan Kaja, Kec. Denpasar Utara, Kota Denpasar, Bali 80111',
            ],
            [
                'name' => 'BCA KCP Renon',
                'address' => 'Jl. Raya Puputan No.10, Sumerta Kelod, Kec. Denpasar Tim., Kota Denpasar, Bali 80239',
            ],
            [
                'name' => 'BCA KCP Sesetan',
                'address' => 'Jl. Raya Sesetan, Sesetan, Denpasar Selatan, Kota Denpasar, Bali 80223',
            ],
            [
                'name' => 'BCA KCP Ubud',
                'address' => 'Jl. Raya Ubud No.10X, Petulu, Kecamatan Ubud, Kabupaten Gianyar, Bali 80571',
            ],
            [
                'name' => 'BCA KCP Grand Sudirman',
                'address' => 'Jl. PB Sudirman Blok C5-C6 Ruko Grand Sudirman, Dauh Puri Klod, Kec. Denpasar Bar., Kota Denpasar, Bali 80232',
            ],
            [
                'name' => 'BCA KCP Maluku',
                'address' => 'Jl. Pulau Maluku III No.10, Dauh Puri, Kec. Denpasar Bar., Kota Denpasar, Bali 80232',
            ],
            [
                'name' => 'BCA KCP Teuku Umar',
                'address' => 'Jl. Teuku Umar No.99 D, Dauh Puri Klod, Kec. Denpasar Bar., Kota Denpasar, Bali 80114',
            ],
            [
                'name' => 'BCA KCP Benoa',
                'address' => 'Jl. Suwung Batan Kendal No.2, Sesetan, Denpasar Selatan, Kota Denpasar, Bali 80222',
            ],
        ]);

        return $branches->mapWithKeys(fn (array $branch) => [
            $branch['name'] => new Branch($branch),
        ]);
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
