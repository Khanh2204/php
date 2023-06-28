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

<form action="{{route('office.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="officeCode">Mã cửa hàng</label>
    <input type="text" class="form-control" id="officeCode" name="officeCode" value="{{old('officeCode')}}">
  </div>
  <div class="form-group">
    <label for="avatar">Ảnh cửa hàng</label>
    <input type="file" class="form-control" id="avatar" name="avatar" value="{{old('avatar')}}">
  </div>
  <div class="form-group">
    <label for="phone">Điện thoại</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
  </div>
  <div class="form-group">
    <label for="addressLine1">Địa chỉ</label>
    <input type="text" class="form-control" id="addressLine1" name="addressLine1" value="{{old('addressLine1')}}">
  </div>
  <div class="form-group">
    <label for="addressLine2">Địa chỉ</label>
    <input type="text" class="form-control" id="addressLine2" name="addressLine2" value="{{old('addressLine2')}}">
  </div>
  <div class="form-group">
    <label for="city">Thành phố</label>
    <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">
  </div>
  <div class="form-group">
    <label for="state">Bang</label>
    <input type="text" class="form-control" id="state" name="state" value="{{old('state')}}">
  </div>
  <div class="form-group">
    <label for="territory">Vùng</label>
    <input type="text" class="form-control" id="territory" name="territory" value="{{old('territory')}}">
  </div>
  <div class="form-group">
    <label for="postalCode">Mã bưu chính</label>
    <input type="text" class="form-control" id="postalCode" name="postalCode" value="{{old('postalCode')}}">
  </div>
  <div class="form-group">
    <label for="country">Quốc gia</label>
    <input type="text" class="form-control" id="country" name="country" value="{{old('country')}}">
  </div>
  
  <button type="submit" class="btn btn-primary">Gửi</button>
  <button type="reset" class="btn btn-warning">Nhập lại</button>
  <a href="{{route('office.index')}}">
    <button type="button" class="btn btn-danger">Đóng</button>
  </a>
</form>
@endsection