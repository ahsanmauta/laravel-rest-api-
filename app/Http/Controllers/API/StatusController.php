<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Asset;
use App\Models\Status;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AssetResource;
use App\Http\Resources\StatusResource;
use Auth;

class StatusController extends Controller
{
    public function index()
    {
        $status = Status::orderBy('codestaass ', 'DESC')->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'get status successfully',
            'data' => StatusResource::collection($status)
        ], 200);
    }
    
    public function search($title)
    {
        
        if(Auth::user()->id){
            $userid=Auth::user()->id;    
            $company=Auth::user()->company;
        }else{
            $userid=0;
            $company='';
        }
        
        $status = Status::where('company',$company)
            ->where('assetcode',$title)
            ->orderBy('created_at', 'DESC')->get();
        return response()->json([
            'status' => true,
            'message' => 'get status successfully',
            'data' => StatusResource::collection($status)
        ], 200);
    }
    
    public function detail($code)
    {
        
        if(Auth::user()->id){
            $userid=Auth::user()->id;    
        }else{
            $userid=0;
        }
        
        $assets = Asset::where('userid',$userid)
            ->where('code',$code)
            ->orderBy('name', 'ASC')->get();
        return response()->json([
            'status' => true,
            'message' => 'get asset successfully',
            'data' => AssetResource::collection($assets)
        ], 200);
    }
    
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'status'   => 'required',
            'assetcode'   => 'required'
        ]);

        
        if(Auth::user()->id){
            $userid=Auth::user()->id;   
            $company=Auth::user()->company;
        }else{
            $userid=0;
            $company='';
        }

        //create post
        $status = Status::create([
            'status'     => $request->status,
            'alasan'     => $request->alasan,
            'company'     => $company,
            'assetcode'     => $request->assetcode,
            'userid'    => $userid
        ]);
        
        $asset = Asset::where('code', $request->assetcode)
             ->update([
                    'condition' => $request->status,
             ]);

        //redirect to index
        return response()->json([
            'status' => true,
            'message' => 'insert status successfully',
            'data' =>  ['status' => $status ]
        ], 200);
    }
    
    public function store1(Request $request)
    {
        //validate form
        $this->validate($request, [
            //'foto'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'     => 'required|min:5',
            'category'   => 'required'
        ]);

        //upload image
        $image = $request->file('filefoto');
        $image->storeAs('images', $image->hashName());

        //create post
        $asset = Asset::create([
            //'image'     => $image->hashName(),
            'name'     => $request->name,
            'merk'     => $request->merk,
            'category'   => $request->category,
            'owner'   => $request->owner,
            'condition'   => $request->condition,
            'dateacquired'   => $request->dateacquired,
            'currentvalue'   => $request->currentvalue,
            'foto'   => $image->hashName(),
            'userid'    => $request->userid
        ]);

        //redirect to index
        return response()->json([
            'status' => true,
            'message' => 'insert asset successfully',
            'data' =>  ['user' => $asset ]
        ], 200);
    }
    

}
