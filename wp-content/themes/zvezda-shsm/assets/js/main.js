document.addEventListener('DOMContentLoaded', () => {
 const burger=document.querySelector('.burger'), menu=document.querySelector('.mobile-nav');
 const close=()=>{menu?.classList.remove('open');menu?.setAttribute('aria-hidden','true');burger?.setAttribute('aria-expanded','false');document.body.classList.remove('menu-open');};
 burger?.addEventListener('click',()=>{menu?.classList.add('open');menu?.setAttribute('aria-hidden','false');burger.setAttribute('aria-expanded','true');document.body.classList.add('menu-open');});
 menu?.querySelector('.close')?.addEventListener('click',close);
 menu?.querySelectorAll('a').forEach(a=>a.addEventListener('click',close));
 document.querySelector('.topbar .tb-close')?.addEventListener('click',()=>document.querySelector('.topbar')?.classList.add('hidden'));
 const videoCard=document.querySelector('#videoCard[data-video-url]');
 const loadVideo=()=>{
  if(!videoCard || videoCard.dataset.loaded==='true') return;
  let videoId='';
  try{
   const url=new URL(videoCard.dataset.videoUrl);
   if(url.hostname==='youtu.be') videoId=url.pathname.split('/').filter(Boolean)[0]||'';
   else if(url.hostname.endsWith('youtube.com')){
    videoId=url.searchParams.get('v')||'';
    if(!videoId){const parts=url.pathname.split('/').filter(Boolean);const marker=parts.findIndex(part=>['embed','shorts','live'].includes(part));if(marker>=0)videoId=parts[marker+1]||'';}
   }
  }catch(error){}
  if(!/^[A-Za-z0-9_-]{11}$/.test(videoId)) return;
  const iframe=document.createElement('iframe');
  iframe.src='https://www.youtube-nocookie.com/embed/'+videoId+'?autoplay=1&rel=0';
  iframe.title='Видео ФК Супер Нова';
  iframe.allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
  iframe.allowFullscreen=true;
  iframe.loading='eager';
  iframe.style.cssText='display:block;width:100%;height:100%;min-height:320px;border:0;position:absolute;inset:0';
  videoCard.replaceChildren(iframe);
  videoCard.dataset.loaded='true';
 };
 videoCard?.addEventListener('click',loadVideo);
 videoCard?.addEventListener('keydown',event=>{if(event.key==='Enter'||event.key===' '){event.preventDefault();loadVideo();}});
 const items=document.querySelectorAll('.reveal:not(.on)');
 if('IntersectionObserver' in window){const observer=new IntersectionObserver(entries=>entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('on');observer.unobserve(e.target);}}),{threshold:.12});items.forEach(x=>observer.observe(x));}
 else items.forEach(x=>x.classList.add('on'));
});