<?php

namespace App\Listeners;

use App\Events\BookingWasMade;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveBooking
{
    public function __construct(Firebase $firebase)
    {
        $this->db = $firebase->getDatabase();
    }

    public function handle(BookingWasMade $event)
    {
        $ref = $this->db->getReference('bookings');
        $ref->push($event->data);
    }
}
