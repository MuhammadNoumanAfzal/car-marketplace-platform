<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $values= Size::all();
        $data = [
             'heading'=>'Size',
            'title'=>'View Size',
            'active'=>'size',
            'values'=> $values
        ];
        return view('admin.size.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data =[
            'heading'=>'size',
            'title' => 'Enter Size',
            'active'=>'size'
        ];
        return view('admin.size.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        size::create(['size' => $request->size]);
        return redirect()->route('size.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $size = Size::find($id);
        $data=[
            'heading'=>'Size',
            'title'=>'Enter Size',
            'active'=>'size',
            'size'=>$size

        ];
        return view ('admin.size.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $size = Size::find($request->id);
        $size->update([
            'size' => $request ->size,
       ]);
       return redirect()->route('size,index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $size = Size::find($id);
        $size->delete();
        return redirect()->back();
    }
}
