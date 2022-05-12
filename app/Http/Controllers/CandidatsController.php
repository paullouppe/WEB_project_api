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
}