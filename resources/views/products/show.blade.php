@extends('layouts.app')
@section('main')
<div class="container">
 <div class="row justify-content-center ">
<div class="col-sm-8 mt-4">
  <div class="card  p-4">
  <h3>{{ $product->name}}</h3>
  <p>{{$product->description}}</p>
   
    <img src="/products/{{$product->image}}" class="rounded" />
 
  </div>
  </div>
 </div>
</div>
@endsection
