<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Employee;
use App;
use Illuminate\Support\Facades\Validator;

class OfficeController extends Controller
{
    public function __construct(){
        if (isset($_SESSION['locale'])){
            App::setLocale($_SESSION['locale']);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $offices = Office::paginate(5);
        // $officeList = Employee::select('officeCode')->distinct()->get();
        

        // $officeArr = array();

        // foreach($officeList as $item)
        //     $officeArr[] = $item->officeCode;

        // return view('admin.office.index', ['offices' => $offices, 
        //                                     "officeArray" => $officeArr]);
        return view('admin.office.new_index');
    }

    public function APIIndex(Request $request){
        $search = $request->search;
        $offset = $request->offset;
        $limit = $request->limit;

        $object['total'] = Office::count();
        $object['totalNotFiltered'] = Office::count();

        $offices = Office::where('officeCode','like',"%$search%")->limit($limit)->offset($offset)->get();

        $officeArray = Array();
        foreach($offices as $office)
            $officeArray[] = $office;

        $object['rows'] = $officeArray;

        return json_encode($object);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.office.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'officeCode' => 'required|max:10',
            'city' => 'required|max:50',
            'phone' => 'required|max:50',
            'addressLine1' => 'required|max:50',
            'country' => 'required|max:50',
            'postalCode' => 'required|max:15',
            'territory' => 'required|max:10',
        ],[
            'officeCode.required' => "Mã cửa hàng không được thiếu",
            'officeCode.max' => "Mã cửa hàng không được dài hơn :max ký tự",

            'city.required' => "Thành phố không được thiếu",
            'city.max' => "Thành phố không được dài hơn :max ký tự",

            'phone.required' => "Số điện thoại không được thiếu",
            'phone.max' => "Số điện thoại không được dài hơn :max ký tự",

            'addressLine1.required' => "Địa chỉ không được thiếu",
            'addressLine1.max' => "Địa chỉ không được dài hơn :max ký tự",

            'country.required' => "Quốc gia không được thiếu",
            'country.max' => "Quốc gia không được dài hơn :max ký tự",

            'postalCode.required' => "Mã bưu chính không được thiếu",
            'postalCode.max' => "Mã bưu chính không được dài hơn :max ký tự",

            'territory.required' => "Mã vùng không được thiếu",
            'territory.max' => "Mã vùng không được dài hơn :max ký tự",
        ]);

        if($validator->fails()){
            return redirect()->route('office.create')
                             ->withErrors($validator)
                             ->withInput();
        }
        
        $office = new Office();
        $office ->officeCode = $request ->officeCode ;
        $office ->city = $request ->city ;
        $office ->phone = $request ->phone ;
        $office ->addressLine1 = $request ->addressLine1 ;
        $office ->addressLine2 = $request ->addressLine2 ;
        $office ->state = $request ->state ;
        $office ->country = $request ->country ;
        $office ->postalCode = $request ->postalCode ;
        $office ->territory = $request ->territory ;
        
        $office->save();
        //lưu file ảnh
        $file = $request->file('avatar');
        $folder = public_path('image/offices');
        $file->move($folder, $request->officeCode.".jpg");

        return redirect()->route('office.index');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $office = Office::findOrFail($id);

        return view('admin.office.edit',['office' => $office]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $office = Office::findOrFail($id);

        $office ->officeCode = $request ->officeCode ;
        $office ->city = $request ->city ;
        $office ->phone = $request ->phone ;
        $office ->addressLine1 = $request ->addressLine1 ;
        $office ->addressLine2 = $request ->addressLine2 ;
        $office ->state = $request ->state ;
        $office ->country = $request ->country ;
        $office ->postalCode = $request ->postalCode ;
        $office ->territory = $request ->territory ;
        
        $office->save();
        //lưu file ảnh
        $file = $request->file('avatar');
        $folder = public_path('image/offices');
        $file->move($folder, $request->officeCode.".jpg");

        return redirect()->route('office.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $office = Office::findOrFail($id);
        $office->delete();

        return redirect()->route('office.index');
    }
}
