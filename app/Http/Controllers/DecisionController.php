<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\AlternativeScore;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class DecisionController extends Controller
{
    public function index()
    {
        $scores = AlternativeScore::select(
            'alternative_scores.id as id',
            'alternatives.id as ida',
            'kriterias.id as idw',
            'bobots.id as idr',
            'alternatives.nama_nasabah as name',
            'kriterias.nama as kriteria',
            'bobots.bobot as bobot',
            'bobots.deskripsi as deskripsi')
        ->leftJoin('alternatives', 'alternatives.id', '=', 'alternative_scores.alternative_id')
        ->leftJoin('kriterias', 'kriterias.id', '=', 'alternative_scores.kriteria_id')
        ->leftJoin('bobots', 'bobots.id', '=', 'alternative_scores.bobot_id')
        ->get();

        $alternatives = Alternative::get();

        $kriterias = Kriteria::get();

        return view('decision', compact('scores', 'alternatives', 'kriterias'))->with('i', 0);

    }
}
