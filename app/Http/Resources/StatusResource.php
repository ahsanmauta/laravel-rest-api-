<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'codestaass' => $this->codestaass,
            'assetcode' => $this->assetcode,
            'status' => $this->status,
            'company' => $this->company,
            'alasan' => $this->alasan,
            'userid' => $this->userid,
            'foto' => $this->foto,
            'created_at' => $this->created_at
        ];
    }

    public function with($request){
        return [
            'version' => '1.0.0',
            'author_url' => url('https://www.ezexpress.net'),
        ];
    }
}
