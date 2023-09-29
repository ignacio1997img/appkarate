<?php

namespace App\Http\Controllers;

use App\Models\Referee;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TournamentController extends Controller
{
    public function index()
    {
        return view('tournament.browse');
    }

    public function list($search = null){
        $paginate = request('paginate') ?? 10;
        $data = Tournament::
            where(function($query) use ($search){
                $query->OrWhereRaw($search ? "id = '$search'" : 1)
                ->OrWhereRaw($search ? "name like '%$search%'" : 1)
                ->OrWhereRaw($search ? "description like '%$search%'" : 1);
                // ->OrWhereRaw($search ? "CONCAT(first_name, ' ', last_name1, ' ', last_name2) like '%$search%'" : 1)
            })
            ->where('deleted_at', NULL)->orderBy('id', 'DESC')->paginate($paginate);
        // dump($data);
        return view('tournament.list', compact('data'));
    }


    public function indexReferee($tournament)
    {
        $referee = Tournament::where('id', $tournament)->where('deleted_at', null)->first();
        // return $referee;
        return view('referee.browse', compact('referee'));
    }

    public function listArbitro($tournament, $search = null){
        // dump(1);
        $paginate = request('paginate') ?? 10;
        $data = Referee::
            where(function($query) use ($search){
                $query->OrWhereRaw($search ? "id = '$search'" : 1)
                ->OrWhereRaw($search ? "ci like '%$search%'" : 1)
                ->OrWhereRaw($search ? "age like '%$search%'" : 1)
                ->OrWhereRaw($search ? "first_name like '%$search%'" : 1)
                ->OrWhereRaw($search ? "last_name like '%$search%'" : 1)
                ->OrWhereRaw($search ? "CONCAT(first_name, ' ', last_name) like '%$search%'" : 1);
            })
            ->where('tournament_id', $tournament)->where('deleted_at', NULL)->orderBy('id', 'DESC')->paginate($paginate);
        // dump($data);
        return view('referee.list', compact('data'));
    }


    public function storeReferee(Request $request)
    {
        DB::beginTransaction();
        try {

            $referee = Tournament::where('id', $request->tournament_id)->where('deleted_at', null)->first();
            // return $referee;

            $data = Referee::create($request->all());
            // return $data;
            DB::commit();
            return redirect()->route('tournaments.referee', ['tournament' => $request->tournament_id])->with(['message' => 'Registrado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('tournaments.referee', ['tournament' => $request->tournament_id])->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }
}
