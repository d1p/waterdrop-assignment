<?php

namespace App\Jobs;

use App\Models\Dog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessDogs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $dogs;

    /**
     * Create a new job instance.
     */
    public function __construct(array $dogs)
    {
        $this->dogs = $dogs;
    }

    /**
     * Execute the job.
     */
    public function handle(Dog $dog): void
    {
        foreach ($this->dogs as $d) {
            $dog->create([
                'data' => $d
            ]);
        }
    }
}
