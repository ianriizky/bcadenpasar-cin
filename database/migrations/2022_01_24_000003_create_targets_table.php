<?php

use App\Enum\Periodicity;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @see \App\Models\Target
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('periodicity')->comment('Enum of ' . Periodicity::class);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedInteger('amount');
            $table->text('note')->nullable();

            $table->foreignId('created_by')->nullable()->constrained((new User)->getTable())->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('targets');
    }
};
