<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;

class OptionController extends Controller
{
    //
    public function index()
    {
        //
        $option = Option::first();

        return view('option.index',[
            'option' => $option
        ]);
    }

    public function store(Request $request)
    {
        //
        $id = $request->id;
        if(empty($id)) {
            Option::create([
                'value' => $request->value
            ]);
        } else {
            $option = Option::find($id);
            $option->value = $request->value;
            $option->save();
        }

        
        return redirect()->route('option.index')->withSuccess(__('Tax Successfully Updated.'));
    }

}
