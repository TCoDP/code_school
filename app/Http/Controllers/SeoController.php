<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $baseUrl = config('app.url');
        $courses = Course::where('is_active', true)->get();
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Главная страница
        $xml .= $this->urlElement($baseUrl, now()->format('Y-m-d'), 'weekly', '1.0');
        
        // Юридические страницы
        $xml .= $this->urlElement($baseUrl . '/privacy-policy', now()->format('Y-m-d'), 'monthly', '0.5');
        $xml .= $this->urlElement($baseUrl . '/terms-of-service', now()->format('Y-m-d'), 'monthly', '0.5');
        
        // Курсы (если нужны публичные страницы курсов)
        foreach ($courses as $course) {
            $xml .= $this->urlElement(
                $baseUrl . '/courses/' . $course->id,
                $course->updated_at->format('Y-m-d'),
                'weekly',
                '0.8'
            );
        }
        
        $xml .= '</urlset>';
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
    
    private function urlElement(string $url, string $lastmod, string $changefreq, string $priority): string
    {
        return "  <url>\n" .
               "    <loc>{$url}</loc>\n" .
               "    <lastmod>{$lastmod}</lastmod>\n" .
               "    <changefreq>{$changefreq}</changefreq>\n" .
               "    <priority>{$priority}</priority>\n" .
               "  </url>\n";
    }
    
    public function robots(): Response
    {
        $sitemapUrl = config('app.url') . '/sitemap.xml';
        
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /student/\n";
        $content .= "Disallow: /dashboard\n";
        $content .= "Disallow: /login\n";
        $content .= "Disallow: /register\n";
        $content .= "\n";
        $content .= "Sitemap: {$sitemapUrl}\n";
        
        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}

