<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GetUserController extends Controller
{
    public function index(Request $request) {
        $posts = User::orderBy(request()->sortby, request()->sortbydesc)
            //JIKA Q ATAU PARAMETER PENCARIAN INI TIDAK KOSONG
            ->when(request()->q, function($posts) {
                //MAKA FUNGSI FILTER AKAN DIJALANKAN
                $posts = $posts->where('name', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('ktp_no', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('email', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('addres', 'LIKE', '%' . request()->q . '%');
        })->paginate(request()->per_page); //KEMUDIAN LOAD PAGINATIONNYA BERDASARKAN LOAD PER_PAGE YANG DIINGINKAN OLEH USER
        return response()->json(['status' => 'success', 'data' => $posts]);
    }
}
