<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function export($slug)
    {
        $research = Research::where('slug', $slug)->with(['sections', 'references'])->firstOrFail();

        $pdf = Pdf::loadView('exports.research-pdf', compact('research'));
        
        // Setup PDF options for Arabic support (using a font that supports Arabic)
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return $pdf->download("{$research->title}.pdf");
    }
}
