<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('slug', 120)->unique();
            $table->string('icon', 50)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('judul', 200);
            $table->string('slug', 220)->unique();
            $table->text('deskripsi')->nullable();
            $table->json('bahan')->nullable(); // array of bahan
            $table->json('langkah')->nullable(); // array of steps
            $table->string('gambar', 255)->nullable();
            $table->string('asal_daerah', 100)->nullable();
            $table->integer('waktu_memasak')->nullable(); // minutes
            $table->integer('porsi')->nullable();
            $table->enum('tingkat_kesulitan', ['mudah','sedang','sulit'])->default('sedang');
            $table->integer('views')->default(0);
            $table->boolean('published')->default(true);
            $table->timestamps();
        });

        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('resep_id')->constrained('reseps')->onDelete('cascade');
            $table->tinyInteger('nilai')->unsigned(); // 1-5
            $table->text('komentar')->nullable();
            $table->boolean('approved')->default(true);
            $table->timestamps();
            $table->unique(['user_id','resep_id']);
        });

        Schema::create('favorit_reseps_new', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('resep_id')->constrained('reseps')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['user_id','resep_id']);
        });

        // Add role to users
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['user','admin'])->default('user')->after('email');
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar', 255)->nullable()->after('role');
            }
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable()->after('avatar');
            }
        });
    }

    public function down(): void {
        Schema::dropIfExists('favorit_reseps_new');
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('reseps');
        Schema::dropIfExists('kategoris');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role','avatar','bio']);
        });
    }
};
