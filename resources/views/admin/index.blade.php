@extends('layouts.app')

@section('main')

<div class="container ">
  <h1></h1>
  @foreach($users as $user)
  
  <div class=" d-flex justify-content-between mt-4">
    <h3>Username: {{ $user->name}}</h3>
    <form method="POST" action="{{ url('admin/' . $user->id . '/removeuser') }}" class="d-inline">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-warning btn-sm">Remove User</button>
    </form>
  </div>
  @if($user->products->isEmpty())
  <div class="border text-primary  pt-2 text-center ">
  <p class="font-weight-bold display-5">No products available for this user.</p>
  </div>
  @else
    <table class="table table-hover mt-2 mb-4 border-bottom">
      <thead>
        <tr>
          <th>SN</th>
          <th>Name</th>
          <th>Price</th>
          <th>Image</th>
         <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php
 
        @endphp
       @foreach($user->products as $product )
        <tr>
          <td>{{ $loop->iteration}}</td>
          <td><a href="{{ url('admin/products/' . $product->id . '/show') }}" class="text-dark"> {{$product->name }} </a></td>
          <td>{{$product->price}}</td>
          <td>
            <img src="{{ asset('products/' . $product->image) }}" class="rounded-circle" width="50" height="50">
            
           
          </td>
          <td>
  
            <form method="POST" action="products/{{$product->id}}/delete" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>

          </td>

        </tr>
        @endforeach 
       
      </tbody>


    </table>
  @endif

    @endforeach
  

</div>
@endsection

