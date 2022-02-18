<?php

namespace App\Services;

use App\Repositories\EnquiryManagementRepository;

class EnquiryManagementService
{
    public function __construct(EnquiryManagementRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getEnquires($data)
    {
        return $this->repo->getEnquiries($data);
    }

    public function getSpecialOffers($data)
    {
        return $this->repo->getSpecialOffers($data);
    }
    public function getTours($data)
    {
        return $this->repo->getTours($data);
    }

    public function setAssignedTo($data)
    {
        if($data->enquiry == 0){
            $res = $this->repo->EnquiryAssignTo($data->users,$data->enquiry_id);
        }
        else if($data->enquiry == 1){
            $res = $this->repo->SpecialOfferAssignTo($data->users,$data->enquiry_id);
        }
        else{
            $res = $this->repo->TourAssignTo($data->users,$data->enquiry_id);
        }

        if($res){
            return ['Enquiry Assigned Successfully','success'];
        }
        else{
            return ['Fail To Assign The Enquiry','error'];
        }
    }

}
