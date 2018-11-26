<?php


use Phinx\Seed\AbstractSeed;

class BadbotSettingsTableSeeder extends AbstractSeed
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
        $this->table('badbot-settings')
            ->insert([
                'id' => 1,
                'protection' => 1,
                'protection2' => 1,
                'protection3' => 1,
                'logging' => 1,
                'autoban' => 0,
                'mail' => 0
            ])
            ->save();
    }
}
