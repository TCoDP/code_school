<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Certificate;
use App\Models\ChatMessage;
use App\Models\Course;
use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentDataSeeder extends Seeder
{
    public function run(): void
    {
        // Назначаем первого пользователя администратором
        $firstUser = User::first();
        if ($firstUser) {
            $firstUser->update(['role' => 'admin']);
        }
        
        // Создаём курсы
        $pythonCourse = Course::create([
            'name' => 'Python Start',
            'icon' => '🐍',
            'age_range' => '11–13 лет',
            'description' => 'Создание игр, изучение логики программирования и первые веб-проекты',
            'technologies' => ['Python', 'Игры', 'Сайты'],
            'total_lessons' => 20,
            'is_active' => true,
        ]);

        $webCourse = Course::create([
            'name' => 'Web & AI',
            'icon' => '🌐',
            'age_range' => '14–17 лет',
            'description' => 'Современная веб-разработка и знакомство с искусственным интеллектом',
            'technologies' => ['HTML/CSS/JS', 'Чат-боты', 'Нейросети'],
            'total_lessons' => 25,
            'is_active' => true,
        ]);

        $juniorCourse = Course::create([
            'name' => 'Junior Code',
            'icon' => '🎮',
            'age_range' => '8–10 лет',
            'description' => 'Первые шаги в программировании через визуальные блоки и игровую среду',
            'technologies' => ['Scratch', 'Minecraft Education'],
            'total_lessons' => 15,
            'is_active' => true,
        ]);

        // Создаём общие задания для курсов (без привязки к пользователю)
        $assignment1 = Assignment::create([
            'course_id' => $pythonCourse->id,
            'title' => 'Создание игры "Змейка"',
            'description' => 'Реализуйте классическую игру "Змейка" используя изученные конструкции Python',
            'icon' => '🐍',
            'lesson_number' => 5,
            'days_to_complete' => 7,
        ]);

        $assignment2 = Assignment::create([
            'course_id' => $webCourse->id,
            'title' => 'Веб-страница "О себе"',
            'description' => 'Создайте персональную веб-страницу с использованием HTML и CSS',
            'icon' => '🌐',
            'lesson_number' => 3,
            'days_to_complete' => 5,
        ]);

        $assignment3 = Assignment::create([
            'course_id' => $pythonCourse->id,
            'title' => 'Калькулятор на Python',
            'description' => 'Создайте консольный калькулятор с базовыми операциями',
            'icon' => '🔢',
            'lesson_number' => 4,
            'days_to_complete' => 3,
        ]);

        $assignment4 = Assignment::create([
            'course_id' => $webCourse->id,
            'title' => 'Адаптивная навигация',
            'description' => 'Создайте адаптивное меню навигации для мобильных устройств',
            'icon' => '📱',
            'lesson_number' => 7,
            'days_to_complete' => 7,
        ]);

        // Создаём материалы для курсов (общие для всех)
        Material::create([
            'course_id' => $pythonCourse->id,
            'title' => 'Урок 5: Создание игр на Python',
            'description' => 'Полная запись урока по созданию игры "Змейка". Разбор всех этапов разработки.',
            'icon' => '🎥',
            'type' => 'video',
            'lesson_number' => 5,
            'links' => [
                ['icon' => '▶️', 'label' => 'Смотреть видео', 'url' => '#'],
                ['icon' => '📄', 'label' => 'Скачать код', 'url' => '#'],
                ['icon' => '📝', 'label' => 'Конспект урока', 'url' => '#'],
            ],
            'is_new' => true,
        ]);

        Material::create([
            'course_id' => $pythonCourse->id,
            'title' => 'Полезные ресурсы по Python',
            'description' => 'Подборка лучших сайтов и документации для изучения Python',
            'icon' => '🔗',
            'type' => 'link',
            'links' => [
                ['icon' => '🌐', 'label' => 'Python.org', 'url' => 'https://python.org'],
                ['icon' => '📚', 'label' => 'Документация', 'url' => 'https://docs.python.org'],
            ],
            'is_new' => false,
        ]);

        Material::create([
            'course_id' => $webCourse->id,
            'title' => 'HTML и CSS: Основы веб-разработки',
            'description' => 'Презентация с примерами кода и лучшими практиками',
            'icon' => '📊',
            'type' => 'presentation',
            'lesson_number' => 3,
            'links' => [
                ['icon' => '📄', 'label' => 'Скачать PDF', 'url' => '#'],
                ['icon' => '💻', 'label' => 'Примеры кода', 'url' => '#'],
            ],
            'is_new' => true,
        ]);

        Material::create([
            'course_id' => $pythonCourse->id,
            'title' => 'Чек-лист для домашнего задания',
            'description' => 'Проверьте, всё ли вы сделали перед отправкой задания',
            'icon' => '✅',
            'type' => 'document',
            'links' => [
                ['icon' => '📋', 'label' => 'Открыть чек-лист', 'url' => '#'],
            ],
            'is_new' => false,
        ]);

        // Получаем или создаём тестового пользователя
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Тестовый Студент',
                'email' => 'student@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Привязываем курсы к пользователю
        $user->courses()->attach($pythonCourse->id, [
            'progress' => 65,
            'lessons_completed' => 12,
            'homeworks_completed' => 8,
            'status' => 'active',
            'started_at' => now()->subMonths(2),
        ]);

        $user->courses()->attach($webCourse->id, [
            'progress' => 30,
            'lessons_completed' => 5,
            'homeworks_completed' => 3,
            'status' => 'active',
            'started_at' => now()->subMonth(),
        ]);

        // Привязываем задания к пользователю с индивидуальным прогрессом
        $user->assignments()->attach($assignment1->id, [
            'status' => 'review',
            'submitted_at' => now()->subDays(1),
            'feedback' => 'Отличная работа! Код написан чисто и структурированно. Добавьте обработку столкновений со стенами.',
            'grade' => 9,
        ]);

        $user->assignments()->attach($assignment2->id, [
            'status' => 'pending',
        ]);

        $user->assignments()->attach($assignment3->id, [
            'status' => 'completed',
            'submitted_at' => now()->subDays(4),
            'feedback' => 'Всё выполнено правильно! Молодец!',
            'grade' => 10,
        ]);

        // Создаём сертификаты для пользователя
        $certificate1 = Certificate::create([
            'course_id' => $pythonCourse->id,
            'user_id' => $user->id,
            'level' => 'Базовый уровень',
            'progress' => 100,
            'completed_tasks' => 12,
            'total_tasks' => 12,
            'status' => 'completed',
            'issued_at' => now()->subDays(10),
        ]);
        
        // Генерируем PDF для завершённого сертификата
        $this->generateCertificatePdf($certificate1, $user, $pythonCourse);

        Certificate::create([
            'course_id' => $webCourse->id,
            'user_id' => $user->id,
            'level' => 'Продвинутый уровень',
            'progress' => 30,
            'completed_tasks' => 3,
            'total_tasks' => 15,
            'status' => 'in_progress',
        ]);

        // Создаём сообщения чата
        ChatMessage::create([
            'user_id' => $user->id,
            'curator_id' => null,
            'message' => 'Привет! Как дела с домашним заданием по игре "Змейка"? Есть вопросы?',
            'sender_type' => 'curator',
            'is_read' => true,
            'created_at' => now()->subHours(2),
        ]);

        ChatMessage::create([
            'user_id' => $user->id,
            'curator_id' => null,
            'message' => 'Привет! Всё хорошо, почти закончил. Не могу понять, как сделать так, чтобы змейка не выходила за границы экрана.',
            'sender_type' => 'student',
            'is_read' => true,
            'created_at' => now()->subHours(1),
        ]);
    }
    
    private function generateCertificatePdf(Certificate $certificate, User $user, Course $course): void
    {
        // Создаём директорию для сертификатов в приватном хранилище
        $certificatesDir = 'certificates';
        // Используем приватный диск 'local', а не 'public'
        if (!Storage::disk('local')->exists($certificatesDir)) {
            Storage::disk('local')->makeDirectory($certificatesDir);
        }
        
        // Генерируем HTML для сертификата
        $html = $this->getCertificateHtml($certificate, $user, $course);
        
        // Генерируем PDF из HTML
        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('A4', 'portrait');
        
        // Сохраняем PDF файл
        $filename = "certificate-{$certificate->id}.pdf";
        $filePath = "{$certificatesDir}/{$filename}";
        
        // Сохраняем PDF в приватное хранилище
        Storage::disk('local')->put($filePath, $pdf->output());
        
        // Обновляем путь к файлу в базе данных
        $certificate->update([
            'file_path' => $filePath,
        ]);
    }
    
    private function getCertificateHtml(Certificate $certificate, User $user, Course $course): string
    {
        $issuedDate = $certificate->issued_at 
            ? $certificate->issued_at->format('d.m.Y')
            : now()->format('d.m.Y');
        
        // Используем Blade шаблон
        return view('certificates.template', [
            'certificate' => $certificate,
            'user' => $user,
            'course' => $course,
            'issuedDate' => $issuedDate,
        ])->render();
    }
}
