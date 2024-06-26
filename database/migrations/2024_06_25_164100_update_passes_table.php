<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePassesTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::table('passes', function (Blueprint $table) {
// Ensure the correct columns exist
if (!Schema::hasColumn('passes', 'platform')) {
$table->string('platform')->after('user_id');
}

if (!Schema::hasColumn('passes', 'email_username')) {
$table->string('email_username')->after('platform');
}

// Remove any old columns that are no longer in use
if (Schema::hasColumn('passes', 'name')) {
$table->dropColumn('name');
}

if (Schema::hasColumn('passes', 'email')) {
$table->dropColumn('email');
}
});
}

/**
* Reverse the migrations.
*
* @return void
*/
public function down()
{
Schema::table('passes', function (Blueprint $table) {
// Optionally, reverse the changes (not strictly necessary)
$table->string('name')->nullable();
$table->string('email')->nullable();
$table->dropColumn('platform');
$table->dropColumn('email_username');
});
}
}
