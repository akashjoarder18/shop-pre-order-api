<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserRegistered;
use App\Events\PreOrder;
use PhpParser\Node\Stmt\TryCatch;
use App\Mail\PreOrderedProduct;
use Illuminate\Support\Facades\Mail;

class SandPreOrderEmailNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public $tries = 5;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof UserRegistered) {
            $this->handleUserRegistered($event);
        } elseif ($event instanceof PreOrder) {
            $this->handlePreOrder($event);
        }
    }

    /**
     * Handle the UserRegistered event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    protected function handleUserRegistered(UserRegistered $event)
    {
        try {
            $event->user->notify(new SandPreOrderEmailNotification());
            //Mail::to($event->order->email)->send(new PreOrderedProduct($event->order));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Handle the OrderPlaced event.
     *
     * @param  PreOrder  $event
     * @return void
     */
    protected function handlePreOrder(PreOrder $event)
    {
        try {
            $event->order->notify(new SandPreOrderEmailNotification());
            //Mail::to($event->order->email)->send(new PreOrderedProduct($event->order));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
