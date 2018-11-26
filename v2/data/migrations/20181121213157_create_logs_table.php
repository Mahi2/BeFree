<?php


use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateLogsTable extends AbstractMigration
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
        $this->table('logs')
            ->addColumn('ip', 'string', ['limit' => 15])
            ->addColumn('date', 'string', ['limit' => 30])
            ->addColumn('time', 'string', ['limit' => 5])
            ->addColumn('page', 'string', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->addColumn('query', 'string', ['limit' => MysqlAdapter::TEXT_LONG])
            ->addColumn('type', 'string', ['limit' => 50])
            ->addColumn('browser', 'string', ['limit' => MysqlAdapter::TEXT_SMALL, 'default' => 'Unknown'])
            ->addColumn('browser_code', 'string', ['limit' => 50])
            ->addColumn('os', 'string', ['limit' => MysqlAdapter::TEXT_SMALL, 'default' => 'Unknown'])
            ->addColumn('os_code', 'string', ['limit' => 40])
            ->addColumn('country', 'string', ['limit' => 120, 'default' => 'Unknown'])
            ->addColumn('contry_code', 'string', ['limit' => 2, 'default' => 'XX'])
            ->addColumn('region', 'string', ['limit' => 120, 'default' => 'Unknown'])
            ->addColumn('city', 'string', ['limit' => 120, 'default' => 'Unknown'])
            ->addColumn('latitude', 'string', ['limit' => 30, 'default' => 0])
            ->addColumn('longitude', 'string', ['limit' => 30, 'default' => 0])
            ->addColumn('isp', 'string', ['limit' => MysqlAdapter::TEXT_SMALL, 'default' => 'Unknown'])
            ->addColumn('useragent', 'string', ['limit' => MysqlAdapter::TEXT_LONG])
            ->addColumn('referer_url', 'string', ['limit' => MysqlAdapter::TEXT_SMALL])
            ->create();

    }
}
