<?php

namespace App\Http\Controllers;

use App\Elections;
use App\Candidat;
use App\Participe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ElectionsController extends Controller
{
    
    public function showAllElections()
    {
        return response()->json(Elections::all());
    }

    public function showOneElection($id)
    {  
        $election["election"] = DB::table('elections')->where('id', $id)->get();
        $election["candidats"] = DB::table('candidat')->select(array("candidat.id", "url", "score"))
            ->join('participe', 'candidat.id', '=', 'participe.idCandidat')
            ->join('elections', 'participe.idElection', '=', 'elections.id')
            ->where('elections.id', $id)
            ->get();
        return response()->json($election);
    }

    public function create(Request $request)
    {
        $fields = $request->all();
        $created_election = Elections::create(array_slice($fields, 0, 3));

        $candidats = $fields["candidat"];
        foreach ($candidats as $key => $value) {
            $created_candidats = Candidat::create($value);
            Participe::create(array("idElection" => $created_election["id"], "idCandidat" => $created_candidats["id"]));
        }

        return response()->json(array("created_election" => $created_election, "created_candidats" => $created_candidats), 201);
    }

    public function update($id, Request $request)
    {
        $election = Elections::findOrFail($id);
        $election->update($request->all());

        return response()->json($election, 200);
    }

    public function delete($id)
    {
        Elections::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}