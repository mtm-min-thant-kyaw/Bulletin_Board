<!-- Modal -->
<div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to delete?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <h4 class="col-4">ID</h4>
                    <div class="col-sm-8 text-danger">
                        <h6>{{ $post->id }}</h6>
                    </div>
                </div>
                <div class="mb-3 row">
                    <h4 class="col-4">Title</h4>
                    <div class="col-sm-8 text-danger">
                        <h6>{{ $post->title }}</h6>
                    </div>
                </div>
                <div class="mb-3 row">
                    <h4 class="col-4">Description</h4>
                    <div class="col-sm-8 text-danger">
                        <h6>{{ $post->description }}</h6>
                    </div>
                </div>
                <div class="mb-3 row">
                    <h4 class="col-4">Status</h4>
                    <div class="col-sm-8 text-danger">
                        <h6>{{ $post->status != null ? 'Active' : 'Inactive' }}</h6>
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
