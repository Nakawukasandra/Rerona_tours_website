@component('mail::message')
# Booking Confirmation

Dear {{ $customer->name }},

Thank you for choosing **Rorena Tours & Safaris**! We have successfully received your booking request and our team will contact you within 24 hours.

@component('mail::panel')
**Your Booking Reference:** {{ $booking->booking_reference }}
**Status:** {{ ucfirst($booking->booking_status) }}
**Submitted:** {{ $booking->created_at->format('F j, Y g:i A') }}
@endcomponent

## Your Adventure Details
**Tour:** {{ $tour->title ?? 'N/A' }}
**Destination:** {{ $destination->name ?? 'N/A' }}
**Tour Duration:** {{ $schedule->start_date->format('M j') }} - {{ $schedule->end_date->format('M j, Y') }}
**Your Travel Date:** {{ $booking->booking_date->format('F j, Y') }}
**Number of Travelers:** {{ $booking->number_of_people }} {{ $booking->number_of_people == 1 ? 'person' : 'people' }}

## Pricing Summary
**Price per Person:** ${{ number_format($schedule->current_price, 2) }}
**Total Amount:** ${{ number_format($booking->total_amount, 2) }}
**Amount Paid:** ${{ number_format($booking->paid_amount, 2) }}
**Balance Due:** ${{ number_format($booking->pending_amount, 2) }}

@if($booking->special_request)
## Your Special Requirements
*We have noted your special requirements:*
{{ $booking->special_request }}
@endif

## What Happens Next?

✅ **Step 1:** Our team reviews your booking (within 24 hours)
📞 **Step 2:** We'll call you to confirm details and availability
💳 **Step 3:** Payment instructions will be provided
📋 **Step 4:** Detailed itinerary and travel information sent
🎒 **Step 5:** Pre-travel briefing and packing list provided

@component('mail::button', ['url' => url('/booking/status/' . $booking->booking_reference)])
Track Your Booking
@endcomponent

## Contact Information
If you have any questions or need to make changes:

📞 **Phone:** +256-800500000
📧 **Email:** bookings@rorenatours.com
🕒 **Office Hours:** Monday - Saturday, 8:00 AM - 6:00 PM
📍 **Location:** Kikumbi, Wakiso, Uganda

## Important Notes
- Keep your booking reference safe: **{{ $booking->booking_reference }}**
- Payment instructions will be sent within 24 hours
- Cancellation policy applies as per our terms and conditions
- Travel insurance is highly recommended

We're excited to make your East African adventure unforgettable!

Best regards,
**The Rorena Tours Team**
*Your Gateway to East African Adventures*

---
*This is an automated confirmation. Please do not reply to this email directly.*
@endcomponent
