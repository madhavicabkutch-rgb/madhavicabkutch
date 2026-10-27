    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /shell -->

<script>
var b=document.getElementById('burger'),s=document.getElementById('side');
if(b&&s){
  b.addEventListener('click',function(){ s.classList.toggle('open'); });
  document.addEventListener('click',function(ev){
    if(window.innerWidth<=760 && s.classList.contains('open')
       && !s.contains(ev.target) && ev.target!==b){
      s.classList.remove('open');
    }
  });
}
/* Confirm before deleting */
document.querySelectorAll('[data-confirm]').forEach(function(el){
  el.addEventListener('click',function(ev){
    if(!confirm(el.getAttribute('data-confirm'))) ev.preventDefault();
  });
});
</script>

</body>
</html>
