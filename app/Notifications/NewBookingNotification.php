<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewBookingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $schedule = $this->booking->schedule;
        $tour = $schedule->tour ?? null;
        $destination = $tour->destination ?? null;

        return (new MailMessage)
            ->subject('URGENT: New Booking - ' . $this->booking->booking_reference)
            ->greeting('New Booking Alert!')
            ->line('A new booking has been submitted and requires immediate attention.')
            ->line('**Booking Reference:** ' . $this->booking->booking_reference)
            ->line('**Customer:** ' . $this->booking->user->name)
            ->line('**Email:** ' . $this->booking->user->email)
            ->line('**Phone:** ' . ($this->booking->user->phone ?? 'Not provided'))
            ->line('**Tour:** ' . ($tour->title ?? 'N/A'))
            ->line('**Destination:** ' . ($destination->name ?? 'N/A'))
            ->line('**Travel Date:** ' . $this->booking->booking_date->format('F j, Y'))
            ->line('**Number of People:** ' . $this->booking->number_of_people)
            ->line('**Total Amount:** $' . number_format($this->booking->total_amount, 2))
            ->when($this->booking->special_request, function ($message) {
                return $message->line('**Special Request:** ' . $this->booking->special_request);
            })
            ->action('View Booking in Admin', url('/admin/bookings/' . $this->booking->booking_id))
            ->line('Please contact the customer within 24 hours to confirm booking details.');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        $tour = $this->booking->schedule->tour ?? null;

        return [
            'booking_id' => $this->booking->booking_id,
            'booking_reference' => $this->booking->booking_reference,
            'customer_name' => $this->booking->user->name,
            'customer_email' => $this->booking->user->email,
            'tour_name' => $tour->title ?? 'N/A',
            'total_amount' => $this->booking->total_amount,
            'number_of_people' => $this->booking->number_of_people,
            'booking_date' => $this->booking->booking_date->format('Y-m-d'),
            'message' => 'New booking from ' . $this->booking->user->name . ' - $' . number_format($this->booking->total_amount, 2),
            'action_url' => url('/admin/bookings/' . $this->booking->booking_id),
            'created_at' => now(),
        ];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->booking_id,
            'message' => 'New booking received from ' . $this->booking->user->name,
        ];
    }
}
