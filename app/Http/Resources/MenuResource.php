<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'ID' => $this->ID,
            'DISPLAYEDTEXT' => $this->DISPLAYEDTEXT,
            'ISSHOW' => $this->ISSHOW,
            'OUTLET' => $this->OUTLET,
            'PRICE' => $this->PRICE,
            'FOTO' => $this->FOTO,
            'CANDISCOUNT' => $this->CANDISCOUNT,
            'CANSALESTAX' => $this->CANSALESTAX,
            'CANSERVICETAX' => $this->CANSERVICETAX,
            'CANDISCOUNTORDER' => $this->CANDISCOUNTORDER,
            'CANDISCOUNTMEMBER' => $this->CANDISCOUNTMEMBER,
            'CANDISCOUNTPAYMENT' => $this->CANDISCOUNTPAYMENT,
            'ASK_PRICE' => $this->ASK_PRICE,
            'MEASUREMENT' => $this->MEASUREMENT
        ];
    }

    public function with($request){
        return [
            'version' => '1.0.0',
            'author_url' => url('https://www.nazmulrobin.com'),
        ];
    }
}
