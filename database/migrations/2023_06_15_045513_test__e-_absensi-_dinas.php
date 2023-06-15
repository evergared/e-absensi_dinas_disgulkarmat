<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('pegawai', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nrk')->nullable();
            $table->string('nip')->nullable();
            $table->string('nama')->nullable();
            $table->boolean('aktif')->default(true);
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->foreignUlid('id_pegawai')->references('id')->on('pegawai');
            $table->string('password');
            $table->rememberToken();
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
        if(Schema::hasTable('users'))
        {
            Schema::table('users', function(Blueprint $t){
                $t->dropConstrainedForeignId('id_pegawai');
            });
        }
        Schema::dropIfExists('users');
        Schema::dropIfExists('pegawai');
    }
};
