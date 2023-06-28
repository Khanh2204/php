@extends('admin.master')

@section('Title')
Cửa hàng - Thêm mới
@endsection

@section('Content')
@if($errors)
<div style="color:red; background-color:wheat;">
  <ul>
    @foreach($errors->all() as $message)
    <li>{{$message}}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{route('productLine.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="productLine">Mã danh mục</label>
    <input type="text" class="form-control" id="productLine" name="productLine" value="{{old('productLine')}}">
  </div>
  <div class="form-group">
    <label for="avatar">Ảnh danh mục</label>
    <input type="file" class="form-control" id="avatar" name="avatar" value="{{old('avatar')}}">
  </div>
  <div class="form-group">
    <label for="textdescription">Mô tả text</label>
    <textarea class="form-control" id="textdescription" name="textdescription" value="{{old('textdescription')}}">
  </div>
  <div class="form-group">
    <label for="htmldescription">Mô tả html</label>
    <textarea class="form-control" id="htmldescription" name="htmldescription" value="{{old('htmldescription')}}">
  </div>
  
  <button type="submit" class="btn btn-primary">Gửi</button>
  <button type="reset" class="btn btn-warning">Nhập lại</button>
  <a href="{{route('productLine.index')}}">
    <button type="button" class="btn btn-danger">Đóng</button>
  </a>
</form>
@endsection