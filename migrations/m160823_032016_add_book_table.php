<?php

use yii\db\Migration;

class m160823_032016_add_book_table extends Migration
{
    const DEFAULT_OPTIONS = 'ENGINE=InnoDB';

    public function up()
    {
        $this->createBookTable();
    }

    public function down()
    {
        $this->dropTable("{{%book}}");
    }

    protected function createBookTable()
    {
        $this->createTable("{{%book}}",[
            'id' => $this->primaryKey(),
            'code' => $this->string(30)->unique()->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'author' => $this->string(255),
            'category' => $this->string(255),
            'publishing_year' => $this->string(10),
            'publishing_company' => $this->string(255),
        ], self::DEFAULT_OPTIONS);
    }
}
