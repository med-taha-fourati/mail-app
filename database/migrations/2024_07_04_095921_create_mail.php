<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Mail;
use App\Models\Trash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*Schema::create('trashes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mail::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });*/

        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('from');
            $table->string('to');
            $table->string('subject', 200);
            $table->string('content', 1000);
            $table->foreignIdFor(Mail::class)->nullable()->constrained()->onDelete('cascade');
            $table->bigInteger('trash_id')->unsigned()->nullable();
            $table->foreign('trash_id')->references('id')->on('trashes')->constrained()->onDelete('set null');
            //$table->foreignIdFor(Trash::class)->nullable()->constrained()->onDelete('cascade');
            //$table->boolean('draft')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mails');
    }
};
