@extends('template')

@section('content')

<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand">Edit</a>
        <form class="d-flex">
            <a href="{{route('laptop.index')}}" class="btn btn-success" type="submit">Back</a>
        </form>
    </div>
</nav>

<div class="container">
    <h1>Edit Post</h1>
</div>


<form class="container" action="{{route('laptop.update', $laptop->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" value="{{$laptop->name}}" type="text" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input name="price" value="{{$laptop->price}}" type="text" class="form-control" id="price">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input name="image" type="file" id="Content" class="form-control" id="image">
        </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection

