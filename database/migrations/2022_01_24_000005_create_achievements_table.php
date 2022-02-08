<?php

use App\Models\Event;
use App\Models\Target;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @see \App\Models\Achievement
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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Target::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Event::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->dateTime('achieved_date');
            $table->foreignId('achieved_by')->nullable()->constrained((new User)->getTable())->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('achievements');
    }
};
