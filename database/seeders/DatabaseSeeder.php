<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::transaction(function () {
            \DB::table('employees')->insert($this->parseEmployees([
                [
                    'code' => 'IP06001',
                    'name' => 'Agus',
                    'address' => 'Jln Gajah Mada no 12, Surabaya',
                    'birth_date' => '1980-01-11',
                    'join_date' => '2005-08-07',
                ],
                [
                    'code' => 'IP06002',
                    'name' => 'Amin',
                    'address' => 'Jln Imam Bonjol no 11, Mojokerto',
                    'birth_date' => '1977-09-03',
                    'join_date' => '2005-08-07',
                ],
                [
                    'code' => 'IP06003',
                    'name' => 'Yusuf',
                    'address' => 'Jln A Yani Raya 15 No 14 Malang',
                    'birth_date' => '1973-08-09',
                    'join_date' => '2006-08-07',
                ],
                [
                    'code' => 'IP06004',
                    'name' => 'Alyssa',
                    'address' => 'Jln Bungur Sari V no 166, Bandung',
                    'birth_date' => '1983-03-18',
                    'join_date' => '2006-09-06',
                ],
                [
                    'code' => 'IP06005',
                    'name' => 'Maulana',
                    'address' => 'Jln Candi Agung No 78 Gg 5, Jakarta',
                    'birth_date' => '1978-11-10',
                    'join_date' => '2006-09-10',
                ],
                [
                    'code' => 'IP06006',
                    'name' => 'Agfika',
                    'address' => 'Jln Nangka, Jakarta Timur',
                    'birth_date' => '1979-02-07',
                    'join_date' => '2007-01-02',
                ],
                [
                    'code' => 'IP06007',
                    'name' => 'James',
                    'address' => 'Jln Merpati, 8 Surabaya',
                    'birth_date' => '1989-05-18',
                    'join_date' => '2007-04-04',
                ],
                [
                    'code' => 'IP06008',
                    'name' => 'Octavanus',
                    'address' => 'Jln A Yani 17, B 08 Sidoarjo',
                    'birth_date' => '1985-04-14',
                    'join_date' => '2007-05-19',
                ],
                [
                    'code' => 'IP06009',
                    'name' => 'Nugroho',
                    'address' => 'Jln Duren tiga 167, Jakarta Selatan',
                    'birth_date' => '1984-01-01',
                    'join_date' => '2008-01-16',
                ],
                [
                    'code' => 'IP06010',
                    'name' => 'Raisa',
                    'address' => 'Jln Kelapa Sawit, Jakarta Selatan',
                    'birth_date' => '1990-12-17',
                    'join_date' => '2008-08-16',
                ],
            ]));
            \DB::table('employee_leaves')->insert($this->parseEmployeeLeave([
                [
                    'employee_id' => 1,
                    'leave_date' => '2020-08-02',
                    'leave_days' => 2,
                    'note' => 'Acara Keluarga',
                ],
                [
                    'employee_id' => 1,
                    'leave_date' => '2020-08-18',
                    'leave_days' => 2,
                    'note' => 'Anak Sakit',
                ],
                [
                    'employee_id' => 6,
                    'leave_date' => '2020-08-19',
                    'leave_days' => 1,
                    'note' => 'Nenek Sakit',
                ],
                [
                    'employee_id' => 7,
                    'leave_date' => '2020-08-23',
                    'leave_days' => 1,
                    'note' => 'Sakit',
                ],
                [
                    'employee_id' => 4,
                    'leave_date' => '2020-08-29',
                    'leave_days' => 5,
                    'note' => 'Menikah',
                ],
                [
                    'employee_id' => 3,
                    'leave_date' => '2020-08-30',
                    'leave_days' => 2,
                    'note' => 'Acara Keluarga',
                ],
            ]));
        });
    }

    private function parseEmployees($employees)
    {
        $return = [];
        foreach ($employees as $employee)
        {
            $return[] = $employee;
            $return['created_at'] = now();
        }
        return $return;
    }

    private function parseEmployeeLeaves($employeeLeaves)
    {
        $return = [];
        foreach ($employeeLeaves as $employeeLeave)
        {
            $return[] = $employeeLeave;
            $return['created_at'] = now();
        }
        return $return;
    }
}
