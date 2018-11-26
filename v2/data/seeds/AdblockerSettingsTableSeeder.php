<?php


use Phinx\Seed\AbstractSeed;

class AdblockerSettingsTableSeeder extends AbstractSeed
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
        $this->table('adblocker-settings')
            ->insert([
                'id' => 1,
                'detection' => 0,
                'redirect' => 'pages/adblocker-detected.php'
            ])
            ->save();
    }
}
