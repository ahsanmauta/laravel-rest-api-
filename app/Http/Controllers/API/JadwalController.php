<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Asset;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AssetResource;
use App\Http\Resources\JadwalResource;
use Auth;
use Intervention\Image\Laravel\Facades\Image;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::orderBy('codejadwal ', 'DESC')->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'get jadwal successfully',
            'data' => JadwalResource::collection($jadwals)
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
        
        $jadwals = Jadwal::where('company',$company)->where('assetcode',$title)
            ->orderBy('datejadwal', 'DESC')->get();
        return response()->json([
            'status' => true,
            'message' => 'get jadwal successfully',
            'data' => JadwalResource::collection($jadwals)
        ], 200);
    }
    
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            //'foto'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'datejadwal'   => 'required',
            'assetcode'   => 'required'
        ]);

        
        if(Auth::user()->id){
            $userid=Auth::user()->id;    
            $company=Auth::user()->company;
        }else{
            $userid=0;
            $company='';
        }
        
       
        
        if($request->file('filefoto')){
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
            $jadwal = Jadwal::create([
                'datejadwal'     => $request->datejadwal,
                'assetcode'     => $request->assetcode,
                'alasan'     => $request->alasan,
                'company'     => $company,
                'foto'   => $image->hashName(),
                'userid'    => $userid
            ]);
        }else{
            $jadwal = Jadwal::create([
                'datejadwal'     => $request->datejadwal,
                'assetcode'     => $request->assetcode,
                'alasan'     => $request->alasan,
                'company'     => $company,
                'userid'    => $userid
            ]);
            
        }

        //redirect to index
        return response()->json([
            'status' => true,
            'message' => 'insert asset successfully',
            'data' =>  ['jadwal' => $jadwal ]
        ], 200);
    }
    

}
