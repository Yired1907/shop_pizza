@extends('master.admin')
@section('title', 'Table Category')
@section('main')
    <form action="" class="form-inline" role="form">
        <div class="form-group">
            <label class="sr-only" for="">lable</label>
            <input class="form-control" name="key" placeholder="Input field">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
        <a href="{{ route('category.create') }}" class="btn btn-success pull-right">
            <i class="fa fa-plus"></i> Add new
        </a>
    </form>
    <br>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Category Name</th>
                <th>Category Status</th>
                <th></th>
            <tr>
        </thead>
        <tbody>
            @foreach ($cats as $cat)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>
                        @if ($cat->status == 0)
                            <span style="color: red;">Hidde</span>
                        @else
                            <span style="color: rgb(45, 234, 45);">Publish</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <form action="{{ route('category.destroy', $cat->id) }}" method="post"
                            onsubmit="return confirm('Are you sure want to delete it?')">
                            @csrf @method('DELETE')
                            <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-sm btn-primary"><i
                                    class="fa fa-edit"></i></a>
                            <button href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@stop()
