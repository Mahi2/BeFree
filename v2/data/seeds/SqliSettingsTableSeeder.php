<?php


use Phinx\Seed\AbstractSeed;

class SqliSettingsTableSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $this->table('sqli-settings')
            ->insert([1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 'pages/blocked.php', 0, 0])
            ->save();
    }
}
