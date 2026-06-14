<?php

use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'host_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(Playlist::class, 'playlist_id')->constrained('playlists')->cascadeOnDelete();
            $table->foreignIdFor(Song::class, 'current_song_id')->nullable()->constrained('songs')->nullOnDelete();;
            $table->boolean('is_paused')->default(true);
            $table->float('sync_timestamp', 8, 3)->default(0.000); //IN SECONDS
            $table->timestamp('sync_assigned_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('channels');
    }
};