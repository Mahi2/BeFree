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
            ->insert([
                'id' => 1,
                'email' => 'admin@mail.com',
                'realtime_protection' => 1,
                'mail_notifications' => 1,
                'ip_detection' => 0,
                'countryban_blacklist' => 1,
                'live_traffic' => 0,
                'jquery_include' => 0,
                'error_reporting' => 5,
                'display_errors' => 0,
                'fixed_layout' => 0,
                'boxed_layout' => 0
            ])
            ->save();
    }
}
