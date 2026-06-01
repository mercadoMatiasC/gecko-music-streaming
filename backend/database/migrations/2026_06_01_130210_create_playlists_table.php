<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'owner_id')->constrained();
            $table->string('title');
            $table->string('playlist_image_route')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('playlists');
    }
};