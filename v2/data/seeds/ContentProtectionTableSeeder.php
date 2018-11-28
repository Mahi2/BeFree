<?php


use Phinx\Seed\AbstractSeed;

class ContentProtectionTableSeeder extends AbstractSeed
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
            [1, 'rightclick', 0, 1, 'Context Menu not allowed'],
            [2, 'rightclick_images', 0, 1, 'Context Menu on Images not allowed'],
            [3, 'cut', 0, 1, 'Cut not allowed'],
            [4, 'copy', 0, 1, 'Copy not allowed'],
            [5, 'paste', 0, 1, 'Paste not allowed'],
            [6, 'drag', 0, 0, ''],
            [7, 'drop', 0, 0, ''],
            [8, 'printscreen', 0, 1, 'It is not allowed to use the Print Screen button'],
            [9, 'print', 0, 1, 'It is not allowed to Print'],
            [10, 'view_source', 0, 1, 'It is not allowed to view the source code of the site'],
            [11, 'iframe_out', 0, 0, ''],
            [12, 'selecting', 0, 0, '']
        ];

        $table = $this->table('content-protection');
        for ($i = 0; $i < count($data); $i++) {
            $table->insert($data[$i]);
        }
        $table->save();
    }
}
