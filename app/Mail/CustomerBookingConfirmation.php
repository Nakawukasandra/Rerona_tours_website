<?php

namespace App\Mail;

use App\Models\Booking; 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerBookingConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Booking Received - ' . $this->booking->booking_reference . ' - Rorena Tours')
                    ->markdown('emails.customer.booking-confirmation')
                    ->with([
                        'booking' => $this->booking,
                        'customer' => $this->booking->user,
                        'schedule' => $this->booking->schedule,
                        'tour' => $this->booking->schedule->tour ?? null,
                        'destination' => $this->booking->schedule->tour->destination ?? null,
                    ]);
    }
}
