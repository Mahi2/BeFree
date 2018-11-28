<?php


use Phinx\Seed\AbstractSeed;

class SpamSettingsTableSeeder extends AbstractSeed
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
        $this->table('spam-settings')
            ->insert([
                'id' => 1,
                'protection' => 0,
                'logging' => 1,
                'redirect' => 'pages/spammer.php',
                'autoban' => 0,
                'mail' => 0
            ])
            ->save();
    }
}
