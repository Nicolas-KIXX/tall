<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;
use Illuminate\Auth\Notifications\VerifyEmail;

class LandingPage extends Component
{
    public $email;
    public $showSubscribe = false;
    public $showSuccess = false;

    protected $rules =[
        'email' => 'required|email:filter|unique:subscribers,email'
    ];

    public function mount(Request $request){
        if( request()->has('verified') && request()->verified == 1 ){
            $this->showSuccess = true;
        }
    }

    public function subscribe()
    {
        $this->validate();

        DB::transaction( function() {
            // Make modal 
            $subscriber = Subscriber::create([
                'email' => $this->email
            ]);
    
            // Send notification
            $notification = new VerifyEmail;
            $notification->createUrlUsing( function($notifiable){
                return URL::temporarySignedRoute(
                    'subscribers.verify',
                    now()->addMinutes(30),
                    [
                        // https://www.udemy.com/course/tall-stack-integrate-tailwind-alpine-laravel-and-livewire/learn/lecture/24236314#questions  op 7m00s
                        // notifiable is the subscriber, and ->getKey() gets the id of the subscriber ( so basically: Subscriber::id() )
                        'subscriber' => $notifiable->getKey() 
                    ]
                );
            });

            $subscriber->notify( $notification );
        }, $deadlockRetries = 5 );

        // Reset input field
        $this->reset('email');

        // Show/hide modals
        $this->showSubscribe = false;
        $this->showSuccess = true;
    }

    public function render()
    {
        return view('livewire.landing-page');
    }
}
