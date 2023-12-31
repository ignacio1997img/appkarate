<?php

namespace App\Http\Controllers;

use App\Models\Dojo;
use App\Models\People;
use App\Models\Referee;
use App\Models\Tournament;
use App\Models\TournamentsCategory;
use App\Models\Type;
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

    // ######################################################################################################################

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


    public function destroyReferee($referee)
    {
        DB::beginTransaction();
        try {
            // return $referee;
            $referee = Referee::where('id', $referee)->first();

            $referee->update([
                'deleted_at'=>Carbon::now()
            ]);

            DB::commit();
            return redirect()->route('tournaments.referee', ['tournament' => $referee->tournament_id])->with(['message' => 'Eliminado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('tournaments.referee', ['tournament' => $referee->tournament_id])->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }

    // ######################################################################################################################

    public function indexType()
    {
        // return 1;
        $tournament = Tournament::where('deleted_at', null)->where('status', 1)->get();
        // return $tournament;

        
        $type = TournamentsCategory::where('deleted_at', null)->get();
        // return $referee;
        return view('type.browse', compact('tournament', 'type'));
    }

    public function listType($search = null){
        // dump(1);
        $paginate = request('paginate') ?? 10;
        $data = Type::with(['type', 'tournament'])
            ->where(function($query) use ($search){
                if($search){
                    $query->OrwhereHas('type', function($query) use($search){
                        $query->whereRaw("(name like '%$search%')");
                    })
                    ->OrWhereRaw($search ? "description like '%$search%'" : 1);
                }
            })
            ->where('deleted_at', NULL)->orderBy('id', 'DESC')->paginate($paginate);
        // dump($data);
        return view('type.list', compact('data'));
    }


    public function storeType(Request $request)
    {

        DB::beginTransaction();
        try {

            // $ok = Type::where('tournament_id', $request->tournament_id)->where('type_id', $request->type_id)->where('deleted_at', null)->first();

            // if($ok)
            // {
            //     return redirect()->route('tournaments.type', ['tournament' => $request->tournament_id])->with(['message' => 'El tipo ya se encuentra registrado..', 'alert-type' => 'error']);
            // }
            
            // return $request;
            $data = Type::create($request->all());
            // return $data;
            DB::commit();
            return redirect()->route('tournaments.type')->with(['message' => 'Registrado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('tournaments.type')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }

    public function destroyType($type)
    {
        DB::beginTransaction();
        try {
            // return $type;
            $type = Type::where('id', $type)->first();

            $type->update([
                'deleted_at'=>Carbon::now()
            ]);

            DB::commit();
            return redirect()->route('tournaments.type', ['tournament' => $type->tournament_id])->with(['message' => 'Eliminado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('tournaments.type', ['tournament' => $type->tournament_id])->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }

    // #################################################################################3


    public function indexCompetitor($tournament, $type)
    {
        // return $tournament;

        $type = Type::where('id', $type)->where('tournament_id', $tournament)->where('deleted_at', null)->first();

        $dojo = Dojo::where('deleted_at', null)->get();
        // return $type;
        return view('competitor.browse', compact('type', 'dojo'));
    }

    public function listCompetitor($type, $search = null){
        // dump(1);
        $paginate = request('paginate') ?? 10;
        $data = People::with(['type', 'dojo'])
            ->where(function($query) use ($search){
                if($search){
                    $query->OrwhereHas('dojo', function($query) use($search){
                        $query->whereRaw("(name like '%$search%')");
                    })
                    ->OrWhereRaw($search ? "ci like '%$search%'" : 1)
                    ->OrWhereRaw($search ? "weight like '%$search%'" : 1)
                    ->OrWhereRaw($search ? "first_name like '%$search%'" : 1)
                    ->OrWhereRaw($search ? "last_name like '%$search%'" : 1)
                    ->OrWhereRaw($search ? "CONCAT(first_name, ' ', last_name) like '%$search%'" : 1)
                    
                    ->OrWhereRaw($search ? "age like '%$search%'" : 1);
                }
            })
            ->where('type_id', $type)->where('deleted_at', NULL)->orderBy('id', 'DESC')->paginate($paginate);
        // dump($data);
        return view('competitor.list', compact('data'));
    }

    

    public function storeCompetitor(Request $request)
    {
        DB::beginTransaction();
        try {            
            $data = People::create($request->all());
            DB::commit();
            return redirect()->route('tournaments-type.competitor', ['tournament' => $request->tournament_id, 'type'=>$request->type_id])->with(['message' => 'Registrado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('tournaments-type.competitor', ['tournament' => $request->tournament_id, 'type'=>$request->type_id])->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }

    public function destroyCompetitor(Request $request, $competitor)
    {
        // return $request;
        DB::beginTransaction();
        try {
            // return $type;
            $type = People::where('id', $competitor)->first();

            $type->update([
                'deleted_at'=>Carbon::now()
            ]);

            DB::commit();
            return redirect()->route('tournaments-type.competitor', ['tournament' => $request->tournament_id, 'type'=>$request->type_id])->with(['message' => 'Eliminado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('tournaments-type.competitor', ['tournament' => $request->tournament_id, 'type'=>$request->type_id])->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }

    public function updateCompetitor(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {            

            $people = People::where('deleted_at', null)->where('id', $request->id)->first();

            $people->update([
                'dojo_id'=>$request->dojo_id,
                'last_name'=>$request->last_name,
                'first_name'=>$request->first_name,
                'ci'=>$request->ci,
                'gender'=>$request->gender,
                'age'=>$request->age,
                'weight'=>$request->weight,

            ]);
            // $data = People::create($request->all());

            DB::commit();
            return redirect()->route('tournaments-type.competitor', ['tournament' => $request->tournament_id, 'type'=>$request->type_id])->with(['message' => 'Registrado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('tournaments-type.competitor', ['tournament' => $request->tournament_id, 'type'=>$request->type_id])->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }




}
