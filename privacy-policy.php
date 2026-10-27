<?php
$page_title    = "Privacy Policy | Madhavi Cab Kutch";
$page_desc     = "Privacy Policy of Madhavi Cab Kutch. Learn how we collect, protect, and handle your personal data when booking taxis and car rentals in Bhuj, Gujarat.";
$page_keywords = "madhavi cab privacy policy, customer data protection bhuj cab";
$active        = "";
include 'header.php';
?>

<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Privacy policy</div>
    <h1>Privacy policy</h1>
    <p>What information we collect when you contact or book with us, and what we do with it.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="legal">
      <p class="legal-date">Last updated: <?php echo date('F Y'); ?></p>

      <h2>Who we are</h2>
      <p><?php echo BIZ_NAME; ?> operates a car rental and taxi service based in Bhuj, Kutch, Gujarat. This policy explains how we handle the personal information you share with us through this website, WhatsApp, phone or email.</p>

      <h2>Information we collect</h2>
      <p>We collect only what is needed to arrange and complete your travel:</p>
      <ul>
        <li>Your name and mobile number</li>
        <li>Pickup and drop locations, travel dates and timings</li>
        <li>Number of passengers and vehicle preference</li>
        <li>Any additional details you choose to share, such as flight or train timings</li>
        <li>Email address, where you contact us by email</li>
      </ul>
      <p>We do not ask for and do not store payment card details, bank account details or identity document numbers through this website.</p>

      <h2>How your information reaches us</h2>
      <p>The enquiry forms on this website do not store your details on the website itself. When you submit a form, the details you entered are placed into a WhatsApp message that opens on your own device, and nothing is sent until you choose to send it. Your information therefore reaches us through WhatsApp, and is subject to WhatsApp&rsquo;s own terms in transit.</p>

      <h2>How we use it</h2>
      <p>Your information is used to quote a fare, confirm a booking, assign a vehicle and driver, contact you before and during the journey, and follow up on the trip. Contact details may also be used to respond to a question you have asked.</p>

      <h2>Who we share it with</h2>
      <p>Booking details are shared with the driver assigned to your trip, as he needs your name, number and pickup point to complete the journey. Where you ask us to arrange a hotel, tent city stay or permit, the necessary details are shared with that provider. We do not sell, rent or trade your information to anyone for marketing purposes.</p>
      <p>Information may be disclosed where we are required to do so by law, or where it is necessary to protect the safety of a passenger, driver or vehicle.</p>

      <h2>How long we keep it</h2>
      <p>Booking records are retained for as long as needed to service the booking and to meet accounting and legal requirements. Casual enquiries that do not lead to a booking are not retained beyond what is needed to answer them.</p>

      <h2>Cookies and website data</h2>
      <p>This website does not set advertising or tracking cookies of its own. Pages that embed a Google Map may set cookies from Google, governed by Google&rsquo;s own privacy policy. Your browser settings can be used to control or block cookies.</p>

      <h2>Third-party links</h2>
      <p>This website links to external services such as WhatsApp, Google Maps and social media pages. Once you leave this website, the privacy policy of that service applies. We are not responsible for the content or practices of external sites.</p>

      <h2>Your choices</h2>
      <p>You may ask us to confirm what information we hold about you, correct anything that is wrong, or delete your details from our records, except where we are required to retain them. To make such a request, contact us using the details below.</p>

      <h2>Changes to this policy</h2>
      <p>This policy may be updated from time to time. The date at the top of this page shows when it was last revised.</p>

      <h2>Contact</h2>
      <p>For any question about this policy or your information, call <a href="tel:<?php echo BIZ_PHONE; ?>"><?php echo BIZ_PHONE_D; ?></a> or email <a href="mailto:<?php echo BIZ_EMAIL; ?>"><?php echo BIZ_EMAIL; ?></a>.</p>

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
