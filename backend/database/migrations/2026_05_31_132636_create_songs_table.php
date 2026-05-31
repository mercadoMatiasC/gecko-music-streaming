<?php

use App\Models\Album;
use App\Models\Artist;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'uploader_id')->constrained();
            $table->foreignIdFor(Album::class, 'album_id')->nullable()->constrained();
            $table->foreignIdFor(Artist::class, 'artist_id')->constrained();
            $table->string('title');
            $table->integer('play_count')->default(0);
            $table->string('file_route')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('songs');
    }
};