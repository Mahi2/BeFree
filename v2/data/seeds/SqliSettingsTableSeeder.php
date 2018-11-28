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
            ->insert([
                'id' => 1,
                'protection' => 1,
                'protection2' => 1,
                'protection3' => 1,
                'protection4' => 1,
                'protection5' => 0,
                'protection6' => 1,
                'protection7' => 0,
                'protection8' => 0,
                'logging' => 1,
                'redirect' => 'pages/blocked.php',
                'autoban' => 0,
                'mail' => 0
            ])
            ->save();
    }
}
