<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JharkhandMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mem_id = $this->data['mem_id'];
        $mem_nm = $this->data['mem_nm'];
        $application_no = $this->data['application_no'];
        $add_city = $this->data['add_city'];
        $add_postofc = $this->data['add_postofc'];
        $add_ps = $this->data['add_ps'];
        $add_dist = $this->data['add_dist'];
        $mem_email = $this->data['mem_email'];
        return $this->from($this->data['from_email'])
        ->subject($this->data['subject'])
        ->view('admin.mail.mailsend.mailbodyJk',compact('mem_id','mem_email','mem_nm','application_no','add_city','add_postofc','add_ps','add_dist',));
    }
}
