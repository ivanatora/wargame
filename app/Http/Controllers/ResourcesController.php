<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;
use App\ResourceDrop;
use App\User;

class ResourcesController extends Controller
{
    public $aRecourceTypes = ['food', 'wood', 'stone', 'gold'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function display(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');

//        SELECT
//  id, (
//    3959 * acos (
//      cos ( radians(78.3232) )
//      * cos( radians( lat ) )
//      * cos( radians( lng ) - radians(65.3234) )
//      + sin ( radians(78.3232) )
//      * sin( radians( lat ) )
//    )
//  ) AS distance
//FROM markers
//HAVING distance < 30
//ORDER BY distance
//LIMIT 0 , 20;

        $tmp = DB::table('resource_drops')->select(DB::raw('  id, lat, lng, amount, type, (
            6371 * acos (
              cos ( radians('.$lat.') )
              * cos( radians( lat ) )
              * cos( radians( lng ) - radians('.$lng.') )
              + sin ( radians('.$lat.') )
              * sin( radians( lat ) )
            )
          ) AS distance'))->having('distance', '<', 0.5)->get();
        Log::info('res', ['r' => $tmp]);

        if ($tmp->count() < 15) {
            for ($i = 0; $i < 15 - $tmp->count(); $i++) {
                $oRecord         = new ResourceDrop();
                $oRecord->lat    = rand($lat*1000000 - 4*1000, $lat*1000000 + 4*1000) / 1000000;
                $oRecord->lng    = rand($lng*1000000 - 4*1000, $lng*1000000 + 4*1000) / 1000000;
                $oRecord->amount = rand(1, 5);
                $oRecord->type   = $this->aRecourceTypes[array_rand($this->aRecourceTypes)];
                $oRecord->save();
            }
        }

        $tmp = DB::table('resource_drops')->select(DB::raw('  id, lat, lng, amount, type, (
            6371 * acos (
              cos ( radians('.$lat.') )
              * cos( radians( lat ) )
              * cos( radians( lng ) - radians('.$lng.') )
              + sin ( radians('.$lat.') )
              * sin( radians( lat ) )
            )
          ) AS distance'))->having('distance', '<', 0.5)->get();

        return response()->json(['success' => true, 'data' => $tmp]);
    }

    public function grab(Request $request)
    {
        $id = $request->input('id');

        $oResource = ResourceDrop::find($id);

        if ($oResource){
            switch ($oResource->type){
                case 'food': 
                    DB::table('users')->where('id', Auth::id())->increment('food', $oResource->amount);
                    break;
                case 'wood': 
                    DB::table('users')->where('id', Auth::id())->increment('wood', $oResource->amount);
                    break;
                case 'stone': 
                    DB::table('users')->where('id', Auth::id())->increment('stone', $oResource->amount);
                    break;
                case 'gold': 
                    DB::table('users')->where('id', Auth::id())->increment('gold', $oResource->amount);
                    break;
            }

            $oResource->delete();
        }

        return response()->json(['success' => true, 'data' => $oResource]);
    }
}