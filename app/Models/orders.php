<?php

namespace App\Models;

use App\Http\Requests\orderRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class orders extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function deleteOrder(int $id)
    {
        return $this->where('id',$id)->first();

    }

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function findOrder($id, int $user_id)
    {
        
        return $this->where('id',$id)
                    ->where('user_id' , $user_id)
                    ->firstOrFail();

    }


    public function updateOrders(orderRequest $orderRequest,$founded_order)
    {
        $founded_order->user_id = $orderRequest->user_id;

        $founded_order->status = $orderRequest->status;

        $founded_order->total_amount = $orderRequest->total_amount;

        $founded_order->delivery_amount = $orderRequest->delivery_amount;

        $founded_order->paying_amount = $orderRequest->paying_amount;

        $founded_order->paying_status = $orderRequest->paying_status;

        $founded_order->update();


    }

    public function newOrder(orderRequest $orderRequest)
    {
        
        $this->user_id = $orderRequest->user_id;

        $this->status = $orderRequest->status;

        $this->total_amount = $orderRequest->total_amount;

        $this->delivery_amount = $orderRequest->delivery_amount;

        $this->paying_amount = $orderRequest->paying_amount;

        $this->paying_status = $orderRequest->paying_status;
        
        $this->save();

    }



}
