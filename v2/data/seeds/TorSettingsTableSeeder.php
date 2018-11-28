<?php


use Phinx\Seed\AbstractSeed;

class TorSettingsTableSeeder extends AbstractSeed
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
        $this->table('tor-settings')
            ->insert([
                'id' => 1,
               'protection' => 1,
                'logging' => 1,
                'redirect' => 'pages/tor-detected.php',
                'autoban' => 0,
                'mail' => 1
            ])
            ->save();
    }
}
