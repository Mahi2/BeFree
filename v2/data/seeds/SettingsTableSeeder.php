<?php


use Phinx\Seed\AbstractSeed;

class SettingsTableSeeder extends AbstractSeed
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
        $this->table('settings')
            ->insert([1, 'admin@mail.com', 1, 1, 0, 1, 0, 0, 5, 0, 0, 0])
            ->save();
    }
}
