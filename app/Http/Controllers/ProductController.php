<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;


/**
 * @OA\Info(
 *     title="API Dokumentasi Produk",
 *     version="1.0.0",
 *     description="Dokumentasi API untuk pengelolaan produk.",
 *     @OA\Contact(
 *         email="nofafirdaus@example.com"
 *     )
 * )
 */



class ProductController extends Controller
{
     /**
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT", // Optional, specify if using JWT
 *     description="Masukkan token Bearer Anda di sini"
 * )
 */

    /**

     * Menampilkan semua produk.
     *
     * @OA\Get(
     *     path="/product",
     *     summary="Daftar produk",
     *     description="Mengambil semua data produk.",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Daftar produk berhasil diambil"
     *     )
     * )
     */


    public function index()
    {
        $product = Product::all();
        return response()->json($product);
    }
    /**
     * Menyimpan produk baru.
     *
     * @OA\Post(
     *     path="/product",
     *     summary="Tambah produk",
     *     description="Menyimpan produk baru ke database.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produk berhasil disimpan"
     *     )
     * )
     */
    public function store(Request $request)
    {
        // $rules = ['price' => ['required', 'min:0', 'numeric']];
        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'message' => 'Validasi gagal.',
        //         'errors' => $validator->errors()
        //     ], 401);
        // }
        // $validate = $validator->validated();
        try {
            $data = Product::create($request->all());
            return response()->json([
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Produk gagal dibuat. ',
                'error' => $e->getMessage()
            ], 401);
        }
    }
    /**

  * Menampilkan semua produk.
  *
  * @OA\Get(
  *     path="/product/{id}",
  *     summary="Daftar produk",
  *     description="Mengambil semua data produk.",
  *  @OA\Parameter(
  *         name="id",
  *         in="path",
  *         required=true,
  *         @OA\Schema(type="integer"),
  *         description="ID produk yang ingin ditampilkan"
  *     ),
  *     @OA\Response(
  *         response=200,
  *         description="Daftar produk berhasil diambil"
  *     )
  * )
  */
    public function show($id)
    {
    }
    /**
* Mengupdate produk baru.
*
* @OA\Put(
*     path="/products/{id}",
*     summary="Tambah produk",
*     description="Menyimpan produk baru ke database.",
*      *  @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         @OA\Schema(type="integer"),
*         description="ID produk yang ingin ditampilkan"
*     ),

*     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             @OA\Property(property="name", type="string"),
*             @OA\Property(property="description", type="string"),
*             @OA\Property(property="price", type="number", format="float")
*         )
*     ),
*     @OA\Response(
*         response=201,
*         description="Produk berhasil disimpan"
*     )
* )
*/

    public function update(Request $request, $id)
    {
    }
    /**
* Mengupdate produk baru.
*
* @OA\Delete(
*     path="/products/{id}",
*     summary="Menghapus produk",
*     description="Menghapus produk baru ke database.",
*      *  @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         @OA\Schema(type="integer"),
*         description="ID produk yang ingin ditampilkan"
*     ),

*     @OA\Response(
*         response=200,
*         description="Produk berhasil disimpan"
*     )
* )
*/
    public function destroy($id)
    {
        if (Product::where('id', $id)->delete()) {
            return response()->json(['status' => 'ok']);
        }
    }
}
