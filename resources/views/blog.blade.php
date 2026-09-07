        @extends('layouts.app')

        @section('title', 'บทความทั้งหมด')


        @section('content')
            @if(count($blogs)>0)
                <h2 class="text text-center py-2">
                บทความทั้งหมด</h2>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Status</th>
                         <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{Str::limit($item->content, 100)}}</td>
                            <td>
                            <!-- resources/views/blog.blade.php -->
    @if($item->status)
        <a href="{{route('change', $item->id)}}" class="btn btn-outline-success">เผยแพร่</a>
    @else
        <a href="{{route('change', $item->id)}}" class="btn btn-outline-danger">ฉบับร่าง</a>
    @endif
                            </td>
                            <td><a href="{{route('edit', $item->id)}}" class="btn btn-warning">แก้ไข</a></td>
                            <td><a href="{{ route('delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('วิว คุณต้องการลบ {{$item->title}} ออกจากหัวใจ ใช่หรือไม่?')" >ลบ</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        {{ $blogs->links() }}
            @else
                <h2 class="text text-center py-2">ไม่มีบทความ</h2>
            @endif
        @endsection