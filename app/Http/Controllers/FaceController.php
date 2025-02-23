<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Face;

class FaceController extends Controller
{
    // Menyimpan wajah ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'face_descriptor' => 'required|json',
        ]);

        $face = Face::create([
            'name' => $request->name,
            'face_descriptor' => json_decode($request->face_descriptor, true),
        ]);

        return response()->json(['message' => 'Face data saved!', 'face' => $face], 201);
    }

    // Mencocokkan wajah
    public function match(Request $request)
    {
        $request->validate(['face_descriptor' => 'required|json']);
        $inputDescriptor = json_decode($request->face_descriptor, true);

        $faces = Face::all();
        $bestMatch = null;
        $bestDistance = 9999;

        foreach ($faces as $face) {
            $distance = $this->euclideanDistance($face->face_descriptor, $inputDescriptor);
            if ($distance < $bestDistance && $distance < 0.5) { // Threshold 0.5
                $bestMatch = $face->name;
                $bestDistance = $distance;
            }
        }

        return response()->json(['match' => $bestMatch ?: 'Unknown']);
    }

    private function euclideanDistance($vector1, $vector2)
    {
        $sum = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $sum += pow($vector1[$i] - $vector2[$i], 2);
        }
        return sqrt($sum);
    }
}

