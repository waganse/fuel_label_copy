<?php

namespace Fuel\Migrations;

class Create_labels
{
	public function up()
	{
		\DBUtil::create_table('labels', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 50, 'type' => 'varchar'),
			'group_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'remarks' => array('type' => 'text', 'null' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'),true,'InnoDB',null,
            array(
                array(
                    'key' => 'group_id',
                    'reference' => array(
                        'table' => 'labelgroups',
                        'column' => 'id'
                    )
                ),
            )
        );
	}

	public function down()
	{
		\DBUtil::drop_table('labels');
	}
}