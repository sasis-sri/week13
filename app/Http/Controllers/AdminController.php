<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function blog2()
    {
        $blogs = Blog::paginate(3);
        return view("blog", compact('blogs'));
    }

    function delete($id)
    {
        Blog::destroy($id);
        return redirect()->back();
    }

    function about2()
    {
        $name = 'Sasis srikokpho';
        $date = '20 May 2025';
        return view('about2', compact('name', 'date'));
    }

    function create()
    {
        return view('from');
    }

    function insert(Request $request)
    {
        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

       Blog::insert($data);
        return redirect('/author/blog2');
    }

    function change($id)
    {
        $blog = Blog::find($id);
        $data = [
            'status' => !$blog->status
        ];
        if($blog->status == 1){
            $data = [
            'status' => 0
        ];
        }else{
            $data = [
                'status' => 1
            ];
        }
      Blog::find($id)->update($data);
        return redirect()->back();
    }

    function edit($id)
    {
        $blog = Blog::find($id);
        return view('edit', compact('blog'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
        ], [
            'title.required' => 'กรุณากรอกชื่อบทความ',
            'title.max' => 'ชื่อบทความต้องไม่เกิน 50 ตัวอักษร',
            'content.required' => 'กรุณากรอกเนื้อหาบทความ',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        DB::table("blogs")->where('id', $id)->update($data);
        return redirect('/author/blog2');
    }
}
