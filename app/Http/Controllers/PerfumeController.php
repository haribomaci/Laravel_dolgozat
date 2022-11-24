<?php

namespace App\Http\Controllers;
use App\Models\Perfume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfumeController extends Controller
{
    public function insertPerfume(){
        DB::table("perfumes")->insert([
            ["name"=> "Hugo Boss", "type" => "ciprusos", "price"=>22],
            ["name"=> "Tom Tailor", "type" => "fás", "price"=>23],
            ["name"=> "Coco Shanel", "type" => "virágos", "price"=>26],
            ["name"=> "Dior", "type" => "gyümölcsös", "price"=>26],
            ["name"=> "Axe", "type" => "fahéjas", "price"=>26]
        ]);
        // echo "<h1>Adatok elmentve</h1>";
    }
    public function getPerfumes() {
        $perfumes = Perfume::all();
        return view( "/perfumes",[
            "perfumes" => $perfumes
        ] );
    }


    public function newPerfume() {

        return view( "new_perfume" );
    }

    public function storePerfume( Request $request ) {
        $formData = $request->validate([
            "name"=>"required",
            "type"=>"required",
            "price"=>"required",
        ]);
        $perfume = new Perfume;

        $perfume->name = $request->name;
        $perfume->type = $request->type;
        $perfume->price = (int)$request->price;

        $perfume->save();

        return redirect( "/perfumes" );
    }

    public function editPerfume( $id ) {

        $perfume = Perfume::find( $id );

        return view( "edit_perfume", [
            "perfume" => $perfume
        ]);
    }

    public function updatePerfume( Request $request ) {

        $perfume = Perfume::where("id",$request->id)->first();
        $perfume->name = $request->name;
        $perfume->type = $request->type;
        $perfume->price = $request->price;

        $parfume->save();
        return redirect("/perfumes");
    }

    public function deletePerfume( $id ) {

        $perfume = Perfume::find( $id );
        $perfume->delete();

        return redirect( "/perfumes" );
    }
    
}
