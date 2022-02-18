<?php

namespace App\Services;

use App\Repositories\ActivityPricingRepository;

use function GuzzleHttp\json_decode;

class ActivityPricingService
{
    public function __construct(ActivityPricingRepository $repo)
    {
        $this->repo = $repo;
    }
    public function store($request, $ids = null)
    {
        $data = $request->only('activity_id','adult','child','infant');
        $finals = self::prepareData($data, $ids != null ? 'update' : 'store');
        if($ids != null){
            return $this->repo->update($finals, $data['activity_id']);
        }
        return $this->repo->store($finals, $data['activity_id']);
    }

    public function delete($pricing_id)
    {
        return $this->repo->delete($pricing_id);
    }

    public static function prepareData($data, $mod = null)
    {
        if(isset($data['adult'])){
            foreach($data['adult'] as $key => $value){
                $finals[] = [
                    'activity_id' => $data['activity_id'],
                    'pricing_for' => 'adult',
                    'max_pax' => $value['max_pax'],
                    'price' => $value['price'],
                ];
                if($mod == 'update'){
                    $finals[count($finals)-1]['id'] = $value['id'];
                }
            }
        }
        if(isset($data['child'])){
            foreach($data['child'] as $key => $value){
                $finals[] = [
                    'activity_id' => $data['activity_id'],
                    'pricing_for' => 'child',
                    'max_pax' => $value['max_pax'],
                    'price' => $value['price'],
                ];
                if($mod == 'update'){
                    $finals[count($finals)-1]['id'] = $value['id'];
                }
            }
        }
        if(isset($data['infant'])){
            foreach($data['infant'] as $key => $value){
                $finals[] = [
                    'activity_id' => $data['activity_id'],
                    'pricing_for' => 'infant',
                    'max_pax' => $value['max_pax'],
                    'price' => $value['price'],
                ];
                if($mod == 'update'){
                    $finals[count($finals)-1]['id'] = $value['id'];
                }
            }
        }
        return $finals;
    }
}
