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
            ->insert([
                'id' => 1,
                'protection' => 0,
                'protection2' => 0,
                'protection3' => 0,
                'logging' => 1,
                'autoban' => 0,
                'redirect' => 'pages/proxy.php',
                'mail' => 0
            ])
            ->save();
    }
}
