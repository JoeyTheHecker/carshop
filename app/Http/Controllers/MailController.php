<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OutbidMail;
use App\Mail\ReceiptMail;
use App\Mail\pendingApprovalMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyApprovedMail;
use App\Mail\NotifyBannedMail;

class MailController extends Controller
{
    public static function sendMail($address, $data)
    {
        Mail::to($address)->send(new OutbidMail($data));
        return;
    }

    // public static function sendReceipt($address, $data)
    // {
    //     Mail::to($address)->send(new ReceiptMail($data));
    //     return;
    // }
    // public static function sendRfShopCopy($data)
    // {
    //     Mail::to("bidding@rfshop.com.ph")->send(new RfShopReceiptMail($data));
    //     return;
    // }
    public static function sendPendingApproval($address,$data)
    {
        Mail::to($address)->send(new pendingApprovalMail($data));
        return;
    }

    public static function sendNotifApproved($address, $data)
    {
        Mail::to($address)->send(new NotifyApprovedMail($data));
    }

    public static function sendNotifBanned($address, $data)
    {
        Mail::to($address)->send(new NotifyBannedMail($data));
    }
}
