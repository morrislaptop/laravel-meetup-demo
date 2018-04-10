<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kreait\Firebase;

class IncreasePrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:increase-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increase the prices by $1';

	protected $db;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Firebase $firebase)
    {
        parent::__construct();
        $this->db = $firebase->getDatabase();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ref = $this->db->getReference('bookings');
        
        $bookings = $ref->getSnapshot()->getValue();
        $updates = [];

        foreach ($bookings as $i => $booking) {
            $updates["bookings/${i}/cost"] = $booking['cost'] + 1;
        }

        $this->db->getReference()->update($updates);
    }
}
