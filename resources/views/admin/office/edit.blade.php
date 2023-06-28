@extends('admin.master')

@section('Title')
Cửa hàng - Sửa
@endsection

@section('Content')
<form action="{{route('office.update',['office' => $office->officeCode])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div class="form-group">
    <label for="officeCode">Mã cửa hàng</label>
    <input type="text" class="form-control" id="officeCode" name="officeCode" value="{{$office->officeCode}}">
  </div>

  <div class="form-group">
    <label for="avatar">Ảnh cửa hàng</label>
        @if(file_exists(public_path('/image/offices/'.$office->officeCode.'.jpg')))
          <img src="{{'/image/offices/'.$office->officeCode.'.jpg'}}" width="100">
        @else
          <img src="{{'/image/No_Image.jpg'}}" width="100">
        @endif
    <input type="file" class="form-control" id="avatar" name="avatar" value="{{$office->avatar}}">
  </div>

  <div class="form-group">
    <label for="phone">Điện thoại</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{$office->phone}}">
  </div>

  <div class="form-group">
    <label for="addressLine1">Địa chỉ</label>
    <input type="text" class="form-control" id="addressLine1" name="addressLine1" value="{{$office->addressLine1}}">
  </div>

  <div class="form-group">
    <label for="addressLine2">Địa chỉ</label>
    <input type="text" class="form-control" id="addressLine2" name="addressLine2" value="{{$office->addressLine2}}">
  </div>

  <div class="form-group">
    <label for="city">Thành phố</label>
    <input type="text" class="form-control" id="city" name="city" value="{{$office->city}}">
  </div>

  <div class="form-group">
    <label for="state">Bang</label>
    <input type="text" class="form-control" id="state" name="state" value="{{$office->state}}">
  </div>

  <div class="form-group">
    <label for="territory">Vùng</label>
    <input type="text" class="form-control" id="territory" name="territory" value="{{$office->territory}}">
  </div>

  <div class="form-group">
    <label for="postalCode">Mã bưu chính</label>
    <input type="text" class="form-control" id="postalCode" name="postalCode" value="{{$office->postalCode}}">
  </div>
  
  <div class="form-group">
    <label for="country">Quốc gia</label>
    <input type="text" class="form-control" id="country" name="country" value="{{$office->country}}">
  </div>
  
  <button type="submit" class="btn btn-primary">Gửi</button>
  <button type="reset" class="btn btn-warning">Nhập lại</button>
  <a href="{{route('office.index')}}">
    <button type="button" class="btn btn-danger">Đóng</button>
  </a>
</form>
@endsection