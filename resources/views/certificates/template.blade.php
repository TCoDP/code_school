<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Сертификат - {{ $course->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: white;
            margin: 0;
            padding: 0;
        }
        .certificate {
            background: white;
            width: 210mm;
            height: 297mm;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            position: relative;
            overflow: hidden;
        }
        /* Упрощенный фон для PDF */
        .certificate::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(99,102,241,0.05);
            opacity: 0.3;
        }
        .border {
            border: 8px solid #667eea;
            height: 100%;
            padding: 30px;
            position: relative;
            z-index: 1;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .logo {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .title {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .subtitle {
            font-size: 18px;
            color: #666;
            margin-bottom: 60px;
        }
        .content {
            text-align: center;
            margin: 60px 0;
        }
        .award-text {
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .student-name {
            font-size: 42px;
            font-weight: bold;
            color: #667eea;
            margin: 30px 0;
            border-bottom: 3px solid #764ba2;
            padding-bottom: 10px;
            display: inline-block;
        }
        .course-info {
            font-size: 28px;
            color: #333;
            margin: 30px 0;
            font-weight: 600;
        }
        .level {
            font-size: 20px;
            color: #666;
            margin: 20px 0;
        }
        .footer {
            margin-top: 80px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .signature {
            text-align: center;
            width: 200px;
        }
        .signature-line {
            border-top: 2px solid #333;
            margin: 50px 0 10px;
        }
        .date {
            text-align: center;
            margin-top: 40px;
            font-size: 16px;
            color: #666;
        }
        .certificate-id {
            position: absolute;
            bottom: 20px;
            right: 30px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="border">
            <div class="header">
                <div class="logo">*</div>
                <div class="title">Академия-Кода</div>
                <div class="subtitle">Сертификат об окончании курса</div>
            </div>
            
            <div class="content">
                <div class="award-text">
                    Настоящим удостоверяется, что
                </div>
                
                <div class="student-name">
                    {{ $user->name }}
                </div>
                
                <div class="award-text">
                    успешно завершил(а) курс
                </div>
                
                <div class="course-info">
                    «{{ $course->name }}»
                </div>
                
                <div class="level">
                    Уровень: {{ $certificate->level }}
                </div>
                
                <div class="award-text" style="margin-top: 40px;">
                    Прогресс: {{ $certificate->progress }}%<br>
                    Выполнено заданий: {{ $certificate->completed_tasks }} из {{ $certificate->total_tasks }}
                </div>
            </div>
            
            <div class="footer">
                <div class="signature">
                    <div class="signature-line"></div>
                    <div>Директор</div>
                </div>
                <div class="signature">
                    <div class="signature-line"></div>
                    <div>Наставник</div>
                </div>
            </div>
            
            <div class="date">
                Дата выдачи: {{ $issuedDate }}
            </div>
            
            <div class="certificate-id">
                ID: CERT-{{ $certificate->id }}
            </div>
        </div>
    </div>
</body>
</html>

