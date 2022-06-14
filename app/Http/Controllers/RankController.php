<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\AlternativeScore;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index()
    {
        $scores = AlternativeScore::select(
            'alternative_scores.id as id',
            'alternatives.id as ida',
            'kriterias.id as idw',
            'bobots.id as idr',
            // 'alternatives.nama_nasabah as name',
            'kriterias.nama as kriteria',
            'bobots.bobot as bobot',
            'bobots.deskripsi as deskripsi'
        )
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
            // 'alternatives.nama_nasabah as name',
            'kriterias.nama as kriteria',
            'bobots.bobot as bobot',
            'bobots.deskripsi as deskripsi'
        )
            ->leftJoin('alternatives', 'alternatives.id', '=', 'alternative_scores.alternative_id')
            ->leftJoin('kriterias', 'kriterias.id', '=', 'alternative_scores.kriteria_id')
            ->leftJoin('bobots', 'bobots.id', '=', 'alternative_scores.bobot_id')
            ->get();



        $alternatives = Alternative::get();

        $kriterias = Kriteria::get();

        // dd($cscores);

        // Normalization
        foreach ($alternatives as $alternative) {
            // Get all scores for each alternative id
            $alternativefilter = $scores->where('ida', $alternative->id)->values()->all();
            // Loop each criteria
            foreach ($kriterias as $indexkriteria => $kriteria) {
                // Get all rating value for each criteria
                $rates = $cscores->map(function ($val) use ($kriteria) {
                    if ($kriteria->id == $val->idw) {
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
                $result *= $kriteria->bobot;
                $alternativefilter[$indexkriteria]->bobot = round($result, 2);
            }
        }

        return view('rank', compact('scores', 'alternatives', 'kriterias'))->with('i', 0);
    }

    public function rendah($rendah_id){



    }

    public function cukup($cukup_id){

    }

    public function tinggi($tinggi_id){

    }

    public function show($id)
    {
        $alter = Alternative::find($id);
        $kriterias = Kriteria::with('bobots')->get();
        $cscores = AlternativeScore::select(
            'alternative_scores.id as id',
            'alternatives.id as ida',
            'kriterias.id as idw',
            'bobots.id as idr',
            // 'alternatives.nama_nasabah as name',
            'kriterias.nama as kriteria',
            'bobots.bobot as bobot',
            'bobots.deskripsi as deskripsi'
        )
            ->leftJoin('alternatives', 'alternatives.id', '=', 'alternative_scores.alternative_id')
            ->leftJoin('kriterias', 'kriterias.id', '=', 'alternative_scores.kriteria_id')
            ->leftJoin('bobots', 'bobots.id', '=', 'alternative_scores.bobot_id')
            ->where('alternatives.id', $id)
            ->get();
        $bobot = [];
        foreach ($kriterias as $indexkriteria => $kriteria) {
            // Get all rating value for each criteria
            $bobot[] = $cscores->filter(function ($val) use ($kriteria) {
                // if ($kriteria->id == $val->idw) {
                //     return $val->bobot;
                // }
                return $kriteria->id == $val->idw;
            });
        }
        // dd($bobot);
        $nj = $alter->nilai_jaminan;
        $np = $alter->nilai_pendapatan;
        $residu = $nj / 5;
        $pendapatan = $np / 3;
        $limit = [
            '12bulan' => $nj + ($pendapatan * 12),
            '24bulan' => ($nj - $residu) + ($pendapatan * 24),
            '36bulan' => ($nj - ($residu * 2)) + ($pendapatan * 36),
            '48bulan' => ($nj - ($residu * 3)) + ($pendapatan * 48),
            '60bulan' => ($nj - ($residu * 4)) + ($pendapatan * 60),
        ];
        return response()->json([
            'bobot' => $bobot,
            'limit' => $limit
        ]);
    }
}
