<?php
namespace App\Services;

use App\Repositories\ContactsRepository;
use App\Models\Contact;

/**
 *
 ContactsService.php
 */
class ContactsService
{
  protected $contactRepo;
  function __construct(ContactsRepository $contactRepo)
  {
    $this->contactRepo = $contactRepo;
  }

  function prepareData($request){
      return [
        'name'  =>  $request->contact_name,
        'phone'  =>  $request->contact_number ?? null,
        'whatsapp'  =>  $request->contact_whatsapp ?? null,
        'email'  =>  $request->contact_email ?? null,
        'type'  =>  $request->type,
        'agent_id'  =>  $request->agent_id ?? null,
        'supplier_id'  =>  $request->supplier_id ?? null,
      ];
  }
  function store($request){
      $contactData = $this->prepareData($request);
      return $this->contactRepo->store($contactData);
  }
  function update($request, $id){
    $contactData = $this->prepareData($request);
    return $this->contactRepo->update($contactData, $id);
  }

  function delete($id)
  {
    if($id) {
      $contactDelete    = $this->contactRepo->delete($id);
      if($contactDelete){
        return ['Contact Deleted Successfully!','success',true];
      }
      else{
          return ['Fail To Delete Contact.','error',true];
      }
    }  else{
        return ['Fail To Delete Contact.','error',true];
    }
  }
}
