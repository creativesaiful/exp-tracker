<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function CategoryList(){

        $category = Category::where('user_id', auth()->user()->id)->get();

        return view('pages.category_list' , compact('category'));
    }


    public function CategoryStore(Request $request){

        $validate = $request->validate([
            'category_name'=> 'required',
        ]);
        
         $category_name = $request->category_name;
         $user_id = auth()->user()->id;

         $category = new Category;
         $category->category_name = $category_name;
         $category->user_id = $user_id;
         $category->save();

         $success = [
            'type' => 'success',
            'message'=>'Category Added Successfully',
        ];

        return redirect()->route('categories')->with($success);
    }

    // Ajax for Edit Category
    public function EditCategory($id){

        $category = Category::find($id);

        return $category;
    }



    public function UpdateCategory(Request $request){
        $validate = $request->validate([
            'category_name'=> 'required',
            'category_id' => 'required',
        ]);

        $category_name = $request->category_name;
        $category_id = $request->category_id;

        $category = Category::find($category_id);
        $category->category_name = $category_name;
        $category->save();

        $success = [
            'type' => 'success',
            'message'=>'Category Updated Successfully',
        ];
        
        return redirect()->route('categories')->with($success);
    }


    //ajax for delete
    public function DeleteCategory($id){
        
       try {
            $category = Category::find($id);
            $category->delete();

            return response ()->json([
                'type' => 'success',
                'message'=>'Category Deleted Successfully',
            ]);

        } catch (\Throwable $th) {
            return response ()->json([
                'type' => 'error',
                'message'=>'Something went wrong',
            ]);
        }

      


    }
}
