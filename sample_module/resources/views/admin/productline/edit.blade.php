@extends('admin.master')

@section('Title')
Cửa hàng - Sửa
@endsection

@section('Content')
<form action="{{route('productLine.update',['productline' => $productLine->productLineCode])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div class="form-group">
    <label for="productLine">Mã cửa hàng</label>
    <input type="text" class="form-control" id="productLine" name="productLine" value="{{$productLine->productLine}}">
  </div>

  <div class="form-group">
    <label for="avatar">Ảnh cửa hàng</label>
        @if(file_exists(public_path('/image/productLines/'.$productLine->productLineCode.'.jpg')))
          <img src="{{'/image/productLines/'.$productLine->productLineCode.'.jpg'}}" width="100">
        @else
          <img src="{{'/image/No_Image.jpg'}}" width="100">
        @endif
    <input type="file" class="form-control" id="avatar" name="avatar" value="{{$productLine->avatar}}">
  </div>
  <div class="form-group">
      <label for="textDescription">Mô tả text</label>
      <textarea class="form-control" id="textDescription" name="textDescription" value="{{$productLine->textDescription}}">
    </div>

  <div class="form-group">
    <label for="htmlDescription">Mô tả html</label>
    <textarea class="form-control" id="htmlDescription" name="htmlDescription" value="{{$productLine->htmlDescription}}">
  </div>

  <button type="submit" class="btn btn-primary">Gửi</button>
  <button type="reset" class="btn btn-warning">Nhập lại</button>
  <a href="{{route('productLine.index')}}">
    <button type="button" class="btn btn-danger">Đóng</button>
  </a>
</form>
@endsection