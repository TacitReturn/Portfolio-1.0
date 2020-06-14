@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success float-lg-right">Add Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header text-center">
            Categories
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <th>Name</th>
                {{--                <th>Created At</th>--}}
                <th>Post Count</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ Str::limit($category->name, 30, ' ...')}} </td>
                        {{--                        <td>{{$category->created_at->format('jS F Y h:i A')}}</td>--}}
                        <td>
                            {{ $category->post->count() }}
                        </td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="btn btn-success btn-sm">Edit</a>
                        </td>
                        <td>
                            <form action="{{route('categories.destroy', $category->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <!-- Button trigger modal -->
                                <button id="delete-category" type="submit"
                                        class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <form action="" method="POST" id="delete-category-form">
    @csrf
    @method('DELETE')
    <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this category? This action isn't reversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                        <button type="submit" class="btn btn-danger">Delete Category</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@section('script')
{{--    <script type="text/javascript">--}}

{{--        function handleDelete(id) {--}}
{{--            // Create Form Element--}}
{{--            let form = document.getElementById('delete-category-form');--}}
{{--            // Set Form Action--}}
{{--            form.action = `/categories/${id}`;--}}
{{--        }--}}

{{--    </script>--}}
@endsection
@endsection
