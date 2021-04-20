<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function getLangId(){
    /*$ci = &get_instance();
    $lan = $ci->session->userdata('site_lang');
    if($lan=='arabic'){
        return 2;
    }else{
        return 1;
    }*/
    return 1;
}
function getAllCountries(){
    return $country_array = array("Afghanistan", "Aland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Barbuda", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Trty.", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Caicos Islands", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Futuna Islands", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard", "Herzegovina", "Holy See", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Jan Mayen Islands", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea", "Korea (Democratic)", "Kuwait", "Kyrgyzstan", "Lao", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "McDonald Islands", "Mexico", "Micronesia", "Miquelon", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "Nevis", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Principe", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Barthelemy", "Saint Helena", "Saint Kitts", "Saint Lucia", "Saint Martin (French part)", "Saint Pierre", "Saint Vincent", "Samoa", "San Marino", "Sao Tome", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia", "South Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "The Grenadines", "Timor-Leste", "Tobago", "Togo", "Tokelau", "Tonga", "Trinidad", "Tunisia", "Turkey", "Turkmenistan", "Turks Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "US Minor Outlying Islands", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (US)", "Wallis", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");
}
    
function generatePassword($length=9, $strength=0) {
    $vowels = 'aeuy';
    $consonants = 'bdghjmnpqrstvz';
    if ($strength & 1) {
        $consonants .= 'BDGHJLMNPQRSTVWXZ';
    }
    if ($strength & 2) {
        $vowels .= "AEUY";
    }
    if ($strength & 4) {
        $consonants .= '23456789';
    }
    if ($strength & 8) {
        $consonants .= '@#$%';
    }
 
    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}

function initialized_stripe(){
    require_once(APPPATH.'/third_party/stripe-php/init.php');
    
    $stripe = array(
      "secret_key"      => STRIPE_SECRET_KEY,//"gn8Lj9EW1y0ncta5ul40Tr7hDvY5OsXQ",//"37tP6XmxuWPM7eTEDyA88uW2SO73pfuu", //"gn8Lj9EW1y0ncta5ul40Tr7hDvY5OsXQ",
      "publishable_key" => STRIPE_PUBLISHABLE_KEY//"pk_F34Z9EEL7zPhz6gqqzUWutn0zGV6A"//"pk_ZlhI4yEbDZfAzCn1bdsXwColDSg0E" //"pk_F34Z9EEL7zPhz6gqqzUWutn0zGV6A"
    );
    
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
}

function main_banner($type){
    $arr = array();
    $arr['about']                   = 'about_main_banner';
    $arr['connect']                 = 'contact_main_banner';
    $arr['journal']                 = 'journal_main_banner';
    $arr['memberships']             = 'membership_main_banner';
    $arr['ondemand']                = 'classes_main_banner';
    $arr['retreats']                = 'retreats_main_banner';
    $arr['live_stream_classes']     = 'live_stream_main_banner';
    $arr['in_studio']               = 'in_studio_main_banner';
    $arr['private_corporate']       = 'private_corporate_main_banner'; 
    
    if (!array_key_exists($type,$arr)){
        return 'main_banner_picture';
    }else{
        return $arr[$type];
    } 

    
}

function get_interval($type){
    $arr = array();
    $arr['weekly']      = 'day';
    $arr['bi-weekly']   = 'day';
    $arr['month']       = 'month';
    $arr['quarterly']   = 'month';
    $arr['bi-yearly']   = 'month';
    $arr['year']        = 'year';
    return $arr[$type];
}

function get_interval_count($type){
    $arr = array();
    $arr['weekly']     = '7';
    $arr['bi-weekly']  = '14';
    $arr['month']      = '1';
    $arr['quarterly']  = '3';
    $arr['bi-yearly']  = '6';
    $arr['year']       = '1';        
    return $arr[$type];
}

function next_recharge_date($type){
    if($type=='weekly'){
        $next_recharge_date = date('Y-m-d', strtotime('+7 days'));
    }else if($type=="bi-weekly"){
        $next_recharge_date = date('Y-m-d', strtotime('+14 days'));
    }else if($type=='month'){
        $next_recharge_date = date('Y-m-d', strtotime('+1 months'));
    }else if($type=="quarterly"){
        $next_recharge_date = date('Y-m-d', strtotime('+3 months'));
    }else if($type=="bi-yearly"){
        $next_recharge_date = date('Y-m-d', strtotime('+6 months'));
    }else if($type=="year"){
        $next_recharge_date = date('Y-m-d', strtotime('+1 year'));
    }
    return $next_recharge_date;
}

function endDate($type){
    if($type=='week'){
        $next_recharge_date = date('Y-m-d', strtotime('+7 days'));
    }else if($type=='month'){
        $next_recharge_date = date('Y-m-d', strtotime('+1 months'));
    }else if($type=="year"){
        $next_recharge_date = date('Y-m-d', strtotime('+1 year'));
    }
    return $next_recharge_date;
}

?>