<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OutbidMail extends Mailable
{
    use Queueable, SerializesModels;

    private $product_name = "";
    private $product_id = "";
    private $remaining_time;

    /**
     * Create a new message instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->product_name = $data['product_name'];
        $this->product_id = $data['product_id'];
        $this->remaining_time = $data['time_remaining'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Ensure remaining time is an instance of DateInterval for formatting
        // $remaining_time = new \DateInterval($this->remaining_time);

        $days = $this->remaining_time->format('%d days');
        $hours = $this->remaining_time->format('%h hours');
        $minutes = $this->remaining_time->format('%i minutes');
        $seconds = $this->remaining_time->format('%s seconds');
        $serverIp = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'; // Fallback to localhost if no IP is found

        $data['server_ip'] = $serverIp;
        return $this
            ->subject("Toyota Bidding System")
            ->view('mails.outbid', [
                'data' => [
                    'product_id' => $this->product_id,
                    'product_name' => $this->product_name,
                    'remaining_time' => "$days $hours $minutes $seconds left to bid.",
                    'server_ip' => $serverIp,
                ],
            ]);
    }
}
