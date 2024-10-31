<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\UniqueRegisterLink;
use Carbon\Carbon;

class GenerateUniqueRegisterLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:unique-register-link 
                            {role : The role to assign to the user}
                            {organisation_id : The ID of the organisation}
                            {--venue_ids=* : The IDs of the venues (optional)}
                            {--expires_at= : The expiration date (Y-m-d) in UTC}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a unique registration link with predefined role, organisation, and venues';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve and validate inputs
        $role = $this->argument('role');
        $organisation_id = $this->argument('organisation_id');
        $venue_ids = $this->option('venue_ids');
        $expires_at_input = $this->option('expires_at');

        // Validate role against predefined roles (Optional but recommended)
        $valid_roles = ['admin', 'user', 'manager']; // Adjust as per your application
        if (!in_array($role, $valid_roles)) {
            $this->error("Invalid role. Valid roles are: " . implode(', ', $valid_roles));
            return 1; // Non-zero exit code for failure
        }

        // Validate organisation exists
        $organisation = \App\Models\Organisation::find($organisation_id);
        if (!$organisation) {
            $this->error("Organisation with ID {$organisation_id} does not exist.");
            return 1;
        }

        // Validate venues belong to the organisation (Optional)
        if (!empty($venue_ids)) {
            $invalid_venues = \App\Models\Venue::whereIn('id', $venue_ids)
                ->where('organisation_id', '!=', $organisation_id)
                ->pluck('id')
                ->toArray();

            if (!empty($invalid_venues)) {
                $this->error("The following venue IDs do not belong to organisation ID {$organisation_id}: " . implode(', ', $invalid_venues));
                return 1;
            }
        }

        // Determine expiration date
        $expires_at = $expires_at_input 
            ? Carbon::parse($expires_at_input)
            : Carbon::now()->addWeek();

        if ($expires_at->isPast()) {
            $this->error("Expiration date must be a future date.");
            return 1;
        }

        // Generate a unique, random token
        do {
            $token = Str::random(32);
        } while (UniqueRegisterLink::where('token', $token)->exists());

        // Create the UniqueRegisterLink record
        $uniqueRegisterLink = UniqueRegisterLink::create([
            'token' => $token,
            'role' => $role,
            'organisation_id' => $organisation_id,
            'venue_ids' => $venue_ids,
            'expires_at' => $expires_at,
        ]);

        // Generate the full registration URL
        $url = url('/register/' . $token);

        // Output the generated link
        $this->info("Unique registration link generated successfully:");
        $this->line($url);

        return 0; // Zero exit code for success
    }
}
