@extends('layouts.app')

@section('content')
    @auth
    @endauth
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('posts.create')}}" class="btn btn-success float-lg-right">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header text-center">
            Posts
        </div>
        <div class="card-body">
            @if($posts->count() > 0)
                <table class="table">
                    <thead>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ Str::limit($post->title, 30, ' ...')}} </td>
                            <td>
                                <img height="60px" width="120px" src="{{{ asset("storage/$post->image") }}}">
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $post->category->id) }}">
                                    {{ $post->category->name }}
                                </a>
                            </td>
                            @if($post->trashed())
                                <td>
                                    <form action="{{ route('restore-post', $post->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-success btn-sm" type="submit">
                                            Restore
                                        </button>
                                    </form>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                       class="btn btn-success btn-sm">Edit</a>
                                </td>
                            @endif

                            <td>
                                <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete-post" type="submit"
                                            class="btn btn-danger btn-sm"
                                    >
                                        {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else

                <div class="jumbotron">
                    <h1 class="display-4">No posts found!</h1>
                    <p class="lead">Begin writing your first post by click on the Add Post button.</p>
                    <hr class="my-4">
                    <p>Thanks for signing up!</p>
                    <a class="btn btn-success btn-lg" href="#" role="button">Learn more about me..</a>
                </div>

            @endif


        </div>
    </div>
    {{--    <form action="" method="POST" id="delete-post-form">--}}
    {{--    @csrf--}}
    {{--    @method('DELETE')--}}
    {{--    <!-- Modal -->--}}
    {{--        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
    {{--             aria-hidden="true">--}}
    {{--            <div class="modal-dialog" role="document">--}}
    {{--                <div class="modal-content">--}}
    {{--                    <div class="modal-header">--}}
    {{--                        <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>--}}
    {{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--                            <span aria-hidden="true">&times;</span>--}}
    {{--                        </button>--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-body">--}}
    {{--                        Are you sure you want to delete this post? This action isn't reversible.--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-footer">--}}
    {{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>--}}
    {{--                        <button type="submit" class="btn btn-danger">Delete Post</button>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </form>--}}

    {{--@section('script')--}}
    {{--    <script type="text/javascript">--}}

    {{--        function handleDelete(id) {--}}
    {{--            // Create Form Element--}}
    {{--            let form = document.getElementById('delete-post-form');--}}
    {{--            // Set Form Action--}}
    {{--            form.action = `/posts/${id}`;--}}
    {{--        }--}}

    {{--    </script>--}}
    {{--@endsection--}}
@endsection
