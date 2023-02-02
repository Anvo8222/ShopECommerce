<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class MailNotify extends Mailable
{
  use Queueable, SerializesModels;

  private $data = [];
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($data)
  {
    //
    $this->data = $data;
  }

  // public function build()
  // {
  //   return $this->from('anvo8222@gmail.com', 'Nguyen An')
  //     ->subject($this->data['subject'])
  //     ->view('emails/index')
  //     ->with('data', $this->data);
  // }
  /**
   * Get the message envelope.
   *
   * @return \Illuminate\Mail\Mailables\Envelope
   */
  public function envelope()
  {
    // return $this->from('anvo8222@gmail.com', 'Nguyen An')
    //   ->subject($this->data['subject'])
    //   ->view('emails/index')
    //   ->with('data', $this->data);
    return new Envelope(
      from: new Address('anvo8222@gmail.com', 'Nguyen An'),
      subject: 'SHOP NGUYEN AN',
    );
  }

  /**
   * Get the message content definition.
   *
   * @return \Illuminate\Mail\Mailables\Content
   */
  public function content()
  {
    return new Content(
      view: 'emails.index',
      with: [
        'body' => $this->data['body'],
        'price' => $this->data['price'],
        'address' => $this->data['address'],
      ],
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array
   */
  public function attachments()
  {
    return [];
  }
}