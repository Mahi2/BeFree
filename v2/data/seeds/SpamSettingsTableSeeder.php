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
            ->insert([1, 0, 1, 'pages/spammer.php', 0, 0])
            ->save();
    }
}
