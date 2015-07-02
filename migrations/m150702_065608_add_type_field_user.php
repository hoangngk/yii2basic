<?php

use yii\db\Schema;
use yii\db\Migration;

class m150702_065608_add_type_field_user extends Migration
{
    public function up()
    {
    	$this->addColumn( 'users', 'type', Schema::TYPE_SMALLINT . ' DEFAULT NULL AFTER `parent`');
    }

    public function down()
    {
        $this->dropColumn('users', 'type' );
    }
}
