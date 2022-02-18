<?php

namespace App\Services;

use App\Repositories\ActivityBookingRepository;

class ActivityBookingService{
    public function __construct(ActivityBookingRepository $repo)
    {
        $this->repo = $repo;
    }
    public function store($request, $booking_ids = null)
    {
        if($booking_ids != null){
            return $this->repo->update($request->session, $request->activity_id);
        }
        return $this->repo->store($request->session, $request->activity_id);
    }

    public function delete($booking_id)
    {
        return $this->repo->delete($booking_id);
    }
}
