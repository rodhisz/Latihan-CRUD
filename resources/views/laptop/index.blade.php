@extends('template')

@section('content')

<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand"><h2>Crud</h2></a>
        <form class="d-flex">
            <a href="{{route('laptop.create')}}" class="btn btn-success" type="submit">Create</a>
        </form>
    </div>
</nav>

<div class="container" style="margin-top: 50px">
    <table class="table table-bordered">
        <tr class="text-center">
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        @foreach ($laptops as $laptop )
        <tr class="text-center" style="vertical-align: 10px">
            <th>{{$i++}}</th>
            <td>{{$laptop->name}}</td>
            <td>Rp. {{number_format($laptop->price)}}</td>
            <td>
                <img src="{{url('storage/'.$laptop->image)}}" style="max-width: 100px !important" alt="">
            </td>
            <td>
                <form action="{{route('laptop.destroy', $laptop->id)}}" method="POST">
                <a href="{{route('laptop.edit', $laptop->id)}}" class="btn btn-warning" type="submit">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" href="{{route('laptop.destroy', $laptop->id)}}" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection
