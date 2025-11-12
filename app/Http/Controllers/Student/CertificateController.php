<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function download(Request $request, $certificateId)
    {
        // Проверяем авторизацию
        if (!$request->user()) {
            abort(401, 'Необходима авторизация');
        }
        
        $user = $request->user();
        
        $certificate = Certificate::where('id', $certificateId)
            ->where('user_id', $user->id)
            ->with('course')
            ->firstOrFail();
        
        // Всегда генерируем PDF на лету для надежности
        try {
            $html = $this->getCertificateHtml($certificate, $user);
            
            // Генерируем PDF
            $pdf = Pdf::loadHTML($html);
            $pdf->setPaper('A4', 'portrait');
            $pdf->setOption('enable-local-file-access', true);
            $pdf->setOption('isHtml5ParserEnabled', true);
            $pdf->setOption('isRemoteEnabled', true);
            
            $filename = "certificate-{$certificate->course->name}-{$certificate->id}.pdf";
            
            // Возвращаем PDF напрямую без сохранения в файл
            return response($pdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
            
        } catch (\Exception $e) {
            Log::error('PDF generation error: ' . $e->getMessage(), [
                'certificate_id' => $certificate->id,
                'user_id' => $user->id,
                'trace' => $e->getTraceAsString(),
            ]);
            
            // Пробуем вернуть существующий файл, если есть
            if ($certificate->file_path && Storage::disk('local')->exists($certificate->file_path)) {
                $filePath = Storage::disk('local')->path($certificate->file_path);
                $filename = "certificate-{$certificate->course->name}-{$certificate->id}.pdf";
                return response()->download($filePath, $filename, [
                    'Content-Type' => 'application/pdf',
                ]);
            }
            
            abort(500, 'Ошибка при генерации PDF: ' . $e->getMessage());
        }
    }
    
    public function share(Request $request, $certificateId)
    {
        // Проверяем авторизацию
        if (!$request->user()) {
            abort(401, 'Необходима авторизация');
        }
        
        $user = $request->user();
        
        $certificate = Certificate::where('id', $certificateId)
            ->where('user_id', $user->id)
            ->with('course')
            ->firstOrFail();
        
        // Генерируем публичную ссылку для поделиться
        // Пока используем прямую ссылку на страницу сертификатов с параметром
        $shareUrl = route('student.certificates') . '?certificate=' . $certificateId;
        
        return response()->json([
            'url' => $shareUrl,
            'title' => "Сертификат: {$certificate->course->name}",
            'text' => "Я получил сертификат по курсу «{$certificate->course->name}» в Академии-Кода! 🎓",
        ]);
    }
    
    private function getCertificateHtml(Certificate $certificate, User $user): string
    {
        $course = $certificate->course;
        $issuedDate = $certificate->issued_at 
            ? $certificate->issued_at->format('d.m.Y')
            : now()->format('d.m.Y');
        
        return view('certificates.template', [
            'certificate' => $certificate,
            'user' => $user,
            'course' => $course,
            'issuedDate' => $issuedDate,
        ])->render();
    }
}
