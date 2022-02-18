<?php
namespace App\Repositories;

use App\Models\Contact;
/**
 *
 ContactsRepository.php
 */
class ContactsRepository
{

  function __construct(Contact $contact)
  {
      $this->contact = $contact;
  }
  function store($data){
    try {
      $model = $this->contact->create($data);
      return ['status' => true, 'message' => 'Contact Detail Added', 'contact' => $model, 'type' => 'success'];
    } catch (\Exception $e) {
      return ['status' => false, 'message' => $e->getMessage(), 'type' => 'error'];
    }
  }
  function update($data, $id){
    try {
      $contact = $this->contact->find($id);
      if ($contact) {
          $model = $contact->update($data);
          return ['status' => true, 'message' => 'Contact Detail updated!', 'contact' => $this->contact->find($id), 'type' => 'success'];
      }
      throw new \Exception("Contact Model not found!", 1);
    } catch (\Exception $e) {
      return ['status' => false, 'message' => $e->getMessage(), 'type' => 'error'];
    }
  }

  function delete($id){
    try {
      $contact = $this->contact->find($id);
      if ($contact) {
          $contact->delete();
          return 1;
      }
      throw new \Exception("Contact Model not found!", 1);
    } catch (\Exception $e) {
      return 0;
    }
  }
}