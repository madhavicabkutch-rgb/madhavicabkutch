<?php
$page_title    = "Cancellation & Refund Policy | Madhavi Cab Kutch";
$page_desc     = "Cancellation and refund policy for car rental, one way taxi, and tour package bookings with Madhavi Cab in Bhuj, Kutch. Zero cancellation fee terms.";
$page_keywords = "cancellation policy madhavi cab, taxi refund policy bhuj, cab booking cancellation terms";
$active        = "";
include 'header.php';
?>

<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Cancellation policy</div>
    <h1>Cancellation policy</h1>
    <p>How cancellations, changes and refunds are handled on bookings made with us.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="legal">
      <p class="legal-date">Last updated: <?php echo date('F Y'); ?></p>

      <h2>Cancelling a booking</h2>
      <p>Cancellations can be made by calling us on <a href="tel:<?php echo BIZ_PHONE; ?>"><?php echo BIZ_PHONE_D; ?></a> or by sending a message on WhatsApp. A cancellation takes effect from the time we receive and acknowledge it, so please wait for our confirmation rather than assuming a message has been read.</p>

      <h2>Cancellation charges</h2>
      <p>For local trips, one way drops and airport transfers:</p>
      <ul>
        <li>Cancelled more than 6 hours before pickup &mdash; no charge</li>
        <li>Cancelled within 6 hours of pickup &mdash; a nominal charge may apply if the vehicle has already been dispatched</li>
        <li>No-show at pickup without informing us &mdash; charged as a dispatched trip</li>
      </ul>
      <p>For multi-day rentals and tour packages:</p>
      <ul>
        <li>Cancelled more than 7 days before the start date &mdash; no charge</li>
        <li>Cancelled between 3 and 7 days before the start date &mdash; a portion of the advance may be retained</li>
        <li>Cancelled within 72 hours of the start date &mdash; the advance is generally not refundable</li>
      </ul>
      <p>During peak season, including Rann Utsav, vehicles are blocked well in advance and these timelines may be applied more strictly. We will tell you the applicable terms at the time of booking.</p>

      <h2>Changes to a confirmed booking</h2>
      <p>Date, time and route changes are accommodated wherever possible at no extra cost, subject to vehicle availability. A change that increases the distance or duration will be requoted before it is confirmed. Where a requested change cannot be met, you may cancel under the terms above.</p>

      <h2>Advance payments</h2>
      <p>Most bookings do not require an advance. Where an advance is taken to block a vehicle for multi-day travel or peak season dates, it is adjusted against the final bill. Refunds of any eligible advance are processed to the original payment method within a reasonable period of the cancellation being confirmed.</p>

      <h2>Cancellation by us</h2>
      <p>In rare cases a booking may need to be cancelled from our side due to a vehicle breakdown, driver unavailability, road closure, weather or other circumstances outside our control. We will make every reasonable effort to arrange a replacement vehicle. If none can be arranged, any advance paid is refunded in full.</p>

      <h2>Third-party arrangements</h2>
      <p>Where we arrange hotel stay, tent city accommodation, permits or entry tickets on your behalf, the cancellation terms of that provider apply to those components. We will share those terms at the time of booking and pass on any refund we receive.</p>

      <h2>Questions</h2>
      <p>For anything relating to a cancellation, contact us on <a href="tel:<?php echo BIZ_PHONE; ?>"><?php echo BIZ_PHONE_D; ?></a> or email <a href="mailto:<?php echo BIZ_EMAIL; ?>"><?php echo BIZ_EMAIL; ?></a>.</p>

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
