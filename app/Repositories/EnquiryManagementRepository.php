<?php

namespace App\Repositories;

use App\Models\Enquiries;
use App\Models\Special_offers_inquiry;
use App\Models\TourInquiry;
use Exception;
use Illuminate\Support\Facades\DB;

class EnquiryManagementRepository{
    public function __construct(Enquiries $enquiryModel,Special_offers_inquiry $specialOfferModel,TourInquiry $tourModel)
    {
        $this->enquiryModel = $enquiryModel;
        $this->specialOfferModel = $specialOfferModel;
        $this->tourModel = $tourModel;
    }

    public function getEnquiries($data)
    {
        $enquiries = $this->enquiryModel->whereBetween('created_at',[$data['fromDate'],$data['toDate']]);
        if($data['prospect'] != null)
            $enquiries->where('enquiry_prospect',$data['prospect']);
        if($data['status'] != null)
            $enquiries->where('enquiry_status',$data['status']);
        if($data['enquiry_type'] != null)
            $enquiries->where('enquiry_type',$data['enquiry_type']);
        if($data['country'] != null)
            $enquiries->where('customer_country',$data['country']);
        if($data['assignee'] != null)
            $enquiries->where('assigned_to',$data['assignee']);

        return $enquiries->get();
    }

    public function getSpecialOffers($data)
    {
        $specialOffers = $this->specialOfferModel->whereBetween('created_at',[$data['fromDate'],$data['toDate']]);
        if($data['status'] != null){
            $specialOffers->where('status',$data['status']);
        }
        if($data['country'] != null){
            $specialOffers->where('country',$data['country']);
        }
        if($data['assignee'] != null){
            $specialOffers->where('assigned_to',$data['assignee']);
        }
        return $specialOffers->get();
    }

    public function getTours($data)
    {
        $tours = $this->tourModel->whereBetween('created_at',[$data['fromDate'],$data['toDate']]);
        if($data['status'] != null){
            $tours->where('enquiry_status',$data['status']);
        }
        if($data['assignee'] != null){
            $tours->where('assigned_to',$data['assignee']);
        }
        return $tours->get();
    }
    public function TourAssignTo($user_id,$enquiry_id)
    {
       try{
            $this->tourModel->where('tour_inquiry_id',$enquiry_id)->update(['assigned_to' => $user_id]);
            return 1;
       }
       catch (Exception $err){
           return 0;
       }
    }
    public function EnquiryAssignTo($user_id,$enquiry_id)
    {
       try{
            $this->enquiryModel->where('enq_id',$enquiry_id)->update(['assigned_to' => $user_id]);
            return 1;
       }
       catch (Exception $err){
           return 0;
       }
    }
    public function SpecialOfferAssignTo($user_id,$enquiry_id)
    {
       try{
            $this->specialOfferModel->where('id',$enquiry_id)->update(['assigned_to' => $user_id]);
            return 1;
       }
       catch (Exception $err){
           return 0;
       }
    }
}
