document.addEventListener('DOMContentLoaded', () => {
 const burger=document.querySelector('.burger'), menu=document.querySelector('.mobile-nav');
 const close=()=>{menu?.classList.remove('open');menu?.setAttribute('aria-hidden','true');burger?.setAttribute('aria-expanded','false');document.body.classList.remove('menu-open');};
 burger?.addEventListener('click',()=>{menu?.classList.add('open');menu?.setAttribute('aria-hidden','false');burger.setAttribute('aria-expanded','true');document.body.classList.add('menu-open');});
 menu?.querySelector('.close')?.addEventListener('click',close);
 menu?.querySelectorAll('a').forEach(a=>a.addEventListener('click',close));
 document.querySelector('.topbar .tb-close')?.addEventListener('click',()=>document.querySelector('.topbar')?.classList.add('hidden'));
 const items=document.querySelectorAll('.reveal:not(.on)');
 if('IntersectionObserver' in window){const observer=new IntersectionObserver(entries=>entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('on');observer.unobserve(e.target);}}),{threshold:.12});items.forEach(x=>observer.observe(x));}
 else items.forEach(x=>x.classList.add('on'));
});