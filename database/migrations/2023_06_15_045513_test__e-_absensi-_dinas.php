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
        


        Schema::create('jadwal_piket_grup', function (Blueprint $table) {
            $table->string('tanggal');
            $table->string('jadwal');
            $table->string('grup',1);
            $table->timestamps();
        });

        Schema::create('jabatan', function (Blueprint $table) {
            $table->ulid('id_jabatan')->primary();
            $table->string('nama_jabatan');
            $table->tinyInteger('role_enum')->default(3);
            $table->timestamps();
        });

        Schema::create('penempatan', function (Blueprint $table) {
            $table->ulid('id_penempatan')->primary();
            $table->string('nama_penempatan');
            $table->timestamps();
        });

        
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('nip')->primary();
            $table->string('nrk')->nullable();
            $table->string('nama')->nullable();
            $table->string('grup',1);
            $table->foreignUlid('jabatan')->references('id_jabatan')->on('jabatan');
            $table->foreignUlid('penempatan')->references('id_penempatan')->on('penempatan');
            $table->boolean('aktif')->default(true);
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('user', function (Blueprint $table) {
            $table->string('nip');
            $table->string('password');
            $table->boolean('override_role')->default(false);
            $table->tinyInteger('role_enum_override')->default(3);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai');
        });

        Schema::create('absensi', function (Blueprint $table) {
            $table->string('tanggal');
            $table->string('nip');
            $table->string('grup',1)->nullable();
            $table->string('kehadiran');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('user'))
        {
            Schema::table('user', function(Blueprint $t){
                $t->dropConstrainedForeignId('nip');
            });
        }
        if(Schema::hasTable('pegawai'))
        {
            Schema::table('pegawai', function(Blueprint $t){
                $t->dropConstrainedForeignId('jabatan');
                $t->dropConstrainedForeignId('penempatan');
            });
        }
        if(Schema::hasTable('absensi'))
        {
            Schema::table('absensi', function(Blueprint $t){
                $t->dropConstrainedForeignId('nip');
            });
        }
        Schema::dropIfExists('user');
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('jadwal_piket_grup');
        Schema::dropIfExists('jabatan');
        Schema::dropIfExists('penempatan');
        Schema::dropIfExists('absensi');
    }
};
