<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AIService;
use Smalot\PdfParser\Parser;

class CVController extends Controller
{
    protected $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function uploadForm()
    {
        return view('cv.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048'
        ]);

        $file = $request->file('cv');

        // 🔥 Đọc PDF
        $parser = new Parser();
        $pdf = $parser->parseFile($file->getPathname());
        $text = $pdf->getText();

        // 🔥 AI đọc skill
        $skillsJson = $this->aiService->extractSkills($text);

        // 🔥 Lưu DB
        $user = auth()->user();
        $user->cv_text = $text;
        $user->save();

        // Debug
dd($skillsJson);    }
}