<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = 'options';

    public static function getOptionStatus($page){
        if($page ==1) {
            $status = ['' => 'Select Name', 'email' => 'Email Address', 'password' => 'Password', 'first_name' => 'Student First Name', 
                        'middle_name' => 'Student Middle Name',  'last_name' => 'Student Last Name',  'birth_date' => 'Date of Birth',  'parent_name' => 'Parent or Adult Name',
                        'shipping_street' => 'Street Address',  'shipping_suite' => 'Apartment',  'shipping_city' => 'City',  
                        'shipping_state' => 'State', 'shipping_zip' => 'Zip Code', 'phone' => 'Mobile Number', 'coupon_code' => 'Coupon',
                        'top' => 'Top (if any field validation is triggered)', 'section_student' => 'Student Legal Name Section', 
                        'section_login' => 'Create a Login Section','section_coupon' => 'Coupon Code Section', 
                        'section_mail' => 'Mail Your Certificate Section','section_mail_tooltip' => 'Mail Your Certificate Tool Tip', 
                        'section_envelope' => 'Envelope Preview Section'];
        } else if($page ==2) {
            $status = ['' => 'Select Name', 'card_number' => 'Card Number', 'card_expired' => 'Expiration Date', 'card_code' => 'Card Security Code',  'card_name' => 'Card Holder Name',
                     'billing_zip' => 'Billing Zip Code', 'top2' => 'Top (if any field validation is triggered)', 'url' => 'Terms of Service Link'];
        }
      

       

        return $status;
    }

    public static function getOptionStatusKey($page){
        if($page ==1) {
            $status = ['' => '', 'First Name' => 'first_name', 'Middle Name' => 'middle_name', 'Last Name' => 'last_name'];
        } else if($page ==2) {
            $status = ['' => 'Select Name', 'First Name' => 'first_name', 'Middle Name' => 'middle_name', 'Last Name' => 'last_name'];
        }
      

       

        return $status;
    }

}
