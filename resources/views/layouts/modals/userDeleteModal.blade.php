<!-- Modal -->
<div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Confirm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3 class="text-danger">Are you sure to delete?</h3>
                <div class="row">

                    <div class="mb-3 row">
                        <h4 for="dob" class="col-sm-4">ID</h4>
                        <div class="col-sm-4">
                            <h4>{{ $user->id }}</h4>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <h4 for="dob" class="col-sm-4">Name</h4>
                        <div class="col-sm-4">
                            <h4>{{ $user->name }}</h4>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <h4 for="dob" class="col-sm-4">Email</h4>
                        <div class="col-sm-4">
                            <h4>{{ $user->email }}</h4>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <h4 for="dob" class="col-sm-4">Type</h4>
                        <div class="col-sm-4">
                            <h4>{{ $user->type == 0 ? 'Admin' : 'User' }}</h4>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <h4 for="dob" class="col-sm-4">Phone</h4>
                        <div class="col-sm-6">
                            <h4>{{ $user->phone }}</h4>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <h4 for="dob" class="col-sm-4">Date of Birth</h4>
                        <div class="col-sm-4">
                            <h4>{{ $user->dob->format('Y/m/d') }}</h4>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <h4 for="dob" class="col-sm-4">Address</h4>
                        <div class="col-sm-4">
                            <h4>{{ $user->address }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('user.delete', $user->id) }}" method="get">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
