<?php

use yii\db\Migration;

/**
 * Class m190731_212006_create_idx_currency_name_index
 */
class m190731_212006_create_idx_currency_name_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx_currency_name',
            'currency',
            'name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx_currency_name',
            'currency'
        );
    }
}
