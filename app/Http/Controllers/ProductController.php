<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
class ProductController extends Controller
{
    public function index(){
        $category = Category::where('deleted_at',null)->get();
        return view('products.index', compact('category'));
    }
    public function store(Request $request){
        $insert = $request->validate([
            // 'code' => 'required|string|max:10|unique:products',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            // 'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        if($request->hasFile('photo'))
        {
            $code = $request->code;
            $name = $request->name;
            $description = $request->description;
            $stock = $request->stock;
            $price = $request->price;
            $category_id = $request->category_id;
            $file = $request->photo;
            $extension = time().'.'.$file->extension();
            $file->move(public_path('product'),$extension);
            $insert = new Product();
            $insert->code = $code;
            $insert->name = $name;
            $insert->description = $description;
            $insert->stock = $stock;
            $insert->price = $price;
            $insert->category_id = $category_id;
            $insert->photo = asset('product/'.$extension);
            if($insert->save())
                return redirect(route('products'))->with('success', 'Successfully saved new products data');
            return redirect(route('products'))->with('failed', 'Failed to save new products data');
        }

    }
    public function productsDatatable(){
        $data = Product::where('deleted_at',null)->orderBy('created_at','DESC')->get();

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            $delete_link = "'".url('products-dalete/'.$data['id'])."'";
            $delete_message = "'This cannot be undo'";
            $edit_link = "'".url(''.$data['id'].'/products-edit')."'";

            $edit = '<button  key="'.$data['id'].'"  class="btn btn-info p-1 text-white" data-toggle="modal" data-target="#editProducts" onclick="editProducts('.$edit_link.')"> <i class="fa fa-edit"> </i> </button>';
            $delete = '<button onclick="confirm_me('.$delete_message.','.$delete_link.')" class="btn btn-danger p-1 text-white"> <i class="fa fa-trash"> </i> </button>';
            return $edit.' '.$delete;
        })
        ->addColumn('photo',function($data){
            return '<img src= "'.$data['photo'].'" style= width="50px" height="50px">';
        })
        ->addColumn('category_id',function($data){
            return $data->category_relation['name'];
        })
        ->addColumn('update_at', function($data){
            return Carbon::parse($data['created_at'])->format('F d, y');
        })
        ->rawColumns(['action','photo'])
        ->make(true);
    }
    public function prodcutsEdit($id){
        $data = Product::find($id);
        return view('products.ajax-products', compact('data'));
    }
    public function prodcutsEditExecute(Request $request){
        $data = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        $data = Product::find($request->id);
        if($request->hasFile('photo')){
            $file = $request->photo;
            $extension = time().'.'.$file->extension();
            $file->move(public_path('product'),$extension);
            $data->photo = asset('product/'.$extension);
        }
        $data->code = $request->code;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->stock = $request->stock;
        $data->price = $request->price;
        if($data->save())
            return redirect(route('products'))->with('success', 'Successfully updated new products data ' .$data['name']);
        return redirect(route('products'))->with('failed', 'Gagal menghapus' .$data['name']);
    }
    public function productsDelete($id){
        $data = Product::find($id);
        if($data->delete())
            return redirect(route('products'))->with('success', 'Successfully deleted  products data');
        return redirect(route('products'))->with('failed', 'Failed to deleted products data');

    }
}
