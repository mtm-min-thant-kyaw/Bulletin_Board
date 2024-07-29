@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-7 mx-auto border border-dark py-3 bg-success rounded-top">
        <div class="rounded-top">
            <h4>Upoad CSV File</h4>
        </div>
    </div>
        <div class="col-7 mx-auto bg-light">
            <form action="">
                <label for="">CSV File</label>
                <input type="file" name="" value="" class="form-control">
                <input type="submit" value="Upload"  class="btn btn-success my-2">
                <input type="submit" value="Cancel" class="btn btn-secondary my-2">
            </form>
        </div>

    </div>
@endsection
