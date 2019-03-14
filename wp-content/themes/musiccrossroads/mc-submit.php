<?php

include('includes/Mailchimp.php');

use \DrewM\MailChimp\MailChimp;
$MailChimp = new MailChimp('1b5db8e66498f111cbafdfe67165c61b-us3');

//$result = $MailChimp->get('lists');
//
//print_r($result);

$list_id = '3db373a847';
if ((isset($_POST['email'])) && (strlen(trim($_POST['email'])) > 0)) {
    $email = trim(stripslashes(strip_tags($_POST['email'])));
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
}


$result = $MailChimp->post("lists/$list_id/members", [
    'merge_fields' => ['FNAME'=> $fname, 'LNAME'=>$lname],
    'email_address' => $email,
    'status'        => 'subscribed',
]);

if ($MailChimp->success()) {
    echo '<h3>Thank you for subscribing! You\'ll hear from us soon.</h3><br>
                <a href="#" data-toggle="modal" data-target="#subscribe-modal" class="mt-1 cta-btn text-white text-uppercase ">Close</a>
';
//    print_r($result);
} else {
    $subscriber_hash = $MailChimp->subscriberHash($email);

//    $result = $MailChimp->patch("lists/$list_id/members/$subscriber_hash", [
//        'interests'    => ['d53eda531d'=> true],
//    ]);
    if ($MailChimp->success()) {
        echo '<h3>Thank you for subscribing! You\'ll hear from us soon</h3><br>
                <a href="#" data-toggle="modal" data-target="#subscribe-modal" class="mt-5 cta-btn text-white text-uppercase ">Close</a>
';
//        print_r($result);
    } else {
        echo '<h3>Either you are already subscribed or an error occurred, refresh and try again :)</h3>';

//        echo $MailChimp->getLastError();
//        print_r($MailChimp->getLastResponse());
//        print_r($MailChimp->getLastRequest());
//        $result2 = $MailChimp->get("lists/$list_id/interest-categories/");
//
//        print_r($result2);
    }
}

?>