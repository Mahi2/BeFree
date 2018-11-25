<?php


use Phinx\Migration\AbstractMigration;
use Befree\ConfigProvider;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateBansTable extends AbstractMigration
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
        $this->table("bans", [
            'COLLATE' => 'utf8_unicode_ci',
            'DEFAULT CHARSET' => 'utf8',
            'ENGINE' => 'InnoDB'
        ])
            ->addColumn('ip', 'string', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('date', 'string', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('time', 'string', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('reason', 'integer', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('redirect', 'integer', ['limit' => MysqlAdapter::BIT, 'default' => 0])
            ->addColumn('url', 'integer', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('autoban', 'integer', ['limit' => MysqlAdapter::BIT, 'default' => 0])
            ->create();
    }
}
