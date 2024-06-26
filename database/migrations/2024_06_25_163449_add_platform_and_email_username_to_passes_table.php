<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlatformAndEmailUsernameToPassesTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::table('passes', function (Blueprint $table) {
$table->string('platform')->after('user_id');
$table->string('email_username')->after('platform');
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
$table->dropColumn('platform');
$table->dropColumn('email_username');
});
}
}
