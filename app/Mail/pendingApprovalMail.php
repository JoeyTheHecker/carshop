<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class pendingApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    private $firstname = "";
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->firstname = $data['firstname'];
    }

     /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject("Pending Approval Account")
        ->view('mails.pending_approval', ["data" => [
            "firstname" => $this->firstname,
        ]]);
    }
}
