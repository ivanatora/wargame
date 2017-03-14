<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;
use App\ResourceDrop;
use App\ResourceGrab;
use App\User;

class ResourcesController extends Controller
{
    public $aRecourceTypes = ['food', 'wood', 'stone', 'gold'];
//    public $aRecourceTypes = ['food', 'gold'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function display(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');

        ResourceDrop::where([
            ['date_expires', '<', date('Y-m-d H:i:s')]
        ])->delete();

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
          ) AS distance'))->having('distance', '<', 2)->get();
//        Log::info('res', ['r' => $tmp]);

        if ($tmp->count() < 100) {
            for ($i = 0; $i < 100 - $tmp->count(); $i++) {
                $oRecord               = new ResourceDrop();
                $oRecord->lat          = rand($lat * 1000000 - 20000, $lat * 1000000 + 20000) / 1000000;
                $oRecord->lng          = rand($lng * 1000000 - 20000, $lng * 1000000 + 20000) / 1000000;
                $oRecord->amount       = rand(1, 5);
                $oRecord->date_expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
                $oRecord->type         = $this->aRecourceTypes[array_rand($this->aRecourceTypes)];
//                $iResourceProbability = rand(0, 100);
//                if ($iResourceProbability < 90) {
//                    $oRecord->type = 'food';
//                } else {
//                    $oRecord->type = 'gold';
//                }
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
          ) AS distance'))->having('distance', '<', 2)->get();

        return response()->json(['success' => true, 'data' => $tmp]);
    }

    public function grab(Request $request)
    {
        $id = $request->input('id');

        $bSuccess = false;

        $oResource = ResourceDrop::find($id);
        $oUser = User::find(Auth::id());

        if ($oResource) {
            switch ($oResource->type) {
                case 'food':
                    $oUser->food += $oResource->amount;
                    break;
                case 'wood':
                    $oUser->wood += $oResource->amount;
                    break;
                case 'stone':
                    $oUser->stone += $oResource->amount;
                    break;
                case 'gold':
                    $oUser->gold += $oResource->amount;
                    break;
            }
            $oUser->save();

            $oRecord          = new ResourceGrab();
            $oRecord->user_id = Auth::id();
            $oRecord->type    = $oResource->type;
            $oRecord->amount  = $oResource->amount;
            $oRecord->save();

            $oResource->delete();
            $bSuccess = true;
        }

        return response()->json(['success' => $bSuccess, 'data' => $oResource]);
    }
}