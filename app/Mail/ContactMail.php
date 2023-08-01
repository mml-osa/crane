<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
  use Queueable, SerializesModels;

  public $email;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Request $request)
  {
    $this->email = $request;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this
      ->subject($this->email->subject)
      ->replyTo($this->email->email)
      ->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
      ->to($this->email->mailTo)
      ->markdown('vendor.mail.html.message');
  }
}
