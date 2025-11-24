// Small UX enhancements
document.addEventListener('DOMContentLoaded', function(){
  // fade in content
  document.body.style.opacity = 0;
  setTimeout(()=> document.body.style.transition='opacity .3s', 10);
  setTimeout(()=> document.body.style.opacity = 1, 20);
});
