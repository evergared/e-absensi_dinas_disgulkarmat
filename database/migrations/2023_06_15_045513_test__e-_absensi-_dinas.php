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
            $table->string('grup',1);
            $table->foreignUlid('jabatan')->references('id_jabatan')->on('jabatan');
            $table->foreignUlid('penempatan')->references('id_penempatan')->on('penempatan');
            $table->boolean('aktif')->default(true);
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('user', function (Blueprint $table) {
            $table->foreignUlid('id_pegawai')->references('id')->on('pegawai');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('jadwal_piket_grup', function (Blueprint $table) {
            $table->string('tanggal');
            $table->string('tipe');
            $table->string('grup',1);
            $table->timestamps();
        });

        Schema::create('jabatan', function (Blueprint $table) {
            $table->ulid('id_jabatan',8)->primary();
            $table->string('nama_jabatan');
            $table->timestamps();
        });

        Schema::create('penempatan', function (Blueprint $table) {
            $table->ulid('id_penempatan',8)->primary();
            $table->string('nama_penempatan');
            $table->timestamps();
        });

        Schema::create('absensi', function (Blueprint $table) {
            $table->string('tanggal');
            $table->foreignUlid('id_pegawai')->references('id')->on('pegawai');
            $table->string('grup',1);
            $table->string('tipe_jadwal');
            $table->string('status');
            $table->text('keterangan')->nullable();
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
        if(Schema::hasTable('user'))
        {
            Schema::table('user', function(Blueprint $t){
                $t->dropConstrainedForeignId('id_pegawai');
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
                $t->dropConstrainedForeignId('id_pegawai');
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
