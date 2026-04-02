<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class adminController extends Controller
{
       public function category_page(){
        return view('add-category');
    }
    public function add_category(Request $request)
    {
        // $request->validate([
        //     'category'=>['required','max:50'],
        // ]);
        $data = new Category();
        $data->name = $request->category;
        $data->save();
        return redirect('admin/dashboard');
    }
}
