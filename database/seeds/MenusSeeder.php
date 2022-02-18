<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = array(
            array('id' => '1','menu_pid' => NULL,'order_id' => '0','menu_name' => 'Masters','menu_file' => 'masters.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fas fa-graduation-cap'),
            array('id' => '2','menu_pid' => NULL,'order_id' => '0','menu_name' => 'Agents','menu_file' => 'agents.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-user-secret'),
            array('id' => '3','menu_pid' => NULL,'order_id' => '0','menu_name' => 'Suppliers','menu_file' => 'suppliers.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fas fa-truck'),
            array('id' => '4','menu_pid' => '1','order_id' => '0','menu_name' => 'Languages','menu_file' => 'languages.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '5','menu_pid' => '1','order_id' => '0','menu_name' => 'Vehicles Types','menu_file' => 'vehicles_types.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '6','menu_pid' => '1','order_id' => '0','menu_name' => 'Hotelmeal','menu_file' => 'hotelmeal.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '7','menu_pid' => '1','order_id' => '0','menu_name' => 'Vehicles Type Costs','menu_file' => 'vehicles_type_cost.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '8','menu_pid' => '1','order_id' => '0','menu_name' => 'Amenities','menu_file' => 'amenities.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '9','menu_pid' => '1','order_id' => '0','menu_name' => 'Sub Amenities','menu_file' => 'sub_amenities.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '10','menu_pid' => '1','order_id' => '0','menu_name' => 'Guide Expenses','menu_file' => 'guide_expenses.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '11','menu_pid' => '1','order_id' => '0','menu_name' => 'Enquiry Types','menu_file' => 'enquiry_type.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '12','menu_pid' => '1','order_id' => '0','menu_name' => 'Transfer Master','menu_file' => 'transfer_master.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '13','menu_pid' => '1','order_id' => '0','menu_name' => 'Tour Types','menu_file' => 'tour_type.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '14','menu_pid' => '1','order_id' => '0','menu_name' => 'Hotel Types','menu_file' => 'hotel_type.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '15','menu_pid' => '1','order_id' => '0','menu_name' => 'Activity Types','menu_file' => 'activity_type.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '16','menu_pid' => '1','order_id' => '0','menu_name' => 'Vehicles','menu_file' => 'vehicle.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '17','menu_pid' => '1','order_id' => '0','menu_name' => 'Cities','menu_file' => 'cities.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '18','menu_pid' => '1','order_id' => '0','menu_name' => 'Customer Markups','menu_file' => 'customer_markup.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '19','menu_pid' => '1','order_id' => '0','menu_name' => 'Target Commissions','menu_file' => 'target_commission.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '20','menu_pid' => '1','order_id' => '0','menu_name' => 'Special Offers','menu_file' => 'special_offers.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '21','menu_pid' => '1','order_id' => '0','menu_name' => 'Service Masters','menu_file' => 'service_master.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '22','menu_pid' => '1','order_id' => '0','menu_name' => 'Acceptances','menu_file' => 'acceptance_master.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '23','menu_pid' => '1','order_id' => '0','menu_name' => 'Suggested Cost Guide','menu_file' => 'suggested_cost_guide.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '24','menu_pid' => '1','order_id' => '0','menu_name' => 'Coupons','menu_file' => 'coupon.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '25','menu_pid' => '1','order_id' => '0','menu_name' => 'PDF Maker','menu_file' => 'pdf_master.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '26','menu_pid' => '1','order_id' => '0','menu_name' => 'Vehicle Suggested Cost','menu_file' => 'vehicle_suggested_cost.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '27','menu_pid' => '1','order_id' => '0','menu_name' => 'Service Terms','menu_file' => 'service_terms.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '28','menu_pid' => NULL,'order_id' => '0','menu_name' => 'Income Expenses','menu_file' => '#','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fas fa-credit-card'),
            array('id' => '29','menu_pid' => '28','order_id' => '0','menu_name' => 'Expenses','menu_file' => 'expense.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:04','updated_at' => '2022-01-29 09:48:04','icon_class' => 'fa fa-cogs'),
            array('id' => '30','menu_pid' => '28','order_id' => '0','menu_name' => 'Incomes','menu_file' => 'incomes.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '31','menu_pid' => '28','order_id' => '0','menu_name' => 'Office Incomes','menu_file' => 'office_income.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '32','menu_pid' => '28','order_id' => '0','menu_name' => 'Office Expenses','menu_file' => 'office_expense.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '33','menu_pid' => NULL,'order_id' => '0','menu_name' => 'Restaurants','menu_file' => '#','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fas fa-utensils'),
            array('id' => '34','menu_pid' => '33','order_id' => '0','menu_name' => 'Restaurant Types','menu_file' => 'restaurant-types.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '35','menu_pid' => '33','order_id' => '0','menu_name' => 'Restaurant Categories','menu_file' => 'restaurant-categories.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '36','menu_pid' => '40','order_id' => '0','menu_name' => 'Restaurant','menu_file' => 'restaurants.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '37','menu_pid' => '33','order_id' => '0','menu_name' => 'Restaurant Foods','menu_file' => 'restaurant-foods.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '38','menu_pid' => '1','order_id' => '0','menu_name' => 'Countries','menu_file' => 'countries.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '39','menu_pid' => NULL,'order_id' => '0','menu_name' => 'Enquiry Management','menu_file' => 'enquiries.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fas fa-question-circle'),
            array('id' => '40','menu_pid' => NULL,'order_id' => '0','menu_name' => 'Service Management','menu_file' => 'service-management','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fas fa-hand-holding'),
            array('id' => '41','menu_pid' => '40','order_id' => '0','menu_name' => 'Hotel','menu_file' => 'hotels.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '42','menu_pid' => '40','order_id' => '0','menu_name' => 'Activity','menu_file' => 'activities.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '43','menu_pid' => '40','order_id' => '0','menu_name' => 'Guide','menu_file' => 'guides.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '44','menu_pid' => '40','order_id' => '0','menu_name' => 'SightSeeing','menu_file' => 'sightseeings.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '45','menu_pid' => '40','order_id' => '0','menu_name' => 'Transfer','menu_file' => 'transfers.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs'),
            array('id' => '46','menu_pid' => '40','order_id' => '0','menu_name' => 'Driver','menu_file' => 'drivers.index','newwindow' => '0','user_id' => '1','status' => '1','created_at' => '2022-01-29 09:48:05','updated_at' => '2022-01-29 09:48:05','icon_class' => 'fa fa-cogs')
          );

        foreach ($menus as $key => $menu)
            Menu::updateOrCreate(
                [
                    'id' => $menu['id']
                ],
                [
                    'menu_pid' => $menu['menu_pid'],
                    'menu_name' => $menu['menu_name'],
                    'order_id' => $menu['order_id'],
                    'menu_file' => $menu['menu_file'],
                    'newwindow' => $menu['newwindow'],
                    'user_id' => $menu['user_id'],
                    'status' => $menu['status'],
                    'icon_class' => $menu['icon_class'],
                ]
            );
    }
}
