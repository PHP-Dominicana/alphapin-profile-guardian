<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AlphapinEmail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(private $name, private $pin)
	{
		//
	}

	/**
	 * Get the message envelope.
	 *
	 * @return \Illuminate\Mail\Mailables\Envelope
	 */
	public function envelope()
	{
		return new Envelope(
			subject: 'My Test Email',
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
			view: 'mail.alphapin-email-template',
			with: [
					'name' => $this->name,
					'alphapin' => $this->pin,
					'logo' => 'logo.png',
					'email_title' => config('alphapin-profile-guardian.email_title'),
					'email_subtitle' => config('alphapin-profile-guardian.email_subtitle'),
					'email_preheader' => config('alphapin-profile-guardian.email_preheader'),
					'email_body' => config('alphapin-profile-guardian.email_body'),
					'email_footer' => config('alphapin-profile-guardian.email_footer'),
					'email_permission' => config('alphapin-profile-guardian.email_permission'),

				  ],
		);
	}
}