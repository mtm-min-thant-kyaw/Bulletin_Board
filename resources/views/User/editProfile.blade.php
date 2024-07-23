@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-8 bg-success rounded  mx-auto">
        <h3 class="">Profile</h3>
    </div>
    <div class="col-6 bg-light mx-auto my-2 border border-dark py-3">
       <form action="">
        <label for="">Name</label>
        <input type="text" name="" value="" class="form-control">
        <label for="">Email</label>
        <input type="email" name="" value="" class="form-control">
        <label for="">Phone</label>
        <input type="text" name="" value="" class="form-control">
        <label for="">Address</label>
        <input type="text" name="" value="" class="form-control">
        <label for="">DOB</label>
        <input type="date" name="" value="" class="form-control">
        <label for="">Type</label>
       <select name="" class="form-control">
        <option value="">Admin</option>
        <option value="">User</option>
       </select>
       <img src="" alt="old Image">
       <input type="file" class="form-control">
       <button type="submit" class="btn btn-success">Edit</button>
       <button type="button" class="btn btn-primary">Clear</button>
       <a href="">Change Password?</a>
       </form>
</div>
@endsection

