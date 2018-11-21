<?php


use Phinx\Migration\AbstractMigration;
use Befree\ConfigProvider;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateBadbotSettingsTable extends AbstractMigration
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
        $prefix = (new ConfigProvider(ROOT."/config.php"))->get('database.prefix');

        $this->table($prefix . "badbot-settings", [
            'COLLATE' => 'utf8_unicode_ci',
            'DEFAULT CHARSET' => 'utf8',
            'ENGINE' => 'InnoDB'
        ])
        ->addColumn('protection', 'integer', [
            'limit' => MysqlAdapter::BIT,
            'null' => false,
            'default' => 1
        ])
        ->addColumn('protection2', 'integer', [
            'limit' => MysqlAdapter::BIT,
            'null' => false,
            'default' => 1
        ])
        ->addColumn('protection3', 'integer', [
            'limit' => MysqlAdapter::BIT,
            'null' => false,
            'default' => 1
        ])
        ->addColumn('logging', 'integer', [
            'limit' => MysqlAdapter::BIT,
            'null' => false,
            'default' => 1
        ])
        ->addColumn('autoban', 'integer', [
            'limit' => MysqlAdapter::BIT,
            'null' => false,
            'default' => 0
        ])
        ->addColumn('mail', 'integer', [
            'limit' => MysqlAdapter::BIT,
            'null' => false,
            'default' => 0
        ])
        ->create();
    }
}
