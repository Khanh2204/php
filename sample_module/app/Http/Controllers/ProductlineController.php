<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productline;
use App\Models\Employee;
use App;
use Illuminate\Support\Facades\Validator;

class ProductlineController extends Controller
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
        $productLines = Productline::all();
        $productLineList = Employee::select('productLine')->distinct()->get();

        $productLineArr = array();

        foreach($productLineList as $item)
            $productLineArr[] = $item->productLine;

        return view('admin.productLine.index', ['productLines' => $productLines, 
                                            "productLineArray" => $productLineArr]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.productLine.new');
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
            'productLine' => 'required|max:10',
            
        ],[
            'productLine.required' => "Mã danh mục không được thiếu",
            'productLine.max' => "Mã danh mục không được dài hơn :max ký tự",

            
        ]);

        if($validator->fails()){
            return redirect()->route('productLine.create')
                             ->withErrors($validator)
                             ->withInput();
        }
        
        $productLine = new Productline();
        $productLine ->productLine = $request ->productLine ;
        $productLine ->textDescription = $request ->textDescription;
        $productLine ->htmlDescription= $request ->htmlDescription;
        
        
        $productLine->save();
        //lưu file ảnh
        $file = $request->file('avatar');
        $folder = public_path('image/productLines');
        $file->move($folder, $request->productLine.".jpg");

        return redirect()->route('productLine.index');
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
        $productline = Productline::findOrFail($id);

        return view('admin.productLine.edit',['productLine' => $productLine]);
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
        $productLine = Productline::findOrFail($id);

        $productLine ->productLine = $request ->productLine ;
        $productLine ->textDescription = $request ->textDescription;
        $productLine ->htmlDescription= $request ->htmlDescription;
        
        $productLine->save();
        //lưu file ảnh
        $file = $request->file('avatar');
        $folder = public_path('image/productLines');
        $file->move($folder, $request->productLine.".jpg");

        return redirect()->route('productLine.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productLine = Productline::findOrFail($id);
        $productLine->delete();

        return redirect()->route('productLine.index');
    }
}
