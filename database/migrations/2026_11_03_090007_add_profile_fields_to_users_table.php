<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 15)->after('email');
            $table->string('pan', 10)->nullable()->after('phone');
            $table->string('aadhar', 12)->nullable()->after('pan');
            $table->text('address')->nullable()->after('aadhar');
            $table->string('pincode', 10)->nullable()->after('address');
            $table->unsignedSmallInteger('cibil')->nullable()->after('pincode');
            $table->date('dob')->nullable()->after('cibil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'pan',
                'aadhar',
                'address',
                'pincode',
                'cibil',
                'dob',
            ]);
        });
    }
};
