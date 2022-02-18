<?php

namespace App\Http\Controllers;

use Session;
use App\Users;
use App\Guides;
use App\Hotels;
use App\Drivers;
use App\Bookings;
use App\Currency;
use App\Suppliers;
use App\Transfers;
use App\Activities;
use App\Guides_log;
use App\UserRights;
use App\User;
use App\SightSeeing;
use App\Models\Cities;
use App\SupplierWallet;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\SupplierManagementService;

class SupplierManagement extends Controller
{
    protected $supplierManagementService;
    public function __construct(SupplierManagementService $supplierManagementService)
    {
        $this->supplierManagementService = $supplierManagementService;
        // date_default_timezone_set('Asia/Dubai');
    }

    public static function getDriverSupplier($id){
        return Drivers::where("driver_supplier_id",$id)->get();
    }
    public static function getHotelSupplier($id){
        return Hotels::where("supplier_id",$id)->get();
    }
    public static function getActivitySupplier($id){
        return Activities::where("supplier_id",$id)->get();
    }
    public static function getTransferSupplier($id){
        return Transfers::where("supplier_id",$id)->get();
    }
    public static function getGuideSupplier($id){
        return Guides::where("guide_supplier_id",$id)->get();
    }

    private function rights($menu)
    {
        $emp_id = session()->get('travel_users_id');
        $right_array = array();
        $employees = User::where('users_id', $emp_id)->where('users_pid', 0)->where('users_status', 1)->first();
        if (!empty($employees)) {
            $right_array['add'] = 1;
            $right_array['view'] = 1;
            $right_array['edit_delete'] = 1;
            $right_array['report'] = 1;
            $right_array['admin'] = 1;
            $right_array['admin_which'] = "add,view,edit_delete,report";
        } else {

            $employees = User::where('users_id', $emp_id)->where('users_status', 1)->first();
            if (!empty($employees)) {
                $user_rights = UserRights::where('emp_id', $emp_id)->where('menu', $menu)->first();
                if (!empty($user_rights)) {
                    $right_array['add'] = $user_rights->add_status;
                    $right_array['view'] = $user_rights->view_status;
                    $right_array['edit_delete'] = $user_rights->edit_del_status;
                    $right_array['report'] = $user_rights->report_status;
                    $right_array['admin'] = $user_rights->admin_status;
                    if ($user_rights->admin_which_status != "")
                        $right_array['admin_which'] = $user_rights->admin_which_status;
                    else
                        $right_array['admin_which'] = "No";
                } else {
                    $right_array['add'] = 0;
                    $right_array['view'] = 0;
                    $right_array['edit_delete'] = 0;
                    $right_array['report'] = 0;
                    $right_array['admin'] = 0;
                    $right_array['admin_which'] = "No";
                }
            } else {
                $right_array['add'] = 0;
                $right_array['view'] = 0;
                $right_array['edit_delete'] = 0;
                $right_array['report'] = 0;
                $right_array['admin'] = 0;
                $right_array['admin_which'] = "No";
            }
        }

        return $right_array;
    }

    public function index(Request $request)
    {
        if (session()->has('travel_users_id')) {

            $rights = $this->rights('supplier-management');
            $countries = Countries::get();
            $users = User::get();
            $emp_id = session()->get('travel_users_id');

            if (strpos($rights['admin_which'], 'add') !== false || strpos($rights['admin_which'], 'view') !== false) {
                $get_suppliers = Suppliers::get();
            } else {
                $get_suppliers = Suppliers::where('supplier_created_by', $emp_id)->get();
            }

            return view('mains.suppliers.index')->with(compact('get_suppliers', 'countries', 'rights', 'users'));
        } else {
            return redirect()->route('index');
        }
    }
    public function create(Request $request)
    {
        if (session()->has('travel_users_id')) {
            $rights = $this->rights('supplier-management');
            $countries = Countries::where('country_status', 1)->get();
            $currency = Currency::get();
            $users = User::where('users_pid', '!=', 0)->where('users_assigned_role', 'Sub-User')->where('users_status', 1)->get();
            return view('mains.create-supplier')->with(compact('countries', 'currency', 'users', 'rights'));
        } else {
            return redirect()->route('index');
        }
    }

    public function insert_supplier(Request $request)
    {
        $created_by = session()->get('travel_users_id');
        $created_role = session()->get('travel_users_role');
        $supplier_name = $request->get('supplier_name');
        $company_name = $request->get('company_name');
        $email_id = $request->get('email_id');
        $contact_number = $request->get('contact_number');
        $check_supplier = Suppliers::where('company_email', $email_id)->orWhere('company_contact', $contact_number)->get();
        if (count($check_supplier) > 0) {

            echo "exist";
        } else {
            $fax_number = $request->get('fax_number');
            $supplier_reference_id = $request->get('supplier_reference_id');
            $address = $request->get('address');
            $supplier_country = $request->get('supplier_country');
            $supplier_city = $request->get('supplier_city');
            $corporate_reg_no = $request->get('corporate_reg_no');
            $corporate_description = $request->get('corporate_description');
            $skype_id = $request->get('skype_id');
            $fuel_info = $request->get('fuel_info');
            $operating_hrs_from = $request->get('operating_hrs_from');
            $operating_hrs_to = $request->get('operating_hrs_to');
            $week_monday = $request->get('week_monday');
            $week_tuesday = $request->get('week_tuesday');
            $week_wednesday = $request->get('week_wednesday');
            $week_thursday = $request->get('week_thursday');
            $week_friday = $request->get('week_friday');
            $week_saturday = $request->get('week_saturday');
            $week_sunday = $request->get('week_sunday');
            $supplier_opr_currency = $request->get('supplier_opr_currency');
            $supplier_opr_countries = $request->get('supplier_opr_countries');
            $blackout_days = $request->get('blackout_days');
            $account_number = $request->get('account_number');
            $bank_name = $request->get('bank_name');
            $bank_swift = $request->get('bank_swift');
            $bank_iban = $request->get('bank_iban');
            $bank_currency = $request->get('bank_currency');
            $service_type = $request->get('service_type');
            $contact_person_name = $request->get('contact_person_name');
            $contact_person_number = $request->get('contact_person_number');
            $contact_person_email = $request->get('contact_person_email');
            $supplier_certificate_file = $request->get('supplier_certificate_file');
            $supplier_logo_file = $request->get('supplier_logo_file');

            if ($request->hasFile('supplier_certificate_file')) {
                $supplier_certificate_file = $request->file('supplier_certificate_file');
                $extension = strtolower($request->supplier_certificate_file->getClientOriginalExtension());
                if ($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "pdf") {
                    $certificate_supplier = "certificate-" . time() . '.' . $request->file('supplier_certificate_file')->getClientOriginalExtension();

                    // request()->agent_logo->storeAs(public_path('consultant-images'), $imageName);
                    $dir = 'assets/uploads/supplier_certificates/';

                    $request->file('supplier_certificate_file')->move($dir, $certificate_supplier);
                } else {
                    $certificate_supplier = "";
                }
            } else {
                $certificate_supplier = "";
            }

            if ($request->hasFile('supplier_logo_file')) {
                $supplier_logo_file = $request->file('supplier_logo_file');
                $extension = strtolower($request->supplier_logo_file->getClientOriginalExtension());
                if ($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "pdf") {
                    $logo_supplier = "logo-" . time() . '.' . $request->file('supplier_logo_file')->getClientOriginalExtension();

                    // request()->agent_logo->storeAs(public_path('consultant-images'), $imageName);
                    $dir1 = 'assets/uploads/supplier_logos/';

                    $request->file('supplier_logo_file')->move($dir1, $logo_supplier);
                } else {
                    $logo_supplier = "";
                }
            } else {
                $logo_supplier = "";
            }

            $operating_weekdays = array(
                "monday" => $week_monday,
                "tuesday" => $week_tuesday,
                "wednesday" => $week_wednesday,
                "thursday" => $week_thursday,
                "friday" => $week_friday,
                "saturday" => $week_saturday,
                "sunday" => $week_sunday
            );

            $operating_weekdays = serialize($operating_weekdays);
            $supplier_opr_currency = implode(",", $supplier_opr_currency);
            $supplier_opr_countries = implode(",", $supplier_opr_countries);

            $service_type = implode(",", $service_type);
            $supplier_bank_details = array();
            for ($bank_count = 0; $bank_count < count($account_number); $bank_count++) {
                $supplier_bank_details[$bank_count]['account_number'] = $account_number[$bank_count];
                $supplier_bank_details[$bank_count]['bank_name'] = $bank_name[$bank_count];
                $supplier_bank_details[$bank_count]['bank_ifsc'] = $bank_swift[$bank_count];
                $supplier_bank_details[$bank_count]['bank_iban'] = $bank_iban[$bank_count];
                $supplier_bank_details[$bank_count]['bank_currency'] = $bank_currency[$bank_count];
            }
            $contact_persons = array();
            for ($contact_count = 0; $contact_count < count($contact_person_name); $contact_count++) {
                $contact_persons[$contact_count]['contact_person_name'] = $contact_person_name[$contact_count];
                $contact_persons[$contact_count]['contact_person_number'] = $contact_person_number[$contact_count];
                $contact_persons[$contact_count]['contact_person_email'] = $contact_person_email[$contact_count];
            }
            $supplier_password_hint = "12345";
            $supplier_password = md5($supplier_password_hint);

            $supplier_bank_details = serialize($supplier_bank_details);
            $contact_persons = serialize($contact_persons);
            $supplier = new Suppliers;
            $supplier->supplier_name = $supplier_name;
            $supplier->company_name = $company_name;
            $supplier->company_email = $email_id;
            $supplier->supplier_password = $supplier_password;
            $supplier->supplier_password_hint = $supplier_password_hint;
            $supplier->company_contact = $contact_number;
            $supplier->company_fax = $fax_number;
            $supplier->supplier_ref_id = $supplier_reference_id;
            $supplier->address = $address;
            $supplier->supplier_country = $supplier_country;
            $supplier->supplier_city = $supplier_city;
            $supplier->corporate_reg_no = $corporate_reg_no;
            $supplier->corporate_desc = $corporate_description;
            $supplier->skype_id = $skype_id;
            $supplier->fuel_info = $fuel_info;
            $supplier->operating_hrs_from = $operating_hrs_from;
            $supplier->operating_hrs_to = $operating_hrs_to;
            $supplier->operating_weekdays = $operating_hrs_to;
            $supplier->operating_weekdays = $operating_weekdays;
            $supplier->certificate_corp = $certificate_supplier;
            $supplier->supplier_logo = $logo_supplier;
            $supplier->supplier_opr_currency = $supplier_opr_currency;
            $supplier->supplier_opr_countries = $supplier_opr_countries;
            $supplier->blackout_dates = $blackout_days;
            $supplier->supplier_bank_details = $supplier_bank_details;
            $supplier->supplier_service_type = $service_type;
            $supplier->contact_persons = $contact_persons;
            $supplier->supplier_created_by = $created_by;
            $supplier->supplier_created_role = $created_role;
            if ($supplier->save()) {
                echo "success";
            } else {
                echo "fail";
            }
        }
    }
    public function edit_supplier($supplier_id)
    {
        if (session()->has('travel_users_id')) {
            $emp_id = session()->get('travel_users_id');
            $rights = $this->rights('supplier-management');
            $countries = Countries::where('country_status', 1)->get();
            $currency = Currency::get();
            if (strpos($rights['admin_which'], 'edit_delete') !== false) {
                $get_supplier = Suppliers::where('supplier_id', $supplier_id)->first();
            } else {
                $get_supplier = Suppliers::where('supplier_id', $supplier_id)->where('supplier_created_by', $emp_id)->first();
            }
            if ($get_supplier) {
                $users = User::where('users_pid', '!=', 0)->where('users_assigned_role', 'Sub-User')->where('users_status', 1)->get();
                return view('mains.edit-supplier')->with(compact('countries', 'currency', 'get_supplier', 'users', 'rights'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('index');
        }
    }
    public function update_supplier(Request $request)
    {
        $supplier_id = urldecode(base64_decode(base64_decode($request->get('supplier_id'))));

        $check_supplier = Suppliers::where('supplier_id', $supplier_id)->first();
        if (!$check_supplier) {
            echo "fail";
        } else {
            $certificate_data = $check_supplier->certificate_corp;
            $logo_data = $check_supplier->supplier_logo;

            $supplier_name = $request->get('supplier_name');
            $company_name = $request->get('company_name');
            $email_id = $request->get('email_id');
            $contact_number = $request->get('contact_number');
            $fax_number = $request->get('fax_number');
            $supplier_reference_id = $request->get('supplier_reference_id');
            $address = $request->get('address');
            $supplier_country = $request->get('supplier_country');
            $supplier_city = $request->get('supplier_city');
            $corporate_reg_no = $request->get('corporate_reg_no');
            $corporate_description = $request->get('corporate_description');
            $skype_id = $request->get('skype_id');
            $fuel_info = $request->get('fuel_info');
            $operating_hrs_from = $request->get('operating_hrs_from');
            $operating_hrs_to = $request->get('operating_hrs_to');
            $week_monday = $request->get('week_monday');
            $week_tuesday = $request->get('week_tuesday');
            $week_wednesday = $request->get('week_wednesday');
            $week_thursday = $request->get('week_thursday');
            $week_friday = $request->get('week_friday');
            $week_saturday = $request->get('week_saturday');
            $week_sunday = $request->get('week_sunday');
            $supplier_opr_currency = $request->get('supplier_opr_currency');
            $supplier_opr_countries = $request->get('supplier_opr_countries');
            $blackout_days = $request->get('blackout_days');
            $account_number = $request->get('account_number');
            $bank_name = $request->get('bank_name');
            $bank_swift = $request->get('bank_swift');
            $bank_iban = $request->get('bank_iban');
            $bank_currency = $request->get('bank_currency');
            $service_type = $request->get('service_type');
            $contact_person_name = $request->get('contact_person_name');
            $contact_person_number = $request->get('contact_person_number');
            $contact_person_email = $request->get('contact_person_email');
            $supplier_certificate_file = $request->get('supplier_certificate_file');
            $supplier_logo_file = $request->get('supplier_logo_file');

            if ($request->hasFile('supplier_certificate_file')) {
                $supplier_certificate_file = $request->file('supplier_certificate_file');
                $extension = strtolower($request->supplier_certificate_file->getClientOriginalExtension());
                if ($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "pdf") {
                    $certificate_supplier = "certificate-" . time() . '.' . $request->file('supplier_certificate_file')->getClientOriginalExtension();

                    // request()->agent_logo->storeAs(public_path('consultant-images'), $imageName);
                    $dir = 'assets/uploads/supplier_certificates/';

                    $request->file('supplier_certificate_file')->move($dir, $certificate_supplier);
                } else {
                    $certificate_supplier = "";
                }
            } else {
                $certificate_supplier = $certificate_data;
            }


            if ($request->hasFile('supplier_logo_file')) {
                $supplier_logo_file = $request->file('supplier_logo_file');
                $extension = strtolower($request->supplier_logo_file->getClientOriginalExtension());
                if ($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "pdf") {
                    $logo_supplier = "logo-" . time() . '.' . $request->file('supplier_logo_file')->getClientOriginalExtension();

                    // request()->agent_logo->storeAs(public_path('consultant-images'), $imageName);
                    $dir1 = 'assets/uploads/supplier_logos/';

                    $request->file('supplier_logo_file')->move($dir1, $logo_supplier);
                } else {
                    $logo_supplier = "";
                }
            } else {
                $logo_supplier = $logo_data;
            }


            $operating_weekdays = array(
                "monday" => $week_monday,
                "tuesday" => $week_tuesday,
                "wednesday" => $week_wednesday,
                "thursday" => $week_thursday,
                "friday" => $week_friday,
                "saturday" => $week_saturday,
                "sunday" => $week_sunday
            );

            $operating_weekdays = serialize($operating_weekdays);
            $supplier_opr_currency = implode(",", $supplier_opr_currency);
            $supplier_opr_countries = implode(",", $supplier_opr_countries);

            $service_type = implode(",", $service_type);
            $supplier_bank_details = array();
            for ($bank_count = 0; $bank_count < count($account_number); $bank_count++) {
                $supplier_bank_details[$bank_count]['account_number'] = $account_number[$bank_count];
                $supplier_bank_details[$bank_count]['bank_name'] = $bank_name[$bank_count];
                $supplier_bank_details[$bank_count]['bank_ifsc'] = $bank_swift[$bank_count];
                $supplier_bank_details[$bank_count]['bank_iban'] = $bank_iban[$bank_count];
                $supplier_bank_details[$bank_count]['bank_currency'] = $bank_currency[$bank_count];
            }
            $contact_persons = array();
            for ($contact_count = 0; $contact_count < count($contact_person_name); $contact_count++) {
                $contact_persons[$contact_count]['contact_person_name'] = $contact_person_name[$contact_count];
                $contact_persons[$contact_count]['contact_person_number'] = $contact_person_number[$contact_count];
                $contact_persons[$contact_count]['contact_person_email'] = $contact_person_email[$contact_count];
            }

            $supplier_bank_details = serialize($supplier_bank_details);
            $contact_persons = serialize($contact_persons);

            $update_data = array(
                "supplier_name" => $supplier_name,
                "company_name" => $company_name,
                "company_email" => $email_id,
                "company_contact" => $contact_number,
                "company_fax" => $fax_number,
                "supplier_ref_id" => $supplier_reference_id,
                "address" => $address,
                "supplier_country" => $supplier_country,
                "supplier_city" => $supplier_city,
                "corporate_reg_no" => $corporate_reg_no,
                "corporate_desc" => $corporate_description,
                "skype_id" => $skype_id,
                "fuel_info" => $fuel_info,
                "operating_hrs_from" => $operating_hrs_from,
                "operating_hrs_to" => $operating_hrs_to,
                "operating_weekdays" => $operating_hrs_to,
                "operating_weekdays" => $operating_weekdays,
                "certificate_corp" => $certificate_supplier,
                "supplier_logo" => $logo_supplier,
                "supplier_opr_currency" => $supplier_opr_currency,
                "supplier_opr_countries" => $supplier_opr_countries,
                "blackout_dates" => $blackout_days,
                "supplier_bank_details" => $supplier_bank_details,
                "supplier_service_type" => $service_type,
                "contact_persons" => $contact_persons
            );


            $update_query = Suppliers::where('supplier_id', $supplier_id)->update($update_data);
            if ($update_query) {
                echo "success";
            } else {
                echo "fail";
            }
        }
    }
    public function supplier_details($supplier_id)
    {
        if (session()->has('travel_users_id')) {
            $emp_id = session()->get('travel_users_id');
            $rights = $this->rights('supplier-management');
            $currency = Currency::get();
            $countries = Countries::get();
            if (strpos($rights['admin_which'], 'view') !== false) {
                $get_supplier = Suppliers::where('supplier_id', $supplier_id)->first();
            } else {
                $get_supplier = Suppliers::where('supplier_id', $supplier_id)->where('supplier_created_by', $emp_id)->first();
            }
            $supplier_id = base64_encode(base64_encode($supplier_id));
            if ($get_supplier) {
                return view('mains.supplier-details-view')->with(compact('get_supplier', 'countries', 'currency', 'rights'))->with('supplier_id', $supplier_id);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('index');
        }
    }

    public function updateSupplierActiveInactive(Request $request)
    {
        $id = $request->supplier_id;
        $res = $this->supplierManagementService->activeOrInactive($request, $id);
        if ($res['status']) {
            return response($res, 200);
        }
        return response($res, 400);
    }

    // public function guide_management(Request $request)
    //     {
    //      if(session()->has('travel_users_id'))
    //      {
    //         $rights=$this->rights('admin-guide-management');
    //       $countries=Countries::where('country_status',1)->get();
    //        $emp_id=session()->get('travel_users_id');
    //         if(strpos($rights['admin_which'],'add')!==false || strpos($rights['admin_which'],'view')!==false)
    //            {
    //                $get_guides=Guides::get();
    //            }
    //            else
    //            {
    //            	 $get_guides=Guides::where('guide_created_by',$emp_id)->where('guide_role',"!=","Supplier")->get();
    //            }
    //         $get_suppliers=Suppliers::where('supplier_status',1)->get();
    //        return view('mains.admin-guide-management')->with(compact('get_suppliers','get_guides','countries','rights'));
    //      }
    //      else
    //      {
    //        return redirect()->route('index');
    //      }

    //    }
    //     public function create_guide(Request $request)
    //     {
    //       if(session()->has('travel_users_id'))
    //       {
    //          $rights=$this->rights('admin-guide-management');
    //        $countries=Countries::where('country_status',1)->get();
    //         $suppliers=Suppliers::where('supplier_status',1)->get();
    //         return view('mains.admin-create-guide')->with(compact('suppliers','rights'));
    //       }
    //       else
    //       {
    //         return redirect()->route('index');
    //       }
    //     }
    //     public function insert_guide(Request $request)
    //     {

    //       $guide_created_by=session()->get('travel_users_id');
    //       $guide_first_name=$request->get('guide_first_name');
    //       $guide_last_name=$request->get('guide_last_name');
    //       $guide_contact=$request->get('contact_number');
    //       $guide_address=$request->get('address');
    //         $check_guides=Guides::where('guide_contact',$guide_contact)->get();
    //         if(count($check_guides)>0)
    //         {

    //             echo "exist";
    //         }
    //         else
    //         {
    //             $guide_supplier_id=$request->get('guide_supplier_name');
    //       $guide_country=$request->get('guide_country');
    //       $guide_city=$request->get('guide_city');
    //        $guide_language=$request->get('guide_language');
    //       $guide_description=$request->get('description');

    //       $guide_logo_file=$request->get('guide_logo_file');

    //          if($request->hasFile('guide_logo_file'))
    //         {
    //             $guide_logo_file=$request->file('guide_logo_file');
    //             $extension=strtolower($request->guide_logo_file->getClientOriginalExtension());
    //             if($extension=="png" || $extension=="jpg" || $extension=="jpeg")
    //             {
    //                 $guide_image = "guide-".time().'.'.$request->file('guide_logo_file')->getClientOriginalExtension();

    //                 // request()->agent_logo->storeAs(public_path('consultant-images'), $imageName);
    //                 $dir1 = 'assets/uploads/guide_images/';

    //                 $request->file('guide_logo_file')->move($dir1, $guide_image);
    //             }
    //             else
    //             {
    //                 $guide_image = "";
    //             }
    //         }
    //         else
    //         {
    //             $guide_image = "";
    //         }

    //         $guide=new Guides;
    //         $guide->guide_first_name=$guide_first_name;
    //         $guide->guide_last_name=$guide_last_name;
    //         $guide->guide_contact=$guide_contact;
    //         $guide->guide_address=$guide_address;
    //          $guide->guide_supplier_id=$guide_supplier_id;
    //         $guide->guide_country=$guide_country;
    //         $guide->guide_city=$guide_city;
    //         $guide->guide_language=$guide_language;
    //         $guide->guide_description=$guide_description;
    //         $guide->guide_image=$guide_image;
    //         $guide->guide_created_by=$guide_created_by;
    //         if(session()->get('travel_users_role')=="Admin")
    //         {
    //          $guide->guide_role="Admin";
    //         }
    //         else
    //         {
    //         $guide->guide_role="Sub-User";
    //         }

    //          if($guide->save())
    //          {
    //           $last_id=$guide->id;
    //         $guide_log=new Guides_log;
    //         $guide_log->guide_id=$last_id;
    //         $guide_log->guide_first_name=$guide_first_name;
    //         $guide_log->guide_last_name=$guide_last_name;
    //         $guide_log->guide_contact=$guide_contact;
    //         $guide_log->guide_address=$guide_address;
    //         $guide_log->guide_supplier_id=$guide_supplier_id;
    //         $guide_log->guide_country=$guide_country;
    //         $guide_log->guide_city=$guide_city;
    //         $guide_log->guide_language=$guide_language;
    //         $guide_log->guide_description=$guide_description;
    //         $guide_log->guide_image=$guide_image;
    //         $guide_log->guide_created_by=$guide_created_by;
    //         if(session()->get('travel_users_role')=="Admin")
    //         {
    //            $guide_log->guide_role="Admin";
    //        }
    //        else
    //        {
    //         $guide_log->guide_role="Sub-User";
    //         }
    //         $guide_log->guide_operation_performed="INSERT";
    //           $guide_log->save();
    //           echo "success";
    //          }
    //          else
    //          {
    //           echo "fail";
    //          }
    //      }

    //     }
    //      public function edit_guide($guide_id)
    //     {
    //       if(session()->has('travel_users_id'))
    //       {
    //             $rights=$this->rights('admin-guide-management');
    //          $countries=Countries::where('country_status',1)->get();
    //            $emp_id=session()->get('travel_users_id');
    //            if(strpos($rights['admin_which'],'edit_delete')!==false)
    //            {
    //            	$get_guides=Guides::where('guide_id',$guide_id)->first();
    //            }
    //            else
    //            {
    //            	$get_guides=Guides::where('guide_id',$guide_id)->where('guide_created_by',$emp_id)->where('guide_role',"!=","Supplier")->first();
    //            }

    //           if($get_guides)
    //           {
    //               $supplier_id=$get_guides->guide_supplier_id;

    //           $get_supplier_countries=Suppliers::where('supplier_id',$supplier_id)->first();

    //           $supplier_countries=$get_supplier_countries->supplier_opr_countries;

    //           $countries_data=explode(',', $supplier_countries);
    //            $suppliers=Suppliers::where('supplier_status',1)->get();
    //            $cities=Cities::join("states","states.id","=","cities.state_id")->where("states.country_id", $get_guides->guide_country)->select("cities.*")->orderBy('cities.name','asc')->get();

    //           return view('mains.admin-edit-guide')->with(compact('countries','cities','get_supplier_countries','get_guides','suppliers',"countries_data",'rights'));
    //           }
    //           else
    //           {
    //             return redirect()->back();
    //           }




    //       }
    //       else
    //       {
    //         return redirect()->route('index');
    //       }

    //     }

    //      public function update_guide(Request $request)
    //     {
    //       $guide_id=$request->get('guide_id');
    //       $guide_created_by=session()->get('travel_users_id');
    //       $guide_first_name=$request->get('guide_first_name');
    //       $guide_last_name=$request->get('guide_last_name');
    //       $guide_contact=$request->get('contact_number');
    //       $guide_address=$request->get('address');
    //         $check_guides=Guides::where('guide_contact',$guide_contact)->where('guide_id','!=',$guide_id)->get();
    //         if(count($check_guides)>0)
    //         {

    //             echo "exist";
    //         }
    //         else
    //         {
    //          $guide_image_get=Guides::where('guide_id',$guide_id)->first();
    //           $logo_data=$guide_image_get['guide_image'];
    //            $guide_supplier_id=$request->get('guide_supplier_name');

    //           $guide_country=$request->get('guide_country');
    //           $guide_city=$request->get('guide_city');
    //           $guide_language=$request->get('guide_language');
    //           $guide_description=$request->get('description');

    //           $guide_logo_file=$request->get('guide_logo_file');

    //          if($request->hasFile('guide_logo_file'))
    //         {
    //             $guide_logo_file=$request->file('guide_logo_file');
    //             $extension=strtolower($request->guide_logo_file->getClientOriginalExtension());
    //             if($extension=="png" || $extension=="jpg" || $extension=="jpeg")
    //             {
    //                 $guide_image = "guide-".time().'.'.$request->file('guide_logo_file')->getClientOriginalExtension();

    //                 // request()->agent_logo->storeAs(public_path('consultant-images'), $imageName);
    //                 $dir1 = 'assets/uploads/guide_images/';

    //                 $request->file('guide_logo_file')->move($dir1, $guide_image);
    //             }
    //             else
    //             {
    //                 $guide_image = "";
    //             }
    //         }
    //         else
    //         {
    //             $guide_image = $logo_data;
    //         }

    //         $update_array=array("guide_first_name"=>$guide_first_name,
    //         "guide_last_name"=>$guide_last_name,
    //         "guide_contact"=>$guide_contact,
    //         "guide_address"=>$guide_address,
    //         "guide_supplier_id"=>$guide_supplier_id,
    //         "guide_country"=>$guide_country,
    //         "guide_city"=>$guide_city,
    //         "guide_language"=>$guide_language,
    //         "guide_description"=>$guide_description,
    //         "guide_image"=>$guide_image);
    //         $update_guide=Guides::where('guide_id',$guide_id)->update($update_array);
    //         if($update_guide)
    //         {
    //           $guide_log=new Guides_log;
    //           $guide_log->guide_id=$guide_id;
    //           $guide_log->guide_first_name=$guide_first_name;
    //           $guide_log->guide_last_name=$guide_last_name;
    //           $guide_log->guide_contact=$guide_contact;
    //           $guide_log->guide_address=$guide_address;
    //            $guide_log->guide_supplier_id=$guide_supplier_id;
    //           $guide_log->guide_country=$guide_country;
    //           $guide_log->guide_city=$guide_city;
    //           $guide_log->guide_language=$guide_language;
    //           $guide_log->guide_description=$guide_description;
    //           $guide_log->guide_image=$guide_image;
    //           $guide_log->guide_created_by=$guide_created_by;
    //           if(session()->get('travel_users_role')=="Admin")
    //           {
    //              $guide_log->guide_role="Admin";
    //           }
    //           else
    //           {
    //             $guide_log->guide_role="Sub-User";
    //             }

    //           $guide_log->guide_operation_performed="UPDATE";
    //           $guide_log->save();
    //           echo "success";
    //         }
    //         else
    //         {
    //           echo "fail";
    //         }
    //      }

    //     }

    //     public function guide_details($guide_id)
    //     {
    //      if(session()->has('travel_users_id'))
    //      {
    //          $rights=$this->rights('admin-guide-management');
    //      $countries=Countries::where('country_status',1)->get();
    //       $emp_id=session()->get('travel_users_id');
    //       if(strpos($rights['admin_which'],'view')!==false)
    //       {
    //       	$get_guides=Guides::where('guide_id',$guide_id)->first();
    //       }
    //       else
    //       {
    //       	$get_guides=Guides::where('guide_id',$guide_id)->where('guide_created_by',$emp_id)->where('guide_role',"!=","Supplier")->first();
    //       }
    //       if($get_guides)
    //       {
    //        $supplier_id=$get_guides->guide_supplier_id;

    //        $get_supplier_countries=Suppliers::where('supplier_id',$supplier_id)->first();

    //        $supplier_countries=$get_supplier_countries->supplier_opr_countries;

    //        $countries_data=explode(',', $supplier_countries);

    //        $cities=Cities::join("states","states.id","=","cities.state_id")->where("states.country_id", $get_guides->guide_country)->select("cities.*")->orderBy('cities.name','asc')->get();
    //         $suppliers=Suppliers::where('supplier_status',1)->get();

    //        return view('mains.admin-guide-details-view')->with(compact('suppliers','countries','cities','get_supplier_countries','get_guides',"countries_data","rights"))->with('guide_id',$guide_id);
    //      }
    //      else
    //      {
    //       return redirect()->back();
    //     }

    //   }
    //   else
    //   {
    //     return redirect()->route('index');
    //   }
    // }

    public function changePassword(Request $request)
    {

    }



    public function pay_supplier_booking(Request $request)
    {
        $booking_id = $request->get('booking_id');

        $check_booking = Bookings::where('booking_sep_id', $booking_id)->where('booking_status', 1)->where('booking_admin_status', 1)->get();
        if (count($check_booking) > 0) {
            $month_numeric = date('m');
            $yearname = date('Y');
            if ($check_booking[0]->booking_type != "itinerary" && $check_booking[0]->booking_type != "sightseeing" && $check_booking[0]->booking_type != "transfer") {

                $supplier_amount = $check_booking[0]->booking_supplier_amount;
                $supplier_id = $check_booking[0]->booking_supplier_id;
                $insert_supp_wallet = new SupplierWallet;
                $insert_supp_wallet->supp_wallet_supplier_id = $supplier_id;
                $insert_supp_wallet->supp_wallet_booking_id = $booking_id;
                $insert_supp_wallet->supp_wallet_credit_amount = round($supplier_amount);
                $insert_supp_wallet->supp_wallet_month = $month_numeric;
                $insert_supp_wallet->supp_wallet_year = $yearname;
                $insert_supp_wallet->supp_wallet_date = date('Y-m-d');
                $insert_supp_wallet->supp_wallet_time = date('H:i:s');
                $insert_supp_wallet->supp_wallet_remarks = ucwords($check_booking[0]->booking_type) . " Payment Received for booking #" . $booking_id;
                if ($insert_supp_wallet->save()) {
                    $update_booking = Bookings::where('booking_sep_id', $booking_id)->update(["booking_supp_pay_status" => 1, "booking_supp_pay_timestamp" => date('Y-m-d H:i:s')]);
                    echo "success";
                } else {
                    echo "fail";
                }
            } else if ($check_booking[0]->booking_type == "transfer") {

                $booking_other_info = unserialize($check_booking[0]->booking_other_info);

                if (array_key_exists("guide_id", $booking_other_info)) {
                    $count = 1;
                    $result = "";
                    foreach ($check_booking as $booking) {
                        if ($count == 1)
                            $supplier_amount = ($booking->booking_supplier_amount - $booking_other_info['guide_supplier_cost']);
                        else
                            $supplier_amount = $booking->booking_supplier_amount;

                        $supplier_id = $booking->booking_supplier_id;

                        $insert_supp_wallet = new SupplierWallet;
                        $insert_supp_wallet->supp_wallet_supplier_id = $supplier_id;
                        $insert_supp_wallet->supp_wallet_booking_id = $booking_id;
                        $insert_supp_wallet->supp_wallet_credit_amount = round($supplier_amount);
                        $insert_supp_wallet->supp_wallet_month = $month_numeric;
                        $insert_supp_wallet->supp_wallet_year = $yearname;
                        $insert_supp_wallet->supp_wallet_date = date('Y-m-d');
                        $insert_supp_wallet->supp_wallet_time = date('H:i:s');
                        $insert_supp_wallet->supp_wallet_remarks = ucwords($booking->booking_type) . " Payment Received for booking #" . $booking_id;
                        if ($insert_supp_wallet->save()) {
                            $result = "success";
                        } else {
                            $result = "fail";
                        }


                        $count++;
                    }

                    if ($result == "success") {
                        $update_booking = Bookings::where('booking_sep_id', $booking_id)->update(["booking_supp_pay_status" => 1, "booking_supp_pay_timestamp" => date('Y-m-d H:i:s')]);
                        echo "success";
                    } else {
                        echo "fail";
                    }
                } else {
                    $supplier_amount = $check_booking[0]->booking_supplier_amount;
                    $supplier_id = $check_booking[0]->booking_supplier_id;
                    $insert_supp_wallet = new SupplierWallet;
                    $insert_supp_wallet->supp_wallet_supplier_id = $supplier_id;
                    $insert_supp_wallet->supp_wallet_booking_id = $booking_id;
                    $insert_supp_wallet->supp_wallet_credit_amount = round($supplier_amount);
                    $insert_supp_wallet->supp_wallet_month = $month_numeric;
                    $insert_supp_wallet->supp_wallet_year = $yearname;
                    $insert_supp_wallet->supp_wallet_date = date('Y-m-d');
                    $insert_supp_wallet->supp_wallet_time = date('H:i:s');
                    $insert_supp_wallet->supp_wallet_remarks = ucwords($check_booking[0]->booking_type) . " Payment Received for booking #" . $booking_id;
                    if ($insert_supp_wallet->save()) {
                        $update_booking = Bookings::where('booking_sep_id', $booking_id)->update(["booking_supp_pay_status" => 1, "booking_supp_pay_timestamp" => date('Y-m-d H:i:s')]);
                        echo "success";
                    } else {
                        echo "fail";
                    }
                }
            } else if ($check_booking[0]->booking_type == "sightseeing") {
                $booking_subject_name = unserialize($check_booking[0]->booking_subject_name);

                if (array_key_exists("guide_id", $booking_subject_name)) {
                    $count = 1;
                    $result = "";
                    foreach ($check_booking as $booking) {
                        if ($count > 1) {
                            $supplier_amount = $booking->booking_supplier_amount;
                            $supplier_id = $booking->booking_supplier_id;

                            $insert_supp_wallet = new SupplierWallet;
                            $insert_supp_wallet->supp_wallet_supplier_id = $supplier_id;
                            $insert_supp_wallet->supp_wallet_booking_id = $booking_id;
                            $insert_supp_wallet->supp_wallet_credit_amount = round($supplier_amount);
                            $insert_supp_wallet->supp_wallet_month = $month_numeric;
                            $insert_supp_wallet->supp_wallet_year = $yearname;
                            $insert_supp_wallet->supp_wallet_date = date('Y-m-d');
                            $insert_supp_wallet->supp_wallet_time = date('H:i:s');
                            $insert_supp_wallet->supp_wallet_remarks = ucwords($booking->booking_type) . " Payment Received for booking #" . $booking_id;
                            if ($insert_supp_wallet->save()) {
                                $result = "success";
                            } else {
                                $result = "fail";
                            }
                        }


                        $count++;
                    }

                    if ($result == "success") {
                        $update_booking = Bookings::where('booking_sep_id', $booking_id)->update(["booking_supp_pay_status" => 1, "booking_supp_pay_timestamp" => date('Y-m-d H:i:s')]);
                        echo "success";
                    } else {
                        echo "fail";
                    }
                } else {
                    $update_booking = Bookings::where('booking_sep_id', $booking_id)->update(["booking_supp_pay_status" => 1, "booking_supp_pay_timestamp" => date('Y-m-d H:i:s')]);
                    echo "success";
                }
            } else if ($check_booking[0]->booking_type == "itinerary") {

                $count = 1;
                $result = "";
                foreach ($check_booking as $booking) {
                    if ($count > 1) {
                        if ($booking->booking_type != "itinerary" && $booking->booking_type != "sightseeing" && $booking->booking_type != "transfer") {
                            $supplier_amount = $booking->booking_supplier_amount;
                            $supplier_id = $booking->booking_supplier_id;

                            $insert_supp_wallet = new SupplierWallet;
                            $insert_supp_wallet->supp_wallet_supplier_id = $supplier_id;
                            $insert_supp_wallet->supp_wallet_booking_id = $booking_id;
                            $insert_supp_wallet->supp_wallet_credit_amount = round($supplier_amount);
                            $insert_supp_wallet->supp_wallet_month = $month_numeric;
                            $insert_supp_wallet->supp_wallet_year = $yearname;
                            $insert_supp_wallet->supp_wallet_date = date('Y-m-d');
                            $insert_supp_wallet->supp_wallet_time = date('H:i:s');
                            $insert_supp_wallet->supp_wallet_remarks = ucwords($booking->booking_type) . " Payment Received for booking #" . $booking_id;
                            if ($insert_supp_wallet->save()) {
                                $result = "success";
                            } else {
                                $result = "fail";
                            }
                        } else if ($booking->booking_type == "transfer") {
                            $booking_other_info = unserialize($booking->booking_other_info);
                            if (array_key_exists("guide_id", $booking_other_info)) {
                                $supplier_amount = ($booking->booking_supplier_amount - $booking_other_info['guide_cost']);
                            } else {
                                $supplier_amount = $booking->booking_supplier_amount;
                            }

                            $supplier_id = $booking->booking_supplier_id;

                            $insert_supp_wallet = new SupplierWallet;
                            $insert_supp_wallet->supp_wallet_supplier_id = $supplier_id;
                            $insert_supp_wallet->supp_wallet_booking_id = $booking_id;
                            $insert_supp_wallet->supp_wallet_credit_amount = round($supplier_amount);
                            $insert_supp_wallet->supp_wallet_month = $month_numeric;
                            $insert_supp_wallet->supp_wallet_year = $yearname;
                            $insert_supp_wallet->supp_wallet_date = date('Y-m-d');
                            $insert_supp_wallet->supp_wallet_time = date('H:i:s');
                            $insert_supp_wallet->supp_wallet_remarks = ucwords($booking->booking_type) . " Payment Received for booking #" . $booking_id;
                            if ($insert_supp_wallet->save()) {
                                $result = "success";
                            } else {
                                $result = "fail";
                            }
                        } else if ($booking->booking_type == "sightseeing") {
                        }
                    }


                    $count++;
                }

                if ($result == "success") {
                    $update_booking = Bookings::where('booking_sep_id', $booking_id)->update(["booking_supp_pay_status" => 1, "booking_supp_pay_timestamp" => date('Y-m-d H:i:s')]);
                    echo "success";
                } else {
                    echo "fail";
                }
            }
        } else {
            echo "no_book";
        }
    }
    public function suppliers_wallet(Request $request)
    {
        if (session()->has('travel_users_id')) {
            $rights = $this->rights('suppliers-wallet');

            $suppliers = Suppliers::where('supplier_status', 1)->get();
            $suppliers_wallet_data = array();
            $count = 0;
            foreach ($suppliers as $supplier) {

                $suppliers_wallet_data[$count]['supplier_id'] = $supplier->supplier_id;
                $suppliers_wallet_data[$count]['supplier_fullname'] = $supplier->supplier_name;
                $suppliers_wallet_data[$count]['supplier_company'] = $supplier->company_name;
                $suppliers_wallet_data[$count]['supplier_status'] = $supplier->supplier_status;

                $get_commission_total = SupplierWallet::select(DB::raw("(COALESCE(sum(supp_wallet_credit_amount), 0)-COALESCE(sum(supp_wallet_debit_amount), 0)) as total_wallet_amount"))->where('supp_wallet_supplier_id', $supplier->supplier_id)->where('supp_wallet_status', 1)->groupBy('supp_wallet_supplier_id')->first();



                $get_commission_withdrawals = SupplierWallet::where('supp_wallet_debit_amount', '!=', null)->where('supp_wallet_supplier_id', $supplier->supplier_id)->where('supp_wallet_status', 0)->get();

                if (!empty($get_commission_total)) {
                    $suppliers_wallet_data[$count]['supplier_total_wallet_amount'] = "GEL " . $get_commission_total->total_wallet_amount;
                } else {
                    $suppliers_wallet_data[$count]['supplier_total_wallet_amount'] = "GEL 0";
                }

                $suppliers_wallet_data[$count]['get_commission_withdrawals_count'] = count($get_commission_withdrawals);

                $count++;
            }
            return view('mains.my-wallet-suppliers')->with(compact('rights', 'suppliers_wallet_data'));
        } else {
            return redirect()->route('index');
        }
    }

    public function own_wallet_supplier(Request $request)
    {
        if (session()->has('travel_users_id')) {
            $supplier_id = $request->get('supplier_id');
            $rights = $this->rights('suppliers-wallet');
            $withdaw_yes = "1";
            $month_numeric = date('m');
            $yearname = date('Y');
            $get_wallet = SupplierWallet::where('supp_wallet_supplier_id', $supplier_id)->orderBy('supp_wallet_id', 'desc')->paginate(10);
            $get_commission_total = SupplierWallet::select(DB::raw("(COALESCE(sum(supp_wallet_credit_amount), 0)-COALESCE(sum(supp_wallet_debit_amount), 0)) as total_wallet_amount"))->where('supp_wallet_supplier_id', $supplier_id)->where('supp_wallet_status', 1)->groupBy('supp_wallet_supplier_id')->first();

            $get_commission_total_withdraw = SupplierWallet::select(DB::raw("(COALESCE(sum(supp_wallet_credit_amount), 0)-COALESCE(sum(supp_wallet_debit_amount), 0)) as total_wallet_amount"))->where('supp_wallet_supplier_id', $supplier_id)->where('supp_wallet_status', '!=', 2)->groupBy('supp_wallet_supplier_id')->first();

            $get_commission_credited_all = SupplierWallet::select(DB::raw("(COALESCE(sum(supp_wallet_credit_amount), 0)) as amount_credited"))->where('supp_wallet_supplier_id', $supplier_id)->where('supp_wallet_status', 1)->groupBy('supp_wallet_supplier_id')->first();

            $get_commission_withdraw_all = SupplierWallet::select(DB::raw("(COALESCE(sum(supp_wallet_debit_amount), 0)) as amount_withdrawn"))->where('supp_wallet_supplier_id', $supplier_id)->where('supp_wallet_remarks', 'Money Withdrawn')->where('supp_wallet_status', 1)->groupBy('supp_wallet_supplier_id')->first();

            $get_commission_deducted_all = SupplierWallet::select(DB::raw("(COALESCE(sum(supp_wallet_debit_amount), 0)) as amount_deducted"))->where('supp_wallet_supplier_id', $supplier_id)->where('supp_wallet_remarks', 'Money Deducted')->where('supp_wallet_status', 1)->groupBy('supp_wallet_supplier_id')->first();


            $get_commission_credited_month = SupplierWallet::select(DB::raw("(COALESCE(sum(supp_wallet_credit_amount), 0)) as amount_credited"))->where('supp_wallet_supplier_id', $supplier_id)->where('supp_wallet_month', $month_numeric)->where('supp_wallet_year', $yearname)->where('supp_wallet_status', 1)->groupBy('supp_wallet_supplier_id')->first();

            $get_commission_withdraw_month = SupplierWallet::select(DB::raw("(COALESCE(sum(supp_wallet_debit_amount), 0)) as amount_withdrawn"))->where('supp_wallet_supplier_id', $supplier_id)->where('supp_wallet_month', $month_numeric)->where('supp_wallet_year', $yearname)->where('supp_wallet_remarks', 'Money Withdrawn')->where('supp_wallet_status', 1)->groupBy('supp_wallet_supplier_id')->first();

            $get_commission_deducted_month = SupplierWallet::select(DB::raw("(COALESCE(sum(supp_wallet_debit_amount), 0)) as amount_deducted"))->where('supp_wallet_supplier_id', $supplier_id)->where('supp_wallet_month', $month_numeric)->where('supp_wallet_year', $yearname)->where('supp_wallet_remarks', 'Money Deducted')->where('supp_wallet_status', 1)->groupBy('supp_wallet_supplier_id')->first();


            if (!empty($get_commission_total))
                $total_amount = $get_commission_total->total_wallet_amount;
            else
                $total_amount = 0;

            if (!empty($get_commission_total_withdraw))
                $total_amount_withdraw = $get_commission_total_withdraw->total_wallet_amount;
            else
                $total_amount_withdraw = 0;

            if (!empty($get_commission_credited_all))
                $total_amount_credited_all = $get_commission_credited_all->amount_credited;
            else
                $total_amount_credited_all = 0;

            if (!empty($get_commission_withdraw_all))
                $total_amount_withdraw_all = $get_commission_withdraw_all->amount_withdrawn;
            else
                $total_amount_withdraw_all = 0;

            if (!empty($get_commission_deducted_all))
                $total_amount_deducted_all = $get_commission_deducted_all->amount_deducted;
            else
                $total_amount_deducted_all = 0;


            if (!empty($get_commission_credited_month))
                $total_amount_credited_month = $get_commission_credited_month->amount_credited;
            else
                $total_amount_credited_month = 0;

            if (!empty($get_commission_withdraw_month))
                $total_amount_withdraw_month = $get_commission_withdraw_month->amount_withdrawn;
            else
                $total_amount_withdraw_month = 0;

            if (!empty($get_commission_deducted_month))
                $total_amount_deducted_month = $get_commission_deducted_month->amount_deducted;
            else
                $total_amount_deducted_month = 0;



            return view('mains.my-wallet-own-supplier')->with(compact('rights', 'get_wallet', 'total_amount', 'total_amount_credited_all', 'total_amount_withdraw_all', 'total_amount_deducted_all', 'total_amount_credited_month', 'total_amount_withdraw_month', 'total_amount_deducted_month', 'total_amount_withdraw'));
        } else {
            return redirect()->route('index');
        }
    }






    public function get_withdrawals_supplier_detail(Request $request)
    {
        $supplier_id = $request->get('supplier_id');
        $data = array();
        $get_commissions_withdrawable = SupplierWallet::where('supp_wallet_debit_amount', '!=', null)->where('supp_wallet_supplier_id', $supplier_id)->where('supp_wallet_status', 0)->where('supp_wallet_remarks', 'Money Withdrawn')->get();
        $table = '<div class="table-responsive">
                        <table  id="withdrawals_pending_table" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>S. No.</th>
                              <th>Requested At</th>
                              <th>Amount to be paid</th>
                               <th>Action</th>
                             </tr>
                          </thead>
                          <tbody>';
        $count = 1;
        foreach ($get_commissions_withdrawable as $commissions_withdrawable) {
            $table .= '<tr>
                   <td>' . $count . '</td>
                   <td>' . date('d/m/Y h:i a', strtotime($commissions_withdrawable->created_at)) . '</td>
                    <td>GEL ' . $commissions_withdrawable->supp_wallet_debit_amount . '</td>
                     <td>
                     <button class="btn btn-sm btn-primary approve" id="approve_' . $commissions_withdrawable->supp_wallet_id . '">Approve</button>
                     <button class="btn btn-sm btn-danger reject" id="reject_' . $commissions_withdrawable->supp_wallet_id . '">Reject</button>
                     </td>
                   </tr>';

            $count++;
        }

        if (count($get_commissions_withdrawable) <= 0) {
            $table .= '<tr><td colspan=4>No Requests Found</td></tr>';
        }

        $table .= '</tbody>
     </table>';

        $get_commissions_withdrawable_history = SupplierWallet::where('supp_wallet_debit_amount', '!=', null)->where('supp_wallet_debit_amount', '!=', 0)->where('supp_wallet_supplier_id', $supplier_id)->where('supp_wallet_status', '!=', 0)->where('supp_wallet_remarks', 'Money Withdrawn')->get();

        $table1 = '<div class="table-responsive">
                        <table id="history_table" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>S. No.</th>
                              <th>Requested At</th>
                              <th>Amount</th>
                              <th>Transaction ID</th>
                               <th>Attachments</th>
                               <th>Approved/Rejected At</th>
                               <th>Status</th>
                             </tr>
                          </thead>
                          <tbody>';
        $count = 1;
        foreach ($get_commissions_withdrawable_history as $commissions_withdrawable) {
            $table1 .= '<tr>
                   <td>' . $count . '</td>
                   <td>' . date('d/m/Y h:i a', strtotime($commissions_withdrawable->created_at)) . '</td>
                    <td>GEL ' . $commissions_withdrawable->supp_wallet_debit_amount . '</td>
                    <td>'.$commissions_withdrawable->supp_wallet_approve_transaction_id.'</td>
                    <td>';
                    $withdrawl_attachments=unserialize($commissions_withdrawable->supp_wallet_approve_attachments);
                    $attachment_count=1;
                    if(is_array($withdrawl_attachments)){
                        foreach($withdrawl_attachments as $attachment){
                            $table1.='<a href="'.asset('assets/uploads/supplier_withdrawl_attachments/'.$attachment).'" target="_blank" class="text-primary">Attachment '.$attachment_count.'</a><br>';
                            $attachment_count++;
                        }
                    }

                    $table1.='</td>
                     <td>' . date('d/m/Y h:i a', strtotime($commissions_withdrawable->supp_wallet_approve_reject_at)) . '</td>
                     <td>';
            if ($commissions_withdrawable->supp_wallet_status == 1) {
                $table1 .= '<button class="btn btn-sm btn-primary approve" disabled>Approved</button>';
            } else {
                $table1 .= '<button class="btn btn-sm btn-danger reject" disabled>Rejected</button>';
            }


            $table1 .= '</td>
                   </tr>';

            $count++;
        }

        $table1 .= '</tbody>
     </table>';



        $data["withdrawals_pending"] = $table;
        $data["history_table"] = $table1;

        echo json_encode($data);
    }



    public function withdrawals_supplier_approval(Request $request)
    {
        if (session()->has('travel_users_id')) {

            $supp_wallet_array=explode('_',$request->get('action_id'));
            $supp_wallet_id = $supp_wallet_array[1];
            $supp_wallet_answer = $supp_wallet_array[0];
            $remarks = $request->get('remarks');
            $transaction_id = $request->get('transaction_id');
            $withdrawl_attachments=array();

            //multifile uploading
            if ($request->hasFile('document_img')) {
                foreach ($request->file('document_img') as $file) {
                $extension = strtolower($file->getClientOriginalExtension());
                if ($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "pdf") {
                    $image_name = $file->getClientOriginalName();
                    $image_booking = time() . "-" . $image_name;
                    $dir1 = 'assets/uploads/supplier_withdrawl_attachments/';
                    $file->move($dir1, $image_booking);
                    $withdrawl_attachments[] = $image_booking;
                }
                }
            }
            $withdrawl_attachments = serialize($withdrawl_attachments);

            if ($supp_wallet_answer == "approve") {
                $get_commission = SupplierWallet::where('supp_wallet_id', $supp_wallet_id)->where('supp_wallet_status', 1)->first();
                if (!empty($get_commission)) {
                    echo "already";
                } else {
                    $approve_update_array = array('supp_wallet_status' => 1,
                                                "supp_wallet_approve_reject_at" => date('Y-m-d H:i:s'),
                                                "supp_wallet_approve_reject_remarks" => $remarks,
                                                "supp_wallet_approve_transaction_id" => $transaction_id,
                                                "supp_wallet_approve_attachments" => $withdrawl_attachments,
                                            );

                    $update_commissions = SupplierWallet::where('supp_wallet_id', $supp_wallet_id)->update($approve_update_array);

                    if ($update_commissions) {
                        echo "success";
                    } else {
                        echo "fail";
                    }
                }
            } else if ($supp_wallet_answer == "reject") {
                $get_commission = SupplierWallet::where('supp_wallet_id', $supp_wallet_id)->where('supp_wallet_status', 2)->first();
                if (!empty($get_commission)) {
                    echo "already";
                } else {
                    $approve_update_array = array('supp_wallet_status' => 2, "supp_wallet_approve_reject_at" => date('Y-m-d H:i:s'), "supp_wallet_approve_reject_remarks" => $remarks);

                    $update_commissions = SupplierWallet::where('supp_wallet_id', $supp_wallet_id)->update($approve_update_array);

                    if ($update_commissions) {
                        echo "success";
                    } else {
                        echo "fail";
                    }
                }
            } else {
                echo "invalid_answer";
            }
        } else {
            echo "invalid_user";
        }
    }


    public function suppliers_operation(Request $request)
    {
        $supplier_id = $request->get('supplier_action_id');
        $operation = $request->get('operation');
        $operation_remarks = $request->get('remarks');
        $operation_amount = $request->get('operation_amount');

        if ($operation == "credit" || $operation == "debit") {
            $insert_supp_wallet = new SupplierWallet;
            $insert_supp_wallet->supp_wallet_supplier_id = $supplier_id;
            if ($operation == "credit") {
                $insert_supp_wallet->supp_wallet_credit_amount = round($operation_amount);
                $insert_supp_wallet->supp_wallet_remarks = "Money Added";
            } else {
                $insert_supp_wallet->supp_wallet_debit_amount = round($operation_amount);
                $insert_supp_wallet->supp_wallet_remarks = "Money Deducted";
            }
            $insert_supp_wallet->supp_wallet_month = date('m');
            $insert_supp_wallet->supp_wallet_year = date('Y');
            $insert_supp_wallet->supp_wallet_date = date('Y-m-d');
            $insert_supp_wallet->supp_wallet_time = date('H:i:s');
            $insert_supp_wallet->supp_wallet_approve_reject_remarks = $operation_remarks;
            if ($insert_supp_wallet->save()) {
                $get_commission_total = SupplierWallet::select(DB::raw("(COALESCE(sum(supp_wallet_credit_amount), 0)-COALESCE(sum(supp_wallet_debit_amount), 0)) as total_wallet_amount"))->where('supp_wallet_supplier_id', $supplier_id)->where('supp_wallet_status', 1)->groupBy('supp_wallet_supplier_id')->first();

                if (!empty($get_commission_total))
                    $total_amount = "GEL " . $get_commission_total->total_wallet_amount;
                else
                    $total_amount = "GEL 0";

                echo "success_" . $total_amount;
            } else {
                echo "fail";
            }
        } else {
            echo "fail";
        }
    }
}
