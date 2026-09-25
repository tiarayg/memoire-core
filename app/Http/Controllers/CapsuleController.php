<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use Illuminate\Http\Request;

class CapsuleController extends Controller
{

    public function index(Request $request)
    {
        $capsules = Capsule::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'capsules' => $capsules,
        ]);
    }

    public function show(Request $request, Capsule $capsule)
    {
        if ($capsule->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Capsule tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'capsule' => $capsule,
        ]);
    }

    public function update(Request $request, Capsule $capsule)
    {
        if ($capsule->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Capsule tidak ditemukan.',
            ], 404);
        }

        if ($capsule->status !== 'draft') {
            return response()->json([
                'message' => 'Capsule yang sudah disegel tidak dapat diedit.',
            ], 422);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'content' => ['required', 'string'],
        ]);

        $capsule->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return response()->json([
            'message' => 'Draft capsule berhasil diperbarui.',
            'capsule' => $capsule,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', 'in:time'],
            'title' => ['required', 'string', 'max:150'],
            'content' => ['required', 'string'],
        ]);

        $capsule = Capsule::create([
            'user_id' => $request->user()->id,
            'type' => $validated['type'],
            'title' => $validated['title'],
            'content' => $validated['content'],
            'status' => 'draft',
            'open_at' => null,
            'category_id' => null,
        ]);

        return response()->json([
            'message' => 'Draft capsule berhasil dibuat.',
            'capsule' => $capsule,
        ], 201);
    }

    public function seal(Request $request, Capsule $capsule)
    {
        if ($capsule->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Capsule tidak ditemukan.',
            ], 404);
        }

        if ($capsule->status !== 'draft') {
            return response()->json([
                'message' => 'Capsule ini sudah tidak dapat disegel.',
            ], 422);
        }

        $validated = $request->validate([
            'open_at' => ['required', 'date', 'after:now'],
        ]);

        $capsule->update([
            'open_at' => $validated['open_at'],
            'status' => 'sealed',
        ]);

        return response()->json([
            'message' => 'Capsule berhasil disegel.',
            'capsule' => $capsule,
        ]);
    }
}