@extends('admin.master')

@section('Title')
Cửa hàng
@endsection

@section('Content')
<a href="{{route('office.create')}}">
    <button type="button" class="btn btn-primary">{{__('office.new')}}</button>
</a>
<table class="table table-bordered">
    <tr>
        <th>{{__('office.id')}}</th>
        <th>{{__('office.image')}}</th>
        <th>{{__('office.phone')}}</th>
        <th>{{__('office.address')}}</th>
        <th>{{__('office.country')}}</th>
        <th>{{__('office.postalCode')}}</th>
        <th>{{__('office.action')}}</th>
    </tr>

    @foreach($offices as $office)
    <tr>
        <td>{{$office->officeCode}}</td>
        <td>
            
                @if(file_exists(public_path('/image/offices/'.$office->officeCode.'.jpg')))
                    <img src="{{'/image/offices/'.$office->officeCode.'.jpg'}}" width="100">
                @else
                    <img src="{{'/image/No_Image.jpg'}}" width="100">
                @endif

            {{$office->officeCode}}
        </td>
        <td>{{$office->phone}}</td>
        <td>{{$office->addressLine1}}{{$office->addressLine2}}</td>
        <td>{{$office->country}}</td>
        <td>{{$office->postalCode}}</td>
        <td>
            <a href="{{route('office.edit',['office'=>$office->officeCode])}}">
                <button class="btn btn-primary">{{__('office.edit')}}</button>
            </a>

            <form action="{{route('office.destroy',['office'=>$office->officeCode])}}" method="POST">
                @method('DELETE')
                @csrf
                <button 
                {{in_array($office->officeCode, $officeArray)?'disabled':""}}
                
                type="submit" class="btn btn-warning" onclick="return confirm('{{__('office.delete.confirm')}}')">{{__('office.delete')}}</button>
            </form>
        </td>
    </tr>

    @endforeach
</table>
<style>
    svg{
        width:20px;
    }
    .flex.justify-between.flex-1.sm\:hidden {
        display: none;
    }
</style>
{{$offices->links()}}

@endsection