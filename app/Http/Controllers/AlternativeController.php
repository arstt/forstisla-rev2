<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\AlternativeScore;
use App\Models\Bobot;
use App\Models\Kriteria;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use App\Traits\Multitenantable;

class AlternativeController extends Controller
{

    use Multitenantable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = AlternativeScore::select(
            'alternative_scores.id as id',
            'alternatives.id as ida',
            'kriterias.id as idw',
            'bobots.id as idr',
            'alternatives.nasabah_id as nama',
            'kriterias.nama as kriteria',
            'bobots.bobot as bobot',
            'bobots.deskripsi as deskripsi'
        )
            ->leftJoin('alternatives', 'alternatives.id', '=', 'alternative_scores.alternative_id')
            ->leftJoin('kriterias', 'kriterias.id', '=', 'alternative_scores.kriteria_id')
            ->leftJoin('bobots', 'bobots.id', '=', 'alternative_scores.bobot_id')
            ->get();

        $alternatives = Alternative::all();
        $nasabahs = Nasabah::get();
        $kriterias = Kriteria::get();
        return view('alternative.index', compact('nasabahs', 'scores', 'alternatives', 'kriterias'))->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nasabahs = Nasabah::get();
        $kriterias = Kriteria::get();
        $bobots = Bobot::get();
        return view('alternative.create', compact('nasabahs', 'kriterias', 'bobots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'nasabah_id' => 'required',
            'nilai_jaminan' => 'required',
            'nilai_pendapatan' => 'required',
        ]);

        //Save the alternative
        $alt = Alternative::create([
            'nasabah_id' => $request->nasabah_id,
            'nilai_jaminan' => str_replace(',', '', $request->nilai_jaminan),
            'nilai_pendapatan' => str_replace(',', '', $request->nilai_pendapatan),
        ]);

        //save nilai Jaminan
        //$nj = new Alternative;
        //$nj->nilai_jaminan = $request->nilai_jaminan;
        //$nj->save();

        //save nilai Jaminan
        // $np = new Alternative;
        // $np->nilai_pendapatan = $request->nilai_pendapatan;
        // $np->save();

        // Save the score
        $kriterias = Kriteria::get();
        foreach ($kriterias as $kriteria) {
            $score = new AlternativeScore();
            $score->alternative_id = $alt->id;
            $score->kriteria_id = $kriteria->id;
            $score->bobot_id = $request->input('kriteria')[$kriteria->id];
            $score->save();
        }

        return redirect()->route('alternatives.index')
            ->with('success', 'Berhasih membuat analisa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternative $alternative)
    {
        $nasabahs = Nasabah::get();
        $kriterias = Kriteria::get();
        $bobots = Bobot::get();
        $alternativescores = AlternativeScore::where('alternative_id', $alternative->id)->get();
        return view('alternative.edit', compact('nasabahs', 'alternative', 'alternativescores', 'kriterias', 'bobots'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alternative $alternative)
    {
        $scores = AlternativeScore::where('alternative_id', $alternative->id)->get();
        $alternative->nilai_jaminan = str_replace(',', '', $request->nilai_jaminan);
        $alternative->nilai_pendapatan = str_replace(',', '', $request->nilai_pendapatan);
        $alternative->save();
        $kriterias = Kriteria::get();
        foreach ($kriterias as $key => $kriteria) {
            $scores[$key]->bobot_id = $request->input('kriteria')[$kriteria->id];
            $scores[$key]->save();
        }

        return redirect()->route('alternatives.index')
            ->with('success', 'Analisa berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternative $alternative)
    {
        $scores = AlternativeScore::where('alternative_id', $alternative->id)->delete();
        $alternative->delete();

        return response()->json('Success');
    }
}
