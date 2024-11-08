<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesAndUserRoleTables extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // 'Admin', 'Editor'
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}

