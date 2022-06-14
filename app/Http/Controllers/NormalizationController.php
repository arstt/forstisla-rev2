<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\AlternativeScore;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class NormalizationController extends Controller
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

        // duplicate scores object to get rating value later,
        // because any call to $scores object is pass by reference
        // clone, replica, tobase didnt work
        $cscores = AlternativeScore::select(
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

        // Normalization
        foreach($alternatives as $alternative){
            // Get all scores for each alternative id
            $alternativefilter = $scores->where('ida', $alternative->id)->values()->all();
            // Loop each criteria
            foreach($kriterias as $indexkriteria => $kriteria){
                // Get all rating value for each criteria
                $rates = $cscores->map(function($val) use ($kriteria){
                    if($kriteria->id == $val->idw ){
                        return $val->bobot;
                    }
                })->toArray();

                // array_filter for removing null value caused by map,
                // array_values for reiindex the array
                $rates = array_values(array_filter($rates));

                if ($kriteria->tipe == 'benefit') {
                    $result = $alternativefilter[$indexkriteria]->bobot / max($rates);
                    $msg = 'rate ' . $alternativefilter[$indexkriteria]->bobot . ' max ' . max($rates) . ' res ' . $result;
                } elseif ($kriteria->tipe == 'cost') {
                    $result = min($rates) / $alternativefilter[$indexkriteria]->bobot;
                }
                $alternativefilter[$indexkriteria]->bobot = round($result, 2);
            }
        }

        return view('normalization', compact('scores', 'alternatives', 'kriterias'))->with('i', 0);
    }
}
