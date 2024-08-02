<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Bulletin Board OJT</title>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to delete?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="" enctype="multipart/form-data">
                                @csrf
                                <label for="" class="form-control">Name:</label>
                                <label for="" class="form-control">Emial:</label>
                                <label for="" class="form-control">Phone:</label>
                                <label for="" class="form-control">Address</label>
                                <label for="" class="form-control">Type:</label>
                                <label for="" class="form-control">Created_User:</label>
                                <label for="" class="form-control">Created_at:</label>
                                <label for="" class="form-control">Update User:</label>
                                <label for="" class="form-control">Updated_at:</label>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-danger">Delete</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Bootstrap Js Link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</html>
