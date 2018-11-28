<?php


use Phinx\Seed\AbstractSeed;

class DnsblDatabaseTableSeeder extends AbstractSeed
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
            [1, 'sbl.spamhaus.org'],
            [2, 'xbl.spamhaus.org']
        ];

        $table = $this->table('dnsbl-database');
        foreach($data as $k => $v) {
            $table->insert($data[$k]);
        }
        $table->save();
    }
}
