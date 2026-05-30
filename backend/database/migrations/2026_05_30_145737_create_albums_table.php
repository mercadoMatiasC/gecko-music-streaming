<?php

use App\Models\Artist;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'uploader_id')->constrained();
            $table->foreignIdFor(Artist::class, 'artist_id')->constrained();
            $table->string('title');
            $table->string('album_image_route')->nullable();
            $table->date('date_released');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('albums');
    }
};
