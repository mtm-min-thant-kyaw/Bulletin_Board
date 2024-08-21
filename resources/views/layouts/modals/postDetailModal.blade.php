<div class="modal fade" id="detailModal{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Post Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
<<<<<<< HEAD
                <div class="mb-3 row">
                    <h4 class="col-4">Status</h4>
                    <div class="col-sm-8 text-danger">
                        <h6>{{ $post->status !=null ? 'Active' : 'Inactive' }}</h6>
                    </div>
=======
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
>>>>>>> develop
                </div>
                <div class="mb-3 row">
                    <h4 class="col-4">Created Date</h4>
                    <div class="col-sm-8 text-danger">
                        <h6>{{ $post->created_at->format('Y/m/d')}}</h6>
                    </div>
                </div>
                <div class="mb-3 row">
                    <h4 class="col-4">Created User</h4>
                    <div class="col-sm-8 text-danger">
                        <h6>{{ $post->user->name}}</h6>
                    </div>
                </div>
                <div class="mb-3 row">
                    <h4 class="col-4">Updated Date</h4>
                    <div class="col-sm-8 text-danger">
                        <h6>{{ $post->updated_at->format('Y/m/d')}}</h6>
                    </div>
                </div>
                <div class="mb-3 row">
                    <h4 class="col-4">Updated User</h4>
                    <div class="col-sm-8 text-danger">
                        <h6>{{ $post->updateuser->name}}</h6>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
