@extends('admin.master')

@section('Title')
Cửa hàng
@endsection

@section('Content')
<a href="{{route('productline.create')}}">
    <button type="button" class="btn btn-primary">{{__('productline.new')}}</button>
</a>
<table class="table table-bordered">
    <tr>
        <th>{{__('productline.id')}}</th>
        <th>{{__('productline.image')}}</th>
        <th>{{__('productline.text.description')}}</th>
        <th>{{__('productline.html.description')}}</th>
        <th>{{__('productline.action')}}</th>
    </tr>

    @foreach($productlines as $productline)
    <tr>
        <td>{{$productline->productLine}}</td>
        <td>
            
                @if(file_exists(public_path('/image/productLines/'.$productLine->productLine.'.jpg')))
                    <img src="{{'/image/productLines/'.$productLine->productLine.'.jpg'}}" width="100">
                @else
                    <img src="{{'/image/No_Image.jpg'}}" width="100">
                @endif

            {{$productLine->productLine}}
        </td>
        <td>{{$productLine->textDescription}}</td>
        <td>{{$productLine->htmlDescription}}</td>
        <td>
            <a href="{{route('productLine.edit',['productLine'=>$productLine->productLine])}}">
                <button class="btn btn-primary">{{__('productLine.edit')}}</button>
            </a>

            <form action="{{route('productLine.destroy',['productLine'=>$productLine->productLine])}}" method="POST">
                @method('DELETE')
                @csrf
                <button 
                {{in_array($productLine->productLine, $productLineArray)?'disabled':""}}
                
                type="submit" class="btn btn-warning" onclick="return confirm('{{__('productLine.delete.confirm')}}')">{{__('productLine.delete')}}</button>
            </form>
        </td>
    </tr>

    @endforeach
</table>
@endsection