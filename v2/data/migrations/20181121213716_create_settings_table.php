<?php


use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateSettingsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('settings')
            ->addColumn('email', 'string', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('realtime_protection', 'integer', ['limit' => 1, 'default' => 1])
            ->addColumn('mail_notifications', 'integer', ['limit' => 1, 'default' => 1])
            ->addColumn('ip_detection', 'integer', ['limit' => 1, 'default' => 0])
            ->addColumn('countryban_blacklist', 'integer', ['limit' => 1, 'default' => 1])
            ->addColumn('live_traffic', 'integer', ['limit' => 1, 'default' => 0])
            ->addColumn('jquery_include', 'integer', ['limit' => 1, 'default' => 0])
            ->addColumn('error_reporting', 'integer', ['limit' => MysqlAdapter::INT_MEDIUM, 'default' => 5])
            ->addColumn('display_errors', 'integer', ['limit' => 1, 'default' => 0])
            ->addColumn('fixed_layout', 'integer', ['limit' => 1, 'default' => 0])
            ->addColumn('boxed_layout', 'integer', ['limit' => 1, 'default' => 0])
            ->create();

    }
}
