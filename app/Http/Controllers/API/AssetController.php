<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Asset;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AssetResource;
use Auth;
use Intervention\Image\Laravel\Facades\Image;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::orderBy('code', 'ASC')->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'get asset successfully',
            'data' => AssetResource::collection($assets)
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
        
        $assets = Asset::where('company',$company)->where('name', 'like', '%'.$title.'%')
            ->orderBy('name', 'ASC')->get();
        return response()->json([
            'status' => true,
            'message' => 'get asset successfully',
            'data' => AssetResource::collection($assets)
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
            //'foto'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'     => 'required|min:5',
            'category'   => 'required'
        ]);
        
        if(Auth::user()->id){
            $userid=Auth::user()->id;    
            $company=Auth::user()->company;  
        }else{
            $userid=0;
            $company='';  
        }

        //upload image
        $image = $request->file('filefoto');
        $image->storeAs('images1', $image->hashName());
        
        $img = Image::read($image)
                ->resize(150, 100,  function ($constraint) {
                    //$constraint->aspectRatio();
                    //$constraint->upsize();
                    });
                                
        $img->save('images/'.$image->hashName());

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
            'company'    => $company,
            'lokasi'   => $request->lokasi,
            'userid'    => $userid
        ]);

        //redirect to index
        return response()->json([
            'status' => true,
            'message' => 'insert asset successfully',
            'data' =>  ['user' => $asset ]
        ], 200);
    }
    

}
