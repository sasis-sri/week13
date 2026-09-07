<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function blog2()
    {
        $blogs = DB::table("blogs")->paginate(3);
        return view("blog", compact('blogs'));
    }

    function delete($id)
    {
        DB::table("blogs")->where('id', $id)->delete();
        return redirect('/blog2');
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

        DB::table("blogs")->insert($data);
        return redirect('/blog2');
    }

    function change($id)
    {
        $blog = DB::table("blogs")->where('id', $id)->first();
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
        DB::table("blogs")->where('id', $id)->update($data);
        return redirect('/blog2');
    }

    function edit($id)
    {
        $blog = DB::table("blogs")->where('id', $id)->first();
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
        return redirect('/blog2');
    }
}
