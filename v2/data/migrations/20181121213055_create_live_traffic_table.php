<?php


use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateLiveTrafficTable extends AbstractMigration
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
        $this->table('live-traffic')
            ->addColumn('ip', 'string', ['limit' => 15])
            ->addColumn('useragent', 'string', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('browser', 'string', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('browser_code', 'string', ['limit' => 50])
            ->addColumn('os', 'string', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('os_code','string', ['limit' => 40])
            ->addColumn('device_type', 'string', ['limit' => 12])
            ->addColumn('country', 'string', ['limit' => 120])
            ->addColumn('country_code', 'string', ['limit' => 2, 'default' => 'XX'])
            ->addColumn('request_uri', 'string', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('referer', 'string', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('bot', 'integer', ['limit' => 1, 'default' => 0])
            ->addColumn('date', 'string', ['limit' => 30])
            ->addColumn('time', 'string', ['limit' => 5])
            ->addColumn('uniquev', 'integer', ['limit' => 1, 'default' => 0])
            ->create();
    }
}
