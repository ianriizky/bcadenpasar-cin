<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TargetSeeder extends Seeder
{
    /**
     * Return list of branch and user data.
     *
     * @return array[]
     */
    protected function data(): array
    {
        return require database_path('seeders/targets.php');
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
                $target = $branch['target'];
                $branch = Branch::firstWhere('name', $branch['name']);

                $branch->targets()->create($target);
            }
        });
    }
}
