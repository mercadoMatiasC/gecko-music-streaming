<?php

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('playlist_songs', function (Blueprint $table) {
            $table->foreignIdFor(Playlist::class, 'playlist_id')->constrained('playlists')->cascadeOnDelete();
            $table->foreignIdFor(Song::class, 'song_id')->constrained('songs')->cascadeOnDelete();
            $table->primary(['playlist_id', 'song_id']);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('playlist_songs');
    }
};