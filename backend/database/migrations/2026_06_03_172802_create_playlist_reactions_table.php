<?php

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('playlist_reactions', function (Blueprint $table) {
            $table->foreignIdFor(Playlist::class, 'playlist_id')->constrained('playlists')->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'user_id')->constrained();
            $table->integer('like_status')->default(Playlist::REACTION_NONE);
            $table->boolean('saved_by_user')->default(false);
            $table->primary(['playlist_id', 'user_id']);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('playlist_reactions');
    }
};
