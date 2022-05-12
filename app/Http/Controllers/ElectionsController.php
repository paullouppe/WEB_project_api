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
        $election["candidats"] = DB::table('candidats')->select(array("candidats.id", "url", "score"))
            ->join('participes', 'candidats.id', '=', 'participes.idCandidat')
            ->join('elections', 'participes.idElection', '=', 'elections.id')
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

        return response()->json(array($created_election), 201);
    }

    public function update($id, Request $request)
    {
        $election = Elections::findOrFail($id);
        
        $election->update($request->all());

        return response()->json($election, 200);
    }
    public function updateCandidat($id, Request $request)
    {
        $candidat = Candidats::findOrFail($id);
        $candidat->update($request->all());
        
        return response()->json($candidat, 200);
    }

    public function delete($id)
    {
        Elections::findOrFail($id)->delete();
        //on récupere les participe qui vont être supprimés
        $res = DB::table('participes')->where('idElection', $id)->get(); 
        $res = $res->all();
        foreach ($res as $key => $value) {
            DB::table('participes')->where('idElection', $id)->delete();
            //magie pour décoder la valeur
            $candidats = json_decode(json_encode($value), true);
            DB::table('candidats')->where('id', $candidats['idCandidat'])->delete();
        }
        return response('Deleted Successfully', 200);
    }
}