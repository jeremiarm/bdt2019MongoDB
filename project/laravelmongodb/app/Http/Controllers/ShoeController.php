<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Shoe;

class ShoeController extends Controller
{
    public function index()
    {
        $shoes=Shoe::paginate(10);
        return view('shoeindex',compact('shoes'));
    }
    public function count()
    {
    	$total = Shoe::count();
        dd($total);
    }
    public function index2()
    {
        $shoes=Shoe::where('SubCategory', 'like', 'HEEL')->paginate(10);
        return view('shoeindex',compact('shoes'));
    }
    public function create()
    {
        return view('shoecreate');
    }
    public function store(Request $request)
    {

        $shoe = new Shoe();
        $shoe->CID = $request->get('CID');
        $shoe->Category = $request->get('Category');
        $shoe->SubCategory = $request->get('SubCategory');
        $shoe->HeelHeight = $request->get('HeelHeight');
        $shoe->Insole = $request->get('Insole');
        $shoe->Closure = $request->get('Closure');
        $shoe->Gender = $request->get('Gender');
        $shoe->Material = $request->get('Material');
        $shoe->ToeStyle = $request->get('ToeStyle');
        $shoe->save();
        return redirect('shoe')->with('success', 'Shoe has been successfully added');
        
    }
    public function destroy($_id)
    {
        $shoe = Shoe::find($_id);
        $shoe->delete();
        $message=sprintf("Shoe %s has been successfully deleted",$_id);
        return redirect('shoe')->with('success', $message);
    }
    public function edit($_id)
    {
        $shoe = Shoe::find($_id);
        return view('shoeedit',compact('shoe','_id'));
    }
    public function update(Request $request, $_id)
    {
        $shoe= Shoe::find($_id);
        $shoe->CID = $request->get('CID');
        $shoe->Category = $request->get('Category');
        $shoe->SubCategory = $request->get('SubCategory');
        $shoe->HeelHeight = $request->get('HeelHeight');
        $shoe->Insole = $request->get('Insole');
        $shoe->Closure = $request->get('Closure');
        $shoe->Gender = $request->get('Gender');
        $shoe->Material = $request->get('Material');
        $shoe->ToeStyle = $request->get('ToeStyle');
        //dd(DB::connection('mongodb')); 
        $shoe->save();
        $message=sprintf("Shoe %s has been successfully updated",$_id);
        return redirect('shoe')->with('success', $message);
    }
}
