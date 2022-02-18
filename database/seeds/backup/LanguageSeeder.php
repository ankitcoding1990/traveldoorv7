<?php

use App\Languages;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = array(
  array('language_id' => '1','language_name' => 'English','iso_639_no' => 'en','language_created_by' => '1','status' => '1','created_at' => '2019-11-06 03:16:24','updated_at' => '2019-11-06 03:16:24'),
  array('language_id' => '2','language_name' => 'Georgian','iso_639_no' => 'ka','language_created_by' => '1','status' => '1','created_at' => '2019-11-06 03:17:39','updated_at' => '2019-11-06 03:17:39'),
  array('language_id' => '3','language_name' => 'Russian','iso_639_no' => 'ru','language_created_by' => '1','status' => '1','created_at' => '2019-11-06 03:18:12','updated_at' => '2019-11-06 03:18:12'),
  array('language_id' => '4','language_name' => 'Punjabi','iso_639_no' => 'pa','language_created_by' => '1','status' => '1','created_at' => '2019-11-07 16:33:55','updated_at' => '2019-11-07 16:33:55'),
  array('language_id' => '5','language_name' => 'Hindi','iso_639_no' => 'hin','language_created_by' => '1','status' => '1','created_at' => '2020-01-20 02:22:49','updated_at' => '2020-01-20 02:22:49'),
  array('language_id' => '6','language_name' => 'Arabic','iso_639_no' => 'ar','language_created_by' => '1','status' => '1','created_at' => '2020-01-20 02:23:37','updated_at' => '2020-01-20 02:23:37'),
  array('language_id' => '7','language_name' => 'Spanish','iso_639_no' => 'es','language_created_by' => '1','status' => '1','created_at' => '2020-01-20 02:24:28','updated_at' => '2020-01-20 02:24:28'),
  array('language_id' => '8','language_name' => 'Polish','iso_639_no' => 'pol','language_created_by' => '1','status' => '1','created_at' => '2020-01-20 02:26:43','updated_at' => '2020-01-20 02:26:43'),
  array('language_id' => '9','language_name' => 'German','iso_639_no' => 'de','language_created_by' => '1','status' => '1','created_at' => '2020-01-20 02:28:50','updated_at' => '2020-01-20 02:28:50'),
  array('language_id' => '10','language_name' => 'French','iso_639_no' => 'fr','language_created_by' => '1','status' => '1','created_at' => '2020-01-20 02:31:14','updated_at' => '2020-01-20 02:31:14'),
  array('language_id' => '11','language_name' => 'Turkish','iso_639_no' => 'tur','language_created_by' => '1','status' => '1','created_at' => '2020-01-27 02:52:51','updated_at' => '2020-01-27 02:52:51'),
  array('language_id' => '12','language_name' => 'Armenian','iso_639_no' => 'hy','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 22:56:43','updated_at' => '2020-03-14 22:56:43'),
  array('language_id' => '13','language_name' => 'Azerbaijani','iso_639_no' => 'az','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 22:57:06','updated_at' => '2020-03-14 22:57:06'),
  array('language_id' => '14','language_name' => 'Chinese','iso_639_no' => 'zh','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 22:57:34','updated_at' => '2020-03-14 22:57:34'),
  array('language_id' => '15','language_name' => 'Danish','iso_639_no' => 'da','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 22:57:56','updated_at' => '2020-03-14 22:57:56'),
  array('language_id' => '16','language_name' => 'Greek','iso_639_no' => 'el','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 22:59:20','updated_at' => '2020-03-14 22:59:20'),
  array('language_id' => '17','language_name' => 'Italian','iso_639_no' => 'it','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 22:59:46','updated_at' => '2020-03-14 22:59:46'),
  array('language_id' => '18','language_name' => 'Japanese','iso_639_no' => 'ja','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 23:00:05','updated_at' => '2020-03-14 23:00:05'),
  array('language_id' => '19','language_name' => 'Korean','iso_639_no' => 'ko','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 23:00:37','updated_at' => '2020-03-14 23:00:37'),
  array('language_id' => '20','language_name' => 'Lithuanian','iso_639_no' => 'lt','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 23:01:00','updated_at' => '2020-03-14 23:01:00'),
  array('language_id' => '21','language_name' => 'Norwegian','iso_639_no' => 'no','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 23:02:27','updated_at' => '2020-03-14 23:02:27'),
  array('language_id' => '22','language_name' => 'Persian','iso_639_no' => 'fa','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 23:02:48','updated_at' => '2020-03-14 23:02:48'),
  array('language_id' => '23','language_name' => 'Portuguese','iso_639_no' => 'pt','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 23:04:43','updated_at' => '2020-03-14 23:04:43'),
  array('language_id' => '24','language_name' => 'Hebrew','iso_639_no' => 'he','language_created_by' => '1','status' => '1','created_at' => '2020-03-14 23:07:57','updated_at' => '2020-03-14 23:07:57'),
  array('language_id' => '25','language_name' => 'Urdu','iso_639_no' => 'ur','language_created_by' => '1','status' => '1','created_at' => '2021-11-12 06:55:49','updated_at' => '2021-11-12 06:55:49')
);

foreach($languages as $key => $value){
    Languages::updateOrCreate(
    [
        'language_name' => $value['language_name'],
    ],[
        'language_name' =>$value['language_name'],
        'iso_639_no' => $value['iso_639_no'],
        'language_created_by' => $value['language_created_by'],
        'status' => $value['status']
    ]

);
}

    }
}
