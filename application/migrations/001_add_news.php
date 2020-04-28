<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_news extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field([
                        'id' => [
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => true,
                                'auto_increment' => true
                        ],
                        'title' => [
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ],
                        'slug' => [
                                'type' => 'TEXT',
                                'null' => false,
                        ],
                        'text' => [

                        ]
                ]);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('news');
        }

        public function down()
        {
                $this->dbforge->drop_table('blog');
        }
}