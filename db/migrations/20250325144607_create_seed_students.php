<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSeedStudents extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('student');
        
        $data = [
            [
                'studentid' => '20000001',
                'password' => password_hash('popcorn123', PASSWORD_BCRYPT),
                'dob' => '2000-05-14',
                'firstname' => 'Alice',
                'lastname' => 'Brown',
                'house' => '12 Oak Street',
                'town' => 'Oxford',
                'county' => 'Oxfordshire',
                'country' => 'UK',
                'postcode' => 'OX1 1AA'
            ],
            [
                'studentid' => '20000002',
                'password' => password_hash('jellyfish123', PASSWORD_BCRYPT),
                'dob' => '1999-08-21',
                'firstname' => 'Bob',
                'lastname' => 'White',
                'house' => '5 Maple Close',
                'town' => 'Reading',
                'county' => 'Berkshire',
                'country' => 'UK',
                'postcode' => 'RG1 2BB'
            ],
            [
                'studentid' => '20000003',
                'password' => password_hash('mypassword!?', PASSWORD_BCRYPT),
                'dob' => '2001-01-30',
                'firstname' => 'Charlie',
                'lastname' => 'Green',
                'house' => '88 Birch Lane',
                'town' => 'Manchester',
                'county' => 'Greater Manchester',
                'country' => 'UK',
                'postcode' => 'M1 3DD'
            ],
            [
                'studentid' => '20000004',
                'password' => password_hash('3rdDrk', PASSWORD_BCRYPT),
                'dob' => '2002-03-17',
                'firstname' => 'David',
                'lastname' => 'Black',
                'house' => '32 Pine Avenue',
                'town' => 'Liverpool',
                'county' => 'Merseyside',
                'country' => 'UK',
                'postcode' => 'L1 4EE'
            ],
            [
                'studentid' => '20000005',
                'password' => password_hash('newworld234', PASSWORD_BCRYPT),
                'dob' => '2000-12-05',
                'firstname' => 'Emma',
                'lastname' => 'Jones',
                'house' => '55 Elm Road',
                'town' => 'Bristol',
                'county' => 'Avon',
                'country' => 'UK',
                'postcode' => 'BS1 5ZZ'
            ]
        ];
        
        $table->insert($data)->save();
    }
}
