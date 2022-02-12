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
        return [
            [
                'name' => 'BCA KCU Denpasar',
                'address' => 'Jl. Hasanuddin No.58, Pemecutan, Kec. Denpasar Bar., Kota Denpasar, Bali 80232',
                'users' => [
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
        ];
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
