// Legal policy pages: Cancellation Policy, Privacy Policy, Terms & Conditions

import { e, renderLayout } from './layout.js';

export function renderCancellationPolicyPage({ settings = {}, popularRoutes = [] }) {
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';

  const content = `
<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Cancellation policy</div>
    <h1>Cancellation policy</h1>
    <p>How cancellations, changes and refunds are handled on bookings made with us.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="legal" style="background:#fff;border:1px solid #e3e6ea;border-radius:12px;padding:36px;max-width:880px;margin:0 auto">
      <p class="legal-date" style="color:#718096;font-size:14px;margin-bottom:24px">Last updated: October 2026</p>

      <h2 style="font-size:20px;margin:24px 0 10px;color:#141b2e">Cancelling a booking</h2>
      <p style="color:#4a5568;line-height:1.7;margin-bottom:16px">Cancellations can be made by calling us on <a href="tel:${e(bizPhone)}" style="color:#141b2e;font-weight:600">${e(bizPhoneD)}</a> or by sending a message on WhatsApp. A cancellation takes effect from the time we receive and acknowledge it, so please wait for our confirmation rather than assuming a message has been read.</p>

      <h2 style="font-size:20px;margin:24px 0 10px;color:#141b2e">Cancellation charges</h2>
      <p style="color:#4a5568;line-height:1.7;margin-bottom:12px">For local trips, one way drops and airport transfers:</p>
      <ul style="color:#4a5568;line-height:1.8;padding-left:20px;margin-bottom:16px">
        <li>Cancelled more than 6 hours before pickup &mdash; <strong>no charge</strong></li>
        <li>Cancelled within 6 hours of pickup &mdash; a nominal charge may apply if the vehicle has already been dispatched</li>
        <li>No-show at pickup without informing us &mdash; charged as a dispatched trip</li>
      </ul>

      <p style="color:#4a5568;line-height:1.7;margin-bottom:12px">For multi-day rentals and tour packages:</p>
      <ul style="color:#4a5568;line-height:1.8;padding-left:20px;margin-bottom:16px">
        <li>Cancelled more than 7 days before the start date &mdash; <strong>no charge</strong></li>
        <li>Cancelled between 3 and 7 days before the start date &mdash; a portion of the advance may be retained</li>
        <li>Cancelled within 72 hours of the start date &mdash; the advance is generally not refundable</li>
      </ul>
      <p style="color:#4a5568;line-height:1.7;margin-bottom:16px">During peak season, including Rann Utsav, vehicles are blocked well in advance and these timelines may be applied more strictly. We will tell you the applicable terms at the time of booking.</p>

      <h2 style="font-size:20px;margin:24px 0 10px;color:#141b2e">Changes to a confirmed booking</h2>
      <p style="color:#4a5568;line-height:1.7;margin-bottom:16px">Date, time and route changes are accommodated wherever possible at no extra cost, subject to vehicle availability. A change that increases the distance or duration will be requoted before it is confirmed. Where a requested change cannot be met, you may cancel under the terms above.</p>

      <h2 style="font-size:20px;margin:24px 0 10px;color:#141b2e">Advance payments &amp; refunds</h2>
      <p style="color:#4a5568;line-height:1.7;margin-bottom:16px">Most bookings do not require an advance. Where an advance is taken to block a vehicle for multi-day travel or peak season dates, it is adjusted against the final bill. Refunds of any eligible advance are processed to the original payment method within a reasonable period of the cancellation being confirmed.</p>
    </div>
  </div>
</section>
`;

  return renderLayout({
    title: 'Cancellation & Refund Policy | Madhavi Cab Kutch',
    description: 'Cancellation and refund policy for car rental, one way taxi, and tour package bookings with Madhavi Cab in Bhuj, Kutch. Zero cancellation fee terms.',
    canonical: 'https://madhavicabkutch.com/cancellation-policy',
    active: '',
    settings,
    popularRoutes,
    content
  });
}

export function renderPrivacyPolicyPage({ settings = {}, popularRoutes = [] }) {
  const content = `
<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Privacy policy</div>
    <h1>Privacy policy</h1>
    <p>How we handle information collected during enquiries and bookings.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="legal" style="background:#fff;border:1px solid #e3e6ea;border-radius:12px;padding:36px;max-width:880px;margin:0 auto">
      <p class="legal-date" style="color:#718096;font-size:14px;margin-bottom:24px">Last updated: October 2026</p>

      <h2 style="font-size:20px;margin:24px 0 10px;color:#141b2e">Information we collect</h2>
      <p style="color:#4a5568;line-height:1.7;margin-bottom:16px">We collect only the details necessary to carry out your booking: your name, contact phone number, travel dates, pickup location and destination. When you enquire via WhatsApp or phone, you communicate directly with us.</p>

      <h2 style="font-size:20px;margin:24px 0 10px;color:#141b2e">How we use your information</h2>
      <p style="color:#4a5568;line-height:1.7;margin-bottom:16px">Your information is used strictly to coordinate your travel, assign a verified driver, provide emergency assistance, and send invoice receipts if requested. We do not sell, rent, or share personal data with external third parties for marketing purposes.</p>

      <h2 style="font-size:20px;margin:24px 0 10px;color:#141b2e">Driver sharing</h2>
      <p style="color:#4a5568;line-height:1.7;margin-bottom:16px">Your pickup point and phone number are shared with your assigned driver shortly before the scheduled trip to ensure smooth pickup coordination.</p>
    </div>
  </div>
</section>
`;

  return renderLayout({
    title: 'Privacy Policy | Madhavi Cab Kutch',
    description: 'Privacy policy for Madhavi Cab Kutch car rental and taxi booking service in Bhuj. How we protect your personal information.',
    canonical: 'https://madhavicabkutch.com/privacy-policy',
    active: '',
    settings,
    popularRoutes,
    content
  });
}

export function renderTermsPage({ settings = {}, popularRoutes = [] }) {
  const content = `
<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Terms and conditions</div>
    <h1>Terms and conditions</h1>
    <p>Standard terms of service for car rentals, taxi transfers, and tour bookings.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="legal" style="background:#fff;border:1px solid #e3e6ea;border-radius:12px;padding:36px;max-width:880px;margin:0 auto">
      <p class="legal-date" style="color:#718096;font-size:14px;margin-bottom:24px">Last updated: October 2026</p>

      <h2 style="font-size:20px;margin:24px 0 10px;color:#141b2e">Booking Confirmation</h2>
      <p style="color:#4a5568;line-height:1.7;margin-bottom:16px">A booking is confirmed once we communicate vehicle availability and agreed fixed fare via phone or WhatsApp. Driver and vehicle details are dispatched prior to the trip.</p>

      <h2 style="font-size:20px;margin:24px 0 10px;color:#141b2e">Tolls, Parking &amp; Permits</h2>
      <p style="color:#4a5568;line-height:1.7;margin-bottom:16px">Unless explicitly specified as all-inclusive in a custom tour package, highway toll taxes, parking fees, and state road entry taxes are payable at actuals during the journey.</p>

      <h2 style="font-size:20px;margin:24px 0 10px;color:#141b2e">Passenger Conduct &amp; Safety</h2>
      <p style="color:#4a5568;line-height:1.7;margin-bottom:16px">All passengers are expected to observe road safety rules. Consumption of alcohol or illegal substances inside commercial passenger vehicles is strictly prohibited under Gujarat law.</p>
    </div>
  </div>
</section>
`;

  return renderLayout({
    title: 'Terms & Conditions | Madhavi Cab Kutch',
    description: 'Terms and conditions for car rental, one way taxi and tour packages with Madhavi Cab in Bhuj, Kutch.',
    canonical: 'https://madhavicabkutch.com/terms',
    active: '',
    settings,
    popularRoutes,
    content
  });
}
