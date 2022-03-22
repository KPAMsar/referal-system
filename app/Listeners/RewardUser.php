<?php

namespace App\Listeners;

use App\Events\UserReferred;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RewardUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $referral = \App\ReferralLink::find($event->referralId);
if (!is_null($referral)) {
    \App\ReferralRelationship::create(['referral_link_id' => $referral->id, 'user_id' => $event->user->id]);

    // Example...
    if ($referral->program->name === 'Sign-up Bonus') {
        // User who was sharing link
        $provider = $referral->user;
        $provider->addCredits(15);
        // User who used the link
        $user = $event->user;
        $user->addCredits(20);
    }

}
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserReferred  $event
     * @return void
     */
    public function handle(UserReferred $event)
    {
        //
    }

}
