@extends('layouts.app')
@section('main')
  <div class="container mt-5 border p-4 ">
    <h2>Add Product</h2>
    <form action="/products/store" method="POST" enctype="multipart/form-data" >
      @csrf
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control  @error('name')
        is-invalid
      @enderror " id="name" name="name"  value="{{ old('name')}}">
        @if($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name')}}</span>
        @endif
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" class="form-control  @error('price')
        is-invalid
      @enderror " id="price" name="price" value="{{ old('price')}}" >
        @if($errors->has('price'))
        <span class="text-danger">{{ $errors->first('price')}}</span>
        @endif
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control  @error('description')
        is-invalid
      @enderror " id="description" name="description" rows="3" >{{ old('description')}}</textarea>
        @if($errors->has('description'))
        <span class="text-danger">{{ $errors->first('description')}}</span>
        @endif
      </div>
      <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control-file  @error('image')
        is-invalid
      @enderror " id="image" name="image" accept="image/*" >
        @if($errors->has('image'))
        <span class="text-danger">{{ $errors->first('image')}}</span>
        @endif
      </div>
      <button type="submit" class="btn btn-dark">Submit</button>
    </form>
  </div>
@endsection