<!-- Modal -->
<div class="modal fade" id="detailModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">User Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('Storage/' . $user->profile) }}" alt="Profile Picture" class="img-thumbnail">
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Name</span>
                            <div class="col-sm-6">
                                <span>{{ $user->name }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Type</span>
                            <div class="col-sm-6">
                                <span>{{ $user->type == 0 ? 'Admin' : 'User' }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Email</span>
                            <div class="col-sm-6">
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Phone</span>
                            <div class="col-sm-6">
                                <span>{{ $user->phone }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Date of Birth</span>
                            <div class="col-sm-6">
                                <span>{{ $user->dob->format('Y/m/d') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Address</span>
                            <div class="col-sm-6">
                                <span>{{ $user->address }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Created Date</span>
                            <div class="col-sm-6">
                                <span>{{ $user->created_at->format('Y/m/d') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Created User</span>
                            <div class="col-sm-6">
                                <span>{{ $user->createUser->name }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Updated Date</span>
                            <div class="col-sm-6">
                                <span>{{ $user->updated_at->format('Y/m/d') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Updated User</span>
                            <div class="col-sm-6">
                                <span>{{ $user->updateUser->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
