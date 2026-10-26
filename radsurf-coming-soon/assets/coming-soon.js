(function(){
var cv=document.getElementById('rs-sea'); if(!cv) return;
var S={sound:false}, self={canvas:{current:cv}, state:S, m:{x:.5,y:.5,sx:.5,sy:.5}, ripples:[], t0:performance.now(),
  sparks:Array.from({length:140},function(){return {x:Math.random(),y:Math.random(),p:Math.random()*6.28,w:4+Math.random()*16};}),
  clouds:Array.from({length:6},function(){return {x:Math.random(),y:.08+Math.random()*.3,s:.6+Math.random()*.9,v:.004+Math.random()*.006};}),
  setState:function(o){Object.assign(S,o);var b=document.querySelector('#rs-sound span'); if(b) b.textContent=S.sound?'SOUND ON':'HEAR THE WAVES';}};
var proto={
draw:function(now){
    const c = this.canvas.current; if (!c) return;
    const w = c.clientWidth, h = c.clientHeight; if (!w || !h) return;
    const d = Math.min(devicePixelRatio || 1, 2);
    if (c.width !== Math.round(w * d) || c.height !== Math.round(h * d)) { c.width = Math.round(w * d); c.height = Math.round(h * d); }
    const x = c.getContext('2d'); x.setTransform(d, 0, 0, d, 0, 0);
    const t = (now - this.t0) / 1000, m = this.m; m.sx += (m.x - m.sx) * 0.03; m.sy += (m.y - m.sy) * 0.03;
    const hz = h * (w < 640 ? 0.6 : 0.56);
    let g = x.createLinearGradient(0, 0, 0, hz);
    g.addColorStop(0, '#16618a'); g.addColorStop(0.45, '#5fb3d3'); g.addColorStop(0.82, '#bfe6ee'); g.addColorStop(1, '#ffe0a8');
    x.fillStyle = g; x.fillRect(0, 0, w, hz + 2);
    const sx = w * (0.72 + (m.sx - 0.5) * 0.06), sy = hz - Math.min(w, h) * 0.11 + Math.sin(t * 0.25) * 4 + (m.sy - 0.5) * 12, sr = Math.min(w, h) * 0.075;
    g = x.createRadialGradient(sx, sy, 0, sx, sy, sr * 9);
    g.addColorStop(0, 'rgba(255,236,190,.85)'); g.addColorStop(0.12, 'rgba(255,214,150,.45)'); g.addColorStop(0.4, 'rgba(255,200,140,.12)'); g.addColorStop(1, 'rgba(255,200,140,0)');
    x.fillStyle = g; x.fillRect(0, 0, w, hz);
    x.fillStyle = '#fff6df'; x.beginPath(); x.arc(sx, sy, sr, 0, 6.283); x.fill();
    for (const cl of this.clouds) {
      cl.x += cl.v / 60; if (cl.x > 1.3) cl.x = -0.3;
      const cx = cl.x * w, cy = cl.y * hz, s = cl.s * Math.min(w, 1400) * 0.12;
      for (let k = 0; k < 5; k++) {
        const ox = (k - 2) * s * 0.55, oy = -Math.abs(k - 2) * -s * 0.08, r = s * (0.55 - Math.abs(k - 2) * 0.09);
        g = x.createRadialGradient(cx + ox, cy + oy, 0, cx + ox, cy + oy, r);
        g.addColorStop(0, 'rgba(255,255,255,.75)'); g.addColorStop(0.6, 'rgba(255,250,240,.35)'); g.addColorStop(1, 'rgba(255,250,240,0)');
        x.fillStyle = g; x.beginPath(); x.ellipse(cx + ox, cy + oy, r, r * 0.45, 0, 0, 6.283); x.fill();
      }
    }
    g = x.createLinearGradient(0, hz, 0, h);
    g.addColorStop(0, '#3a95b5'); g.addColorStop(0.35, '#1E6D93'); g.addColorStop(1, '#06253b');
    x.fillStyle = g; x.fillRect(0, hz, w, h - hz);
    for (const sp of this.sparks) {
      const yy = hz + Math.pow(sp.y, 1.7) * (h - hz) * 0.75;
      const spread = 0.04 + (yy - hz) / (h - hz) * 0.22;
      const xx = sx + (sp.x - 0.5) * w * spread * 2 + Math.sin(t * 0.8 + sp.p) * 8;
      const a = Math.max(0, Math.sin(t * 2.4 + sp.p)) * (1 - sp.y * 0.7);
      if (a < 0.05) continue;
      x.fillStyle = 'rgba(255,240,205,' + (a * 0.85).toFixed(3) + ')';
      x.fillRect(xx - sp.w / 2, yy, sp.w * (1 - sp.y * 0.4), 1.6 + sp.y * 1.4);
    }
    const L = 7;
    for (let i = 0; i < L; i++) {
      const k = i / (L - 1), base = hz + Math.pow(k, 1.6) * (h - hz) * 0.95 + 6;
      const amp = 2 + k * k * 26, len = 140 + k * 520, sp = 0.5 + k * 0.9, ph = i * 1.7;
      const push = (m.sx - 0.5) * 40 * k;
      const yAt = X => base + Math.sin((X + push) / len * 6.283 + t * sp + ph) * amp + Math.sin((X - push) / (len * 0.43) * 6.283 - t * sp * 1.3 + ph) * amp * 0.35;
      x.beginPath(); x.moveTo(0, h);
      for (let X = 0; X <= w + 8; X += 8) x.lineTo(X, yAt(X));
      x.lineTo(w, h); x.closePath();
      g = x.createLinearGradient(0, base - amp, 0, base + 160);
      const top = k < 0.5 ? [58 - k * 40, 150 - k * 40, 181 - k * 40] : [20, 100 - (k - 0.5) * 80, 140 - (k - 0.5) * 80];
      g.addColorStop(0, 'rgba(' + top.map(Math.round).join(',') + ',0.92)');
      g.addColorStop(1, 'rgba(6,37,59,0.96)');
      x.fillStyle = g; x.fill();
      x.beginPath();
      for (let X = 0; X <= w + 8; X += 8) { const Y = yAt(X); X ? x.lineTo(X, Y) : x.moveTo(X, Y); }
      x.strokeStyle = 'rgba(238,250,251,' + (0.18 + k * 0.5).toFixed(2) + ')'; x.lineWidth = 0.8 + k * 2.4; x.stroke();
      if (k > 0.45) {
        x.fillStyle = 'rgba(255,255,255,' + (0.35 + k * 0.4).toFixed(2) + ')';
        for (let X = (t * 30 * sp + i * 37) % 23; X < w; X += 23) { const Y = yAt(X); x.beginPath(); x.arc(X, Y + 3 + Math.sin(X * 0.3 + t) * 2.5, 0.8 + k * 1.4, 0, 6.283); x.fill(); }
      }
    }
    this.ripples = this.ripples.filter(r => now - r.t < 1800);
    for (const r of this.ripples) {
      const p = (now - r.t) / 1800;
      for (let j = 0; j < 3; j++) {
        const q = Math.max(0, p - j * 0.12); if (!q) continue;
        x.strokeStyle = 'rgba(255,255,255,' + ((1 - q) * 0.7).toFixed(3) + ')'; x.lineWidth = 2;
        x.beginPath(); x.ellipse(r.x, r.y, q * 160, q * (r.y > hz ? 48 : 160), 0, 0, 6.283); x.stroke();
      }
    }
    g = x.createRadialGradient(w * 0.3, h * 0.5, 0, w * 0.3, h * 0.5, Math.max(w, h) * 0.75);
    g.addColorStop(0, 'rgba(6,37,59,.28)'); g.addColorStop(1, 'rgba(6,37,59,0)');
    x.fillStyle = g; x.fillRect(0, 0, w, h);
  },
toggleSound:function(){
    var self=this;
    if(!this.audio){ this.audio=new Audio(window.RADSURF_CS_AUDIO||'ocean-waves.mp3'); this.audio.loop=true; this.audio.volume=0; this.audio.preload='auto'; }
    var on=!this.state.sound, au=this.audio;
    clearInterval(this.fade);
    if(on){ var p=au.play(); if(p&&p.catch) p.catch(function(e){console.warn('audio',e&&e.message);}); }
    this.fade=setInterval(function(){
      au.volume=Math.max(0,Math.min(0.8,au.volume+(on?0.05:-0.08)));
      if(on&&au.volume>=0.8) clearInterval(self.fade);
      if(!on&&au.volume<=0){ clearInterval(self.fade); au.pause(); }
    },60);
    this.setState({sound:on});
  }
};
Object.assign(self,proto);
addEventListener('pointermove',function(e){self.m.x=e.clientX/innerWidth;self.m.y=e.clientY/innerHeight;});
addEventListener('pointerdown',function(e){if(e.target.closest&&e.target.closest('a,button,input,form,textarea'))return;self.ripples.push({x:e.clientX,y:e.clientY,t:performance.now()});});
var btn=document.getElementById('rs-sound'); if(btn) btn.addEventListener('click',function(){self.toggleSound();});
var err=0; (function loop(now){requestAnimationFrame(loop); try{self.draw(now||performance.now());}catch(e){if(!err){err=1;console.error(e);}}})();
})();
