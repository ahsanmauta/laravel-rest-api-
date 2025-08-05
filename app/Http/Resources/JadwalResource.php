<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JadwalResource extends JsonResource
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
            'codejadwal ' => $this->codejadwal,
            'assetcode' => $this->assetcode,
            'datejadwal' => $this->datejadwal,
            'alasan' => $this->alasan,
            'company' => $this->company,
            'foto' => $this->foto,
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
