<?php


use Phinx\Seed\AbstractSeed;

class PagesLayoltTableSeeder extends AbstractSeed
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
        $data = [
            [1, 'Banned', 'You are banned and you cannot continue to the website'],
            [2, 'Blocked', 'Malicious request was detected'],
            [3, 'Mass_Requests', 'Attention, you performed too many connections'],
            [4, 'Proxy', 'Access to the website via Proxy is not allowed (Disable Browser Data Compression if you have it enabled)'],
            [5, 'Spam', 'You are in the Blacklist of Spammers and you cannot continue to the website'],
            [6, 'Tor', 'We detected that you are using Tor'],
            [7, 'Banned_Country', 'Sorry, but your country is banned and you cannot continue to the website'],
            [8, 'Blocked_Browser', 'Access to the website through your Browser is not allowed, please use another Internet Browser'],
            [9, 'Blocked_OS', 'Access to the website through your Operating System is not allowed'],
            [10, 'Blocked_ISP', 'Your Internet Service Provider is blacklisted and you cannot continue to the website'],
            [11, 'Blocked_RFR', 'Your referrer url is blocked and you cannot continue to the website'],
            [12, 'Bad_Bot', 'You were identified as a Bad Bot and you cannot continue to the website'],
            [13, 'Fake_Bot', 'You were identified as a Fake Bot and you cannot continue to the website'],
            [14, 'Tor', 'We detected that you are using Tor'],
            [15, 'AdBlocker', 'AdBlocker detected. Please support this website by disabling your AdBlocker']
        ];

        $table = $this->table('pages-layolt');
        foreach ($data as $k => $v) {
            $table->insert($data[$k]);
        }

    }
}
