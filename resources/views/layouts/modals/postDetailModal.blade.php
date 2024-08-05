<div class="modal fade" id="detailModal{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Post Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row bg-secondary shadow">
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
                    </div>
                    <div class="col-6">
                        <h4>Description</h4>
                        <textarea class="form-control" rows="10">{{ $post->body }}</textarea>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
