<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {           
        $users =User::where('role','=','user')->with('products')->get();
        // foreach ($users as $user) {
        //     $user->products = $user->products()->paginate(5);
        // }
        
       
        
                return view('admin.index', compact('users'));
                
                
    }
   
    public function destroy($id)
    {

        $product = Product::where('id',$id)->first();
        $product->delete();
        return back()->withSuccess('Product deleted!!!!!');
    }
    public function show($id)
    {
        $product = Product::where('id',$id)->first();
       
        return view('products.show',['product'=>$product]);

    }

    
    public function removeUser($id)
    {
        //Find user by ID
        $user = User::findOrFail($id);

        // Delete associated products
        $user->products()->delete();

        // Delete the user
        $user->delete();


        return back()->withSuccess('User removed!!!!!');
       }
       public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('') ;

    }
}
