<?php

namespace PayLabs\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
           'result' => $this->getResult(),
           'error' => $this->getError(),
           'transaction_id' => $this->getTransactionId(),
           'redirectURL' => $this->getRedirectURL(),
       ];
    }
}
