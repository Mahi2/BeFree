<?php


use Phinx\Seed\AbstractSeed;

class MassrequestsSettingsTableSeeder extends AbstractSeed
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
        $this->table('massrequests-settings')
            ->insert([
                'id' => 1,
                'protection' => 0,
                'logging' => 1,
                'autoban' => 0,
                'redirect' => 'pages/mass-requests.php',
                'mail' => 0
            ])
            ->save();
    }
}
