@component('mail::message')
# 🚨 New Booking Alert - Action Required

**Booking Reference:** {{ $booking->booking_reference }}
**Status:** {{ ucfirst($booking->booking_status) }}
**Submitted:** {{ $booking->created_at->format('F j, Y g:i A') }}

@component('mail::panel')
## Customer Information
**Name:** {{ $customer->name }}
**Email:** {{ $customer->email }}
**Phone:** {{ $customer->phone ?? 'Not provided' }}
@endcomponent

## Tour Details
**Tour:** {{ $tour->title ?? 'N/A' }}
**Destination:** {{ $destination->name ?? 'N/A' }}
**Tour Period:** {{ $schedule->start_date->format('M j') }} - {{ $schedule->end_date->format('M j, Y') }}
**Customer's Travel Date:** {{ $booking->booking_date->format('F j, Y') }}

## Booking Details
**Number of People:** {{ $booking->number_of_people }}
**Price per Person:** ${{ number_format($schedule->current_price, 2) }}
**Total Amount:** ${{ number_format($booking->total_amount, 2) }}
**Paid Amount:** ${{ number_format($booking->paid_amount, 2) }}
**Pending Amount:** ${{ number_format($booking->pending_amount, 2) }}

@if($booking->special_request)
@component('mail::panel')
## Special Requirements
{{ $booking->special_request }}
@endcomponent
@endif

@component('mail::button', ['url' => url('/admin/bookings/' . $booking->booking_id)])
View in Admin Panel
@endcomponent

@component('mail::panel')
⚠️ **URGENT ACTION REQUIRED**
Please contact {{ $customer->name }} within 24 hours at:
- **Email:** {{ $customer->email }}
- **Phone:** {{ $customer->phone ?? 'Not provided' }}

**Next Steps:**
1. Confirm tour availability and details
2. Send payment instructions
3. Provide detailed itinerary
4. Update booking status in admin panel
@endcomponent

Best regards,
**Rorena Tours Booking System**
@endcomponent
