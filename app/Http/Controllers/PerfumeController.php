<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfume;

class PerfumeController extends Controller
{
    public function getPerfumes() {

        $pefumes = Perfume::all();

        return view ("/perfumes");
    }

    public function newPerfume() {
        
        return view ("new_perfume");
    }

    public function storePerfume (Request $request) {
        $perfume = new Perfume;

        $perfume->name = $request->name;
        $perfume->type = $request->type;
        $perfume->price = (int)$request->price;

        $perfume->save();

        return redirect("/new-perfume");
    }

    public function editPerfume($id) {

        $perfume = Perfume::find($id);

        return view ("edit_perfume", [
            "perfume" => $perfume
        ]);
    }

    public function updatePerfume (Request $request) {

        $id = $request->id;
        $id = $request->name;
        $id = $request->type;
        $id = $request->price;
        
        
        $request->validate([
            "name" => "required",
            "type" => "required",
            "price" => "required",
        ]);

        Perfume::where("id", "=", $id)->update([
            "name"=>$name,
            "type"=>$type,
            "price"=>$price
        ]);

        return redirect()->back()->with("Sikeres hozzáadás");
    }

    public function deletePerfume ($id) {

        $perfume = Perfume::find($id);
        $perfume->delete();

        return redirect()->back()->with("Sikeres törlés");
    }
}
