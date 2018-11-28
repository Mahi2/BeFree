<?php


use Phinx\Seed\AbstractSeed;

class ProxySettingsTableSeeder extends AbstractSeed
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
        $this->table('proxy-settings')
            ->insert([1, 0, 0, 0, 1, 0, 'pages/proxy.php', 0])
            ->save();
    }
}
