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
            $table->string('first_name')->nullable()->after('id');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('company_name')->nullable()->after('last_name');
            $table->string('contact_number')->nullable()->after('company_name');
            $table->date('dob')->nullable()->after('contact_number');
            $table->boolean('confirmation_flag')->default(false)->after('dob');
            $table->boolean('registration_complete')->default(false)->after('confirmation_flag');
            $table->string('magic_token')->nullable()->unique()->after('remember_token');
            $table->timestamp('token_expires_at')->nullable()->after('magic_token');
            $table->timestamp('magic_token_used_at')->nullable()->after('token_expires_at');
            $table->boolean('email_verified')->default(false)->after('email');
            $table->string('email_verification_otp')->nullable()->after('email_verified');
            $table->timestamp('otp_expires_at')->nullable()->after('email_verification_otp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'company_name',
                'contact_number',
                'dob',
                'confirmation_flag',
                'registration_complete',
                'magic_token',
                'token_expires_at',
                'magic_token_used_at',
            ]);
        });
    }
};
