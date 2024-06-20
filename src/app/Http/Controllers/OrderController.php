<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Events\PreOrder;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Auth;
use App\Services\ReCaptchaService;
 
// Retrieve the currently authenticated user...


class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('guest');

    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(OrderRequest $request)
    {
        
        $isValidReCaptcha = ReCaptchaService::verify($request->recaptchaToken);
        if (!$isValidReCaptcha) {
            return response()->json(['error' => 'Invalid reCAPTCHA response'], 422);
        }
        $order =  new Order;
        $order->name = $request->name;
        $order->email = $request->email;
        if(isset($request->phone)){
            $order->phone = $request->phone;
        }
        $order->product_id = $request->product_id;
        $order->quantity = $request->quantity;
        $result = $order->save();

        $user = User::where('role','admin')->first();
        UserRegistered::dispatch($user);
        PreOrder::dispatch($order);
        

        return response()->json($result);
    }
}
