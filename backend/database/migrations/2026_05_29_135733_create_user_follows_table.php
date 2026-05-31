<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_follows', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'follower_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'followed_user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['follower_user_id', 'followed_user_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_follows');
    }
};