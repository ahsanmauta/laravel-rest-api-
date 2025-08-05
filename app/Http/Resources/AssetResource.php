<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'merk' => $this->merk,
            'category' => $this->category,
            'owner' => $this->owner,
            'condition' => $this->condition,
            'dateacquired' => $this->dateacquired,
            'currentvalue' => $this->currentvalue,
            'foto' => $this->foto,
            'company' => $this->company,
            'lokasi' => $this->lokasi,
            'userid' => $this->userid
        ];
    }

    public function with($request){
        return [
            'version' => '1.0.0',
            'author_url' => url('https://www.ezexpress.net'),
        ];
    }
}
