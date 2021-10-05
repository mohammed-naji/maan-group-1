<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Post;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function import()
    {
        Excel::import(new ProductsImport, request()->file('product'));
        return redirect()->back();
    }

    public function image()
    {
        return view('image');
    }

    public function imageSubmit(Request $request)
    {
        // dd($request->file('image'));

        // change the image name
        $ex = $request->file('image')->getClientOriginalExtension();
        $new_img_name = 'maan_advanced_' . time() . '_' . rand() . '.' . $ex;


        $img = Image::make($request->file('image'));

        $img150 = $img->resize(150, 150);
        $img150->save('images/thumb150/' . $new_img_name);

        $img300 = $img->resize(300, 300);
        $img300->save('images/thumb300/' . $new_img_name);

        $img->save('images/full/' . $new_img_name);

        return $img->response('jpg');
    }

    public function blog()
    {
        $posts = Post::all();
        return view('blog', compact('posts'));
        // return view('blog', []);
        // return view('blog')->with();
    }
}



// $name = explode('.', '154544.fdsffsd.fdsfas.554_55445.png');
// $ex = end($name);
