<section class="band">
  <div class="wrap">
    <div>
      <h2>Need a cab today?</h2>
      <p>Send your route on WhatsApp for an instant fare.</p>
    </div>
    <div class="band-btns">
      <a href="tel:<?php echo BIZ_PHONE; ?>" class="btn btn-ink">Call now</a>
      <a href="<?php echo wa_link('Hi, I need a cab. Please share the fare.'); ?>" class="btn btn-wa" target="_blank" rel="noopener">WhatsApp</a>
    </div>
  </div>
</section>

<footer class="ftr">
  <div class="wrap">
    <div class="ftr-grid">

      <div>
        <div class="ftr-brand">
          <span class="logo-plate">
            <?php if (has_img('logo.png')): ?>
              <img src="assets/img/logo.png" alt="<?php echo BIZ_NAME; ?> - Car Rental & Taxi Service in Bhuj Kutch" loading="lazy">
            <?php else: ?>
              <span class="logo-mark">M</span>
              <span>
                <span class="logo-txt">Madhavi Cab</span>
                <span class="logo-sub">CAB KUTCH</span>
              </span>
            <?php endif; ?>
          </span>
        </div>
        <p class="ftr-about">Car rental, one way taxi and Kutch tour packages operated from Bhuj. Fixed fares, verified local drivers and clean vehicles across Kutch and Gujarat.</p>
        <div class="social">
          <a href="<?php echo FB_URL; ?>" aria-label="Facebook" target="_blank" rel="noopener"><svg viewBox="0 0 24 24"><path d="M14 8.5V6.8c0-.7.2-1.1 1.2-1.1H17V2.6c-.5-.1-1.4-.2-2.4-.2-2.4 0-4 1.4-4 4v2.1H8V12h2.6v9H14v-9h2.6l.4-3.5H14z"/></svg></a>
          <a href="<?php echo IG_URL; ?>" aria-label="Instagram" target="_blank" rel="noopener"><svg viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.2 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.2.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.2 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.2-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.2-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.2-.4-.4-1-.4-2.2-.1-1.3-.1-1.7-.1-4.9s0-3.6.1-4.9c.1-1.2.2-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.2 1-.4 2.2-.4 1.3-.1 1.7-.1 4.9-.1zm0 3.8a6 6 0 100 12 6 6 0 000-12zm0 9.9a3.9 3.9 0 110-7.8 3.9 3.9 0 010 7.8zm7.6-10.1a1.4 1.4 0 11-2.8 0 1.4 1.4 0 012.8 0z"/></svg></a>
        </div>
      </div>

      <div>
        <h4>Quick links</h4>
        <ul class="ftr-list">
          <li><a href="./">Home</a></li>
          <li><a href="vehicle-rental">Car rental in Bhuj</a></li>
          <li><a href="one-way-taxi">One way taxi</a></li>
          <li><a href="fixed-kutch-tour-package">Kutch tour packages</a></li>
          <li><a href="places-to-visit">Places to visit in Kutch</a></li>
          <li><a href="contact">Contact us</a></li>
        </ul>
      </div>

      <div>
        <h4>Popular routes</h4>
        <ul class="ftr-list">
          <?php
            $ftr_routes = fetch_all("SELECT to_city FROM routes WHERE is_active=1 ORDER BY sort_order ASC, id ASC LIMIT 5");
            if (count($ftr_routes)) {
                foreach ($ftr_routes as $fr) {
                    echo '<li><a href="one-way-taxi">Bhuj to ' . e($fr['to_city']) . '</a></li>';
                }
            } else {
                echo '<li><a href="one-way-taxi">Bhuj to Ahmedabad</a></li>';
                echo '<li><a href="one-way-taxi">Bhuj to Rajkot</a></li>';
                echo '<li><a href="one-way-taxi">Bhuj to Dholavira</a></li>';
                echo '<li><a href="one-way-taxi">Bhuj to Mandvi</a></li>';
                echo '<li><a href="one-way-taxi">Bhuj to Dhordo</a></li>';
            }
          ?>
          <li><a href="one-way-taxi" class="ftr-more">View all routes &rarr;</a></li>
        </ul>
      </div>

      <div>
        <h4>Contact us</h4>
        <div class="ftr-g-badge">
          <a href="<?php echo GOOGLE_REVIEW_URL; ?>" target="_blank" rel="noopener" title="View MADHAVI CAB KUTCH reviews on Google">
            <svg viewBox="0 0 24 24" width="16" height="16" style="flex-shrink:0"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
            <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
            <strong>5.0 Google Rating</strong>
          </a>
        </div>
        <ul class="ftr-list ftr-contact">
          <li><i class="fa fa-phone fi"></i><a href="tel:<?php echo BIZ_PHONE; ?>"><?php echo BIZ_PHONE_D; ?></a></li>
          <li><i class="fa fa-envelope-o fi"></i><a href="mailto:<?php echo BIZ_EMAIL; ?>"><?php echo BIZ_EMAIL; ?></a></li>
          <li><i class="fa fa-map-marker fi"></i><a href="<?php echo BIZ_MAP; ?>" target="_blank" rel="noopener">MADHAVI CAB KUTCH, Bhuj</a></li>
        </ul>
        <a href="<?php echo wa_link('Hi, I would like to make an enquiry.'); ?>" class="btn btn-wa btn-sm ftr-wa" target="_blank" rel="noopener">Chat on WhatsApp</a>
      </div>

    </div>

    <div class="ftr-policy">
      <a href="cancellation-policy">Cancellation policy</a>
      <span>&middot;</span>
      <a href="privacy-policy">Privacy policy</a>
      <span>&middot;</span>
      <a href="terms">Terms and conditions</a>
    </div>

    <div class="ftr-bot">
      <span>&copy; <?php echo date('Y'); ?> <?php echo BIZ_NAME; ?>. All rights reserved.</span>
      <span class="credit">Designed and developed by <a href="https://khushicreativetech.in" target="_blank" rel="noopener">
        Khushi Creative Tech</a></span>
    </div>
  </div>
</footer>

<a href="<?php echo wa_link('Hi, I would like to make an enquiry.'); ?>" class="wa-float" aria-label="Chat on WhatsApp" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i></a>

<nav class="mbar" aria-label="Quick contact">
  <a href="tel:<?php echo BIZ_PHONE; ?>"><i class="fa fa-phone"></i>Call</a>
  <a href="<?php echo wa_link('Hi, I would like to make an enquiry.'); ?>" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i>WhatsApp</a>
  <a href="contact"><i class="fa fa-pencil-square-o"></i>Enquiry</a>
</nav>

<script>
/* mobile menu */
var b=document.getElementById('burger'),n=document.getElementById('nav');
if(b&&n){
  b.addEventListener('click',function(){
    var o=n.classList.toggle('open');
    b.setAttribute('aria-expanded',o);
  });
}

/* hero slider */
(function(){
  var hero=document.getElementById('hero');
  if(!hero) return;
  var slides=hero.querySelectorAll('.slide');
  var dotBox=document.getElementById('dots');
  if(slides.length<2||!dotBox) return;

  var i=0,timer=null;

  slides.forEach(function(s,k){
    var d=document.createElement('span');
    if(k===0) d.className='on';
    d.setAttribute('role','button');
    d.setAttribute('aria-label','Slide '+(k+1));
    d.addEventListener('click',function(){ go(k); reset(); });
    dotBox.appendChild(d);
  });
  var dots=dotBox.querySelectorAll('span');

  function go(k){
    slides[i].classList.remove('on');
    dots[i].classList.remove('on');
    i=k;
    slides[i].classList.add('on');
    dots[i].classList.add('on');
  }
  function next(){ go((i+1)%slides.length); }
  function reset(){ if(timer) clearInterval(timer); timer=setInterval(next,6000); }

  if(!window.matchMedia('(prefers-reduced-motion: reduce)').matches){ reset(); }
})();
</script>

</body>
</html>
