<?php
$page_title    = "Terms & Conditions | Madhavi Cab Kutch";
$page_desc     = "Read terms & conditions for car rental, outstation taxi and Kutch tour bookings with Madhavi Cab in Bhuj, Gujarat. Transparent policies and fair rates.";
$page_keywords = "madhavi cab terms, car rental terms and conditions, taxi booking policy bhuj";
$active        = "";
include 'header.php';
?>

<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Terms and conditions</div>
    <h1>Terms and conditions</h1>
    <p>The terms that apply when you book a vehicle with us or use this website.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="legal">
      <p class="legal-date">Last updated: <?php echo date('F Y'); ?></p>

      <h2>Agreement</h2>
      <p>By booking a vehicle with <?php echo BIZ_NAME; ?>, or by using this website, you agree to the terms set out below. These terms apply alongside our cancellation policy and privacy policy.</p>

      <h2>Bookings and confirmation</h2>
      <p>A booking is confirmed only once we have acknowledged it by phone, WhatsApp or email. An enquiry submitted through this website is a request for a quote, not a confirmed booking. Vehicle allocation is subject to availability at the time of confirmation.</p>

      <h2>Fares and quotes</h2>
      <p>Fares shown on this website are indicative and may change with fuel prices, season and route conditions. The fare quoted to you at the time of booking is the fare that applies to your trip.</p>
      <p>Unless stated otherwise in your quote, fares include fuel, driver allowance, vehicle maintenance and insurance. The following are charged separately at actuals: toll charges, parking charges, state border permits, monument entry fees, and any additional kilometres beyond an agreed daily minimum. Waiting beyond the agreed free period, and detours added during the journey, may be charged extra.</p>

      <h2>Payment</h2>
      <p>Payment is normally made to the driver at the end of the trip, in cash or by UPI. For multi-day bookings, peak season travel or large group bookings, an advance may be required to block the vehicle; this is adjusted against the final bill. Any outstanding amount is payable on completion of the journey.</p>

      <h2>Vehicles and drivers</h2>
      <p>Vehicles are provided with a driver. Self-drive rental is not offered. We reserve the right to substitute a vehicle of the same or higher category where the booked vehicle becomes unavailable due to breakdown or other operational reasons. Seating capacity stated for each vehicle is the maximum permitted; luggage capacity is limited and large or unusual items should be declared at the time of booking.</p>

      <h2>Passenger responsibilities</h2>
      <p>Passengers are expected to be ready at the agreed pickup time and place. Smoking, consumption of alcohol and carriage of prohibited or hazardous goods are not permitted in our vehicles. Any damage caused to a vehicle by a passenger is chargeable. Passengers are responsible for their own belongings; we are not liable for items left behind in a vehicle, though we will make reasonable efforts to return anything recovered.</p>
      <p>Drivers operate within legal speed limits and prescribed driving hours. Requests to drive faster, skip mandatory rest, or carry passengers beyond the permitted seating capacity will not be accommodated.</p>

      <h2>Delays and route conditions</h2>
      <p>Journey times shown are estimates. Traffic, weather, road works, festival crowds, checkpost queues and other conditions outside our control may cause delays. We are not liable for missed flights, trains, connections or events resulting from such delays, and recommend allowing buffer time for onward travel.</p>

      <h2>Cancellations</h2>
      <p>Cancellations, changes and refunds are governed by our <a href="cancellation-policy">cancellation policy</a>.</p>

      <h2>Third-party arrangements</h2>
      <p>Where we arrange hotel stay, tent city accommodation, permits, entry tickets or guide services on your behalf, we act as a facilitator. The terms and standards of that provider apply to those services, and we are not responsible for their performance.</p>

      <h2>Limitation of liability</h2>
      <p>Our liability in relation to any booking is limited to the value of that booking. We are not liable for indirect or consequential losses. Nothing in these terms limits liability that cannot be limited under applicable law.</p>

      <h2>Website content</h2>
      <p>Content on this website, including text, layout and images, is provided for information. Fares, distances, journey times and package details may change without notice. We take reasonable care to keep information accurate but do not warrant that it is complete or current at all times.</p>

      <h2>Governing law</h2>
      <p>These terms are governed by the laws of India. Any dispute is subject to the jurisdiction of the courts at Bhuj, Kutch, Gujarat.</p>

      <h2>Contact</h2>
      <p>For any question about these terms, call <a href="tel:<?php echo BIZ_PHONE; ?>"><?php echo BIZ_PHONE_D; ?></a> or email <a href="mailto:<?php echo BIZ_EMAIL; ?>"><?php echo BIZ_EMAIL; ?></a>.</p>

    </div>
  </div>
</section>

<style>
.legal{max-width:820px}
.legal-date{font-size:13.5px;color:var(--muted);padding-bottom:22px;margin-bottom:8px;border-bottom:1px solid var(--line)}
.legal h2{font-size:21px;margin:32px 0 10px}
.legal p{font-size:15.5px;color:#39415a;line-height:1.85;margin-bottom:14px}
.legal ul{margin:0 0 18px 0;list-style:none}
.legal li{font-size:15.5px;color:#39415a;line-height:1.8;padding:6px 0 6px 22px;position:relative}
.legal li::before{content:"\2022";position:absolute;left:2px;color:var(--gold);font-weight:700}
.legal a{color:var(--gold-d);font-weight:600}
.legal a:hover{text-decoration:underline}
@media(max-width:760px){ .legal h2{font-size:18px;margin-top:26px} .legal p,.legal li{font-size:15px} }
</style>


<?php include 'footer.php'; ?>
