<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
// use DataTables
class CategoryController extends Controller
{
    public function index(){
        $category = Category::where('deleted_at',null)->orderBy('created_at','DESC');
        return view('category.index', compact('category'));
    }
    public function store(Request $request){
        $data = Category::where('deleted_at',null)->get();
        if(!$request->all())
            return view('category.index');
        else{
            $insert = $request->validate([
                'name' => 'required'
            ]);
            $insert = Category::create($request->all());
            if($insert)
                return redirect(route('main-category'))->with('success', 'Successfully saved new category data');
            return redirect(route('main-category'))->with('failed', 'Failed to save new category data');
        }

    }
    public function categoryDatatable(){
        $data = Category::where('deleted_at',null)->orderBy('created_at','DESC')->get();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            $delete_link = "'".url('category-delete/'.$data['id'])."'";
            $delete_message = "'This cannot be undo'";
            $edit_link = "'".url(''.$data['id'].'/category-edit')."'";

            $edit = '<button  key="'.$data['id'].'"  class="btn btn-info p-1 text-white" data-toggle="modal" data-target="#editCategory" onclick="editCategory('.$edit_link.')"> <i class="fa fa-edit"> </i> </button>';
            $delete = '<button onclick="confirm_me('.$delete_message.','.$delete_link.')" class="btn btn-danger p-1 text-white"> <i class="fa fa-trash"> </i> </button>';
            return $edit.' '.$delete;
        })
        ->addColumn('created_at', function($data){
            return Carbon::parse($data['created_at'])->format('F d, y');
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function categoryEdit($id){
        $data = Category::find($id);
        return view('category.ajax-category', compact('data'));
    }
    public function categoryEditExecute(Request $request){
        $data = $request->validate([
            'name' => 'required|max:30|min:2,'
        ]);
        $data = Category::find($request->id);
        $data->name = $request->name;
        $data->description = $request->description;
        if($data->save())
            return redirect(route('main-category'))->with('success','successfully changed data category ' .$data['name']);
        return redirect(route('main-category'))->with('failed','failed to change data category' .$data['name']);
    }
    public function categoryDelete($id){
        $data = Category::find($id);
        if($data->delete())
            return redirect(route('main-category'))->with('success','Success delete category');
        return redirect(route('main-category'))->with('failed','Failed delete category');
    }
}
