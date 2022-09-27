<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'name' => 'Исправить ошибку в какой-нибудь строке',
            'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
            'status_id' => TaskStatus::firstWhere('name', 'новый')->id,
            'created_by_id' => User::firstWhere('name', 'Кузьмина Николай Фёдорович')->id,
            'assigned_to_id' => User::firstWhere('name', 'Дементьева Феликс Дмитриевич')->id,
        ])->labels()->attach(Label::firstWhere('name', 'ошибка')->id);
        Task::create([
            'name' => 'Допилить дизайн главной страницы',
            'description' => 'Вёрстка поехала в далёкие края. Нужно удалить бутстрап!',
            'status_id' => TaskStatus::firstWhere('name', 'завершен')->id,
            'created_by_id' => User::firstWhere('name', 'Фокинаа Марта Фёдоровна')->id,
            'assigned_to_id' => User::firstWhere('name', 'Юлиан Александрович Марков')->id,
        ])->labels()
            ->attach([
                Label::firstWhere('name', 'ошибка')->id,
                Label::firstWhere('name', 'доработка')->id
            ]);
//            ->attach(Label::firstWhere('name', 'доработка')->id);
        Task::create([
            'name' => 'Отрефакторить авторизацию',
            'description' => 'Выпилить всё легаси, которое найдёшь',
            'status_id' => TaskStatus::firstWhere('name', 'в работе')->id,
            'created_by_id' => User::firstWhere('name', 'Анастасия Сергеевна Матвеева')->id,
            'assigned_to_id' => User::firstWhere('name', 'Дементьева Феликс Дмитриевич')->id,
        ]);
        Task::create([
            'name' => 'Доработать команду подготовки БД',
            'description' => 'За одно добавить тестовых данных',
            'status_id' => TaskStatus::firstWhere('name', 'на тестировании')->id,
            'created_by_id' => User::firstWhere('name', 'Кузьмина Николай Фёдорович')->id,
            'assigned_to_id' => User::firstWhere('name', 'Фокинаа Марта Фёдоровна')->id,
        ]);
        Task::create([
            'name' => 'Исправить поиск',
            'description' => 'Не ищет то, что мне хочется',
            'status_id' => TaskStatus::firstWhere('name', 'завершен')->id,
            'created_by_id' => User::firstWhere('name', 'Юлиан Александрович Марков')->id,
            'assigned_to_id' => User::firstWhere('name', 'Дементьева Феликс Дмитриевич')->id,
        ]);
    }
}
