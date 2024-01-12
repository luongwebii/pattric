<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    //
    public function index(){

        $menus = Menu::where('parent_id', '=', 0)->orderBy('icon', 'ASC')->get();

        $allMenus = Menu::pluck('title','id')->all();
      
        return view('menu.menuTreeview',compact('menus','allMenus'));

    }


    public function store(Request $request)

    {

        $request->validate([

           'title' => 'required',
          

        ]);

        $input = $request->all();
      
        if(empty($input['id'])) {
           // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
          
           // Menu::create($input);
            $menu = new Menu();
            $menu->title = $input['title'];
            $menu->url = $input['url'];
            $menu->icon = $input['icon'];
            $menu->parent_id = empty($input['parent_id']) ? 0 : $input['parent_id'];
            $menu->save();

      

         
            return back()->with('success', 'Menu added successfully.');
    
        } else {
            $menu = Menu::find($input['id']);
            $menu->title = $input['title'];
            $menu->url = $input['url'];
            $menu->icon = $input['icon'];
            $menu->parent_id = empty($input['parent_id']) ? 0 : $input['parent_id'];
            $menu->save();
         
            return back()->with('success', 'Menu updated successfully.');
    
        }
        
    }


    public function show()

    {

        $menus = Menu::where('parent_id', '=', 0)->get();
        return view('menu.dynamicMenu',compact('menus'));

    }

    public function destroy(Request $request)
    {
        $input = $request->all();
        if(empty($input['id'])) {
           
    
            return response()->json(['error' => 'Menu not found'],200);
    
        } else {
            Menu::where('parent_id', '=', $input['id'])->delete(); 
            Menu::find($input['id'])->delete(); 
         
            return response()->json(['success' => 'Successfully delete the Menu'],200);
    
        }
    }
}
