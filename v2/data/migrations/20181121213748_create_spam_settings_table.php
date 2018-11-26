<?php


use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateSpamSettingsTable extends AbstractMigration
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
        $this->table('spam-settigns')
            ->addColumn('protection', 'integer', ['limit' => 1, 'default' => 0])
            ->addColumn('logging', 'integer', ['limit' => 1, 'default' => 1])
            ->addColumn('redirect', 'string', ['limit' => MysqlAdapter::TEXT_SMALL, 'default' => 'pages/spammer.php'])
            ->addColumn('autoban', 'integer', ['limit' => 1, 'default' => 0])
            ->addColumn('mail', 'integer', ['limit' => 1, 'default' => 0])
            ->create();

    }
}
