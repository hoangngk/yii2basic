<?php

use yii\db\Schema;
use yii\db\Migration;

class m150625_070453_users extends Migration
{
    public function up()
    {
    	$this->createTable('users', [
			'id'         => 'pk',
			'username'   => Schema::TYPE_STRING . ' NOT NULL',
			'firstname'  => Schema::TYPE_STRING,
			'lastname'   => Schema::TYPE_STRING,
			'email'      => Schema::TYPE_STRING . ' NOT NULL',
			'password'   => Schema::TYPE_STRING . ' NOT NULL',
			'token'      => Schema::TYPE_STRING,
			'avatar'     => Schema::TYPE_STRING,
			'auth_key'   => Schema::TYPE_STRING,
			'active'     => Schema::TYPE_SMALLINT,
			'parent'     => Schema::TYPE_INTEGER . ' DEFAULT 0',
			'created_at' => Schema::TYPE_DATETIME,
			'updated_at' => Schema::TYPE_DATETIME,

        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
