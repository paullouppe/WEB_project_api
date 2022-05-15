<?php

namespace App\Http\Controllers;

use App\Elections;
use App\Candidat;
use App\Participe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CandidatsController extends Controller
{
    public function update($id, Request $request)
    {
        $candidat = Candidat::findOrFail($id);
        $candidat->update($request->all());
        
        return response()->json($candidat, 200);
    }

    public function create(Request $request){
        $fields = $request->all();
        $candidat = Candidat::create(array("url" => $fields["url"], "score" => 0));
        Participe::create(array("idElection" => $fields["id"], "idCandidat" => $candidat["id"]));
        return response()->json($candidat, 200);
    }

    public function show1Candidat($id){
        return response()->json(Candidat::find($id));
    }
}