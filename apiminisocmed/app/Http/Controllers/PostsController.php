<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    // === GET ALL DATA ===
    public function index() {
        $posts = Post::get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data' => $posts
        ]);
    }

    // === STORE DATA ===
    // Memanfaatkan dependency injection
    public function store(Request $request) {
        // Untuk mengecek apakah data berhasil masuk atau tidak
        // dd($request->all());

        // Validasi Input
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'content' => 'required|string|max:255',
            'image_url' => 'nullable'

        ]);

        // Jika validasi gagal
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors()
            ], 400);
        }

        // Jika validasi berhasil, maka simpan data ke database
        $post = Post::create([
            'user_id' => $request->user_id,
            'content' => $request->input('content'),
            'image_url' => $request->image_url
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dibuat',
            // return data yang baru dibuat
            'data' => $post
        ], 201);
    }

    // === GET POST BY ID ===
    public function show($id) {
        $post = Post::find($id);

        return response()->json([
            'success'=> true,
            'data'=> $post
        ], 200);
    }

    // === UPDATE POST BY ID ===
    public function update(Request $request, $id) {
        // Validasi Input
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
            'image_url' => 'nullable'
        ]);

        // Jika validasi gagal
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors()
            ], 400);
        }

        // Jika validasi berhasil, maka update data ke database
        // 1. Cari data berdasarkan id
        $post = Post::find($id);

        // 2. Tampung data baru
        // Kiri dari database, kanan dari request
        $post->content = $request->input('content');
        $post->image_url = $request->image_url;

        // 3. Simpan data
        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil diupdate',
            // return data yang baru diupdate
            'data' => $post
        ], 200);
    }

    // DESTROY
    public function destroy(int $id)
    {
        Post::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dihapus',
        ], 200);
    }

}
