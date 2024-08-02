<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Bulletin Board OJT</title>
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to delete?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">

                            <h4>Title</h4>
                            <h4 class="form-control">{{ $post->title }}</h4>
                            <h4>Status</h4>
                            <h4 class="form-control">Active</h4>
                            <h4>Created_at</h4>
                            <h4 class="form-control">{{ $post->created_at->diffForHumans() }}</h4>
                            <h4>Created_User</h4>
                            <h4 class="form-control">{{ $post->user->name }}</h4>
                            <h4>Updated_at</h4>
                            <h4 class="form-control">{{ $post->updated_at }}</h4>
                            <h4>Updated_User</h4>
                            <h4 class="form-control">{{ $post->updateUser->name }}</h4>
                        </div>
                        <div class="col-6">
                            <h4>Description</h4>
                            <textarea class="form-control" rows="10">{{ $post->body }}</textarea>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('post.destroy', $post->id) }}" method="get">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Bootstrap Js Link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
