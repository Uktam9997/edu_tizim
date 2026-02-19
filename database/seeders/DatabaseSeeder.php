<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // 🚪 Xonalar
        $rooms = [
            '0.1-xona','0.2-xona','0.3-xona','0.4-xona',
            '1.1-xona','1.2-xona','1.3-xona','1.4-xona',
            '2.1-xona','2.2-xona','2.3-xona','2.4-xona','2.5-xona',
            '3.1-xona','3.2-xona','3.3-xona','3.4-xona','3.5-xona',
        ];
        foreach ($rooms as $room) {
            DB::table('rooms')->insert(['room_name' => $room]);
        }

        // 🕒 Vaqt oralig‘i
        $timeslots = [
            ['day_type' => 'D-CH-J', 'start_time' => '08:00:00', 'end_time' => '10:00:00'],
            ['day_type' => 'D-CH-J', 'start_time' => '10:00:00', 'end_time' => '12:00:00'],
            ['day_type' => 'D-CH-J', 'start_time' => '14:00:00', 'end_time' => '16:00:00'],
            ['day_type' => 'D-CH-J', 'start_time' => '16:00:00', 'end_time' => '18:00:00'],
            ['day_type' => 'S-P-SH', 'start_time' => '08:00:00', 'end_time' => '10:00:00'],
            ['day_type' => 'S-P-SH', 'start_time' => '10:00:00', 'end_time' => '12:00:00'],
            ['day_type' => 'S-P-SH', 'start_time' => '14:00:00', 'end_time' => '16:00:00'],
            ['day_type' => 'S-P-SH', 'start_time' => '16:00:00', 'end_time' => '18:00:00'],
        ];
        DB::table('timeslots')->insert($timeslots);

        // 👨‍🏫 Teachers
        for ($i = 0; $i < 5; $i++) {
            DB::table('teachers')->insert([
                'fullname' => $faker->name,
                'phone' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 📚 Subjects
        for ($i = 0; $i < 5; $i++) {
            DB::table('subjects')->insert([
                'subject_name' => ucfirst($faker->word),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 🏫 Groups
        $teacherIds = DB::table('teachers')->pluck('id')->toArray();
        $subjectIds = DB::table('subjects')->pluck('id')->toArray();
        for ($i = 0; $i < 10; $i++) {
            DB::table('groups')->insert([
                'group_name' => 'Group ' . strtoupper($faker->lexify('???')),
                'teacher_id' => $faker->randomElement($teacherIds),
                'subject_id' => $faker->randomElement($subjectIds),
                'status' => $faker->randomElement(['active','inactive','archived']),
                'closed_at' => $faker->optional()->dateTime(),
                'closed_reason' => $faker->optional()->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 👩‍🎓 Students
        for ($i = 0; $i < 20; $i++) {
            DB::table('students')->insert([
                'fullname' => $faker->name,
                'phone' => $faker->phoneNumber,
                'birth_date' => $faker->date(),
                'join_date' => $faker->date(),
                'level' => $faker->randomElement(['beginner','intermediate','advanced']),
                'course_price' => $faker->numberBetween(100, 500),
                'paid_sum' => $faker->numberBetween(0, 500),
                'debt1' => $faker->numberBetween(0, 100),
                'debt2' => $faker->numberBetween(0, 100),
                'comment' => $faker->optional()->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 🔗 group_student pivot
        $studentIds = DB::table('students')->pluck('id')->toArray();
        $groupIds = DB::table('groups')->pluck('id')->toArray();
        foreach ($studentIds as $studentId) {
            // har bir student 1-3 tagacha guruhga qo‘shiladi
            $assignedGroups = $faker->randomElements($groupIds, rand(1,3));
            foreach ($assignedGroups as $groupId) {
                DB::table('group_student')->insert([
                    'student_id' => $studentId,
                    'group_id' => $groupId,
                    'join_date' => $faker->date(),
                    'status' => $faker->randomElement(['active','inactive']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}














