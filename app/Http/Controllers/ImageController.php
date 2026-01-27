<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Auxiliar privado para gerar o caminho da pasta do usuário.
     */
    private function getUserPath($user)
    {
        $emailPrefix = explode('@', $user->email)[0];
        $folderName = preg_replace('/[^a-z0-9]/', '', strtolower($emailPrefix));
        return "src/{$folderName}";
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = $request->user();
        $path = $this->getUserPath($user);

        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            $filePath = $file->storeAs($path, $fileName, 'public');

            return response()->json([
                'message' => 'Upload realizado com sucesso!',
                'url' => asset('storage/' . $filePath),
                'filename' => $fileName
            ], 201);
        }

        return response()->json(['message' => 'Erro ao processar imagem'], 400);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $path = $this->getUserPath($user);

        // Lista arquivos da pasta do usuário no disco 'public'
        $files = Storage::disk('public')->files($path);
        
        $urls = array_map(function($file) {
            return asset('storage/' . $file);
        }, $files);

        return response()->json([
            'user' => $user->email,
            'folder' => basename($path),
            'images' => $urls
        ]);
    }

    public function destroy(Request $request, $filename)
    {
        $path = $this->getUserPath($request->user()) . '/' . $filename;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return response()->json(['message' => 'Imagem removida com sucesso!']);
        }

        return response()->json(['message' => 'Arquivo não encontrado'], 404);
    }
}