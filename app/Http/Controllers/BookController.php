<?php

namespace App\Http\Controllers;

// use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    private static $books = [
        ['id' => 1, 'judul' => 'Algoritma Pemrograman', 'penulis' => 'Budi', 'tahun' => 2020],
        ['id' => 2, 'judul' => 'Desain Web Modern', 'penulis' => 'Ani', 'tahun' => 2022],
    ];

    public function index()
    {
        return response()->json(self::$books, Response::HTTP_OK);
    }

    public function show($id)
    {
        $book = collect(self::$books)->firstWhere('id', (int)$id);

        if ($book) {
            return response()->json($book, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Buku tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        $data = $request->only(['judul', 'penulis', 'tahun']);
        $newId = count(self::$books) + 1;
        $data['id'] = $newId;

        self::$books[] = $data;

        return response()->json([...$data, 'message' => 'Buku berhasil ditambahkan'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $index = collect(self::$books)->search(fn($b) => $b['id'] == $id);

        if ($index !== false) {
            self::$books[$index] = [
                'id' => (int)$id,
                'judul' => $request->input('judul'),
                'penulis' => $request->input('penulis'),
                'tahun' => $request->input('tahun'),
            ];
            return response()->json([...self::$books[$index], 'message' => 'Buku berhasil diperbarui'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Buku tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id)
    {
        $index = collect(self::$books)->search(fn($b) => $b['id'] == $id);

        if ($index !== false) {
            array_splice(self::$books, $index, 1);
            return response()->json(['message' => 'Buku berhasil dihapus'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Buku tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }
    }
}
