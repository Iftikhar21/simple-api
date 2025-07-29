<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProductController extends Controller
{
    private static $products = [
        ['id' => 1, 'nama' => 'Laptop Gaming', 'harga' => 15000000],
        ['id' => 2, 'nama' => 'Laptop Kantor', 'harga' => 10000000],
    ];

    public function index() 
    {
        return response()->json(self::$products, Response::HTTP_OK);
    }

    public function show($id)
    {
        $product = collect(self::$products)->firstWhere('id', (int)$id);

        if ($product) {
            return response()->json($product, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Produk tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        $data = $request->only(['nama', 'harga']);
        $newId = count(self::$products) + 1;
        $data['id'] = $newId;

        self::$products[] = $data;

        return response()->json([...$data, 'message' => 'Produk berhasil ditambahkan'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $index = collect(self::$products)->search(fn($b) => $b['id'] == $id);

        if ($index !== false) {
            self::$products[$index] = [
                'id' => (int)$id,
                'nama' => $request->input('nama'),
                'harga' => $request->input('harga'),
            ];
            return response()->json([...self::$products[$index], 'message' => 'Produk berhasil diperbarui'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Produk tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id)
    {
        $index = collect(self::$products)->search(fn($b) => $b['id'] == $id);

        if ($index !== false) {
            array_splice(self::$products, $index, 1);
            return response()->json(['message' => 'Produk berhasil dihapus'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Produk tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }
    }
}
