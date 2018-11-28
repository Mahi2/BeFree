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
            ->insert([1, 0, 1, 0, 'pages/mass-requests.php', 0])
            ->save();
    }
}
