<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'NOVA — Power your everyday')</title>
  <meta name="description" content="NOVA প্রিমিয়াম টেক ও ভেষজ প্রোডাক্টস — ক্যাশ অন ডেলিভারি সহ দ্রুত ডেলিভারি।">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
  
  <style>
    /* ============ DESIGN TOKENS (LUXURY LIGHT HERBAL THEME) ============ */
    :root {
      --bg: #F6FAF8;
      --bg-soft: #FFFFFF;
      --panel: #FFFFFF;
      --panel-2: #EEF4F1;
      --stroke: rgba(18, 55, 30, 0.08);
      --stroke-strong: rgba(18, 55, 30, 0.16);
      --text: #0B1910;
      --text-muted: #43554A;
      --text-dim: #6E8175;
      --ion: #124B28;
      --ion-soft: rgba(18, 75, 40, 0.10);
      --ember: #D97706;
      --ember-soft: rgba(217, 119, 6, 0.12);
      --mint: #059669;
      --gold: #F59E0B;
      --radius-lg: 28px;
      --radius-md: 18px;
      --radius-sm: 10px;
      --font-display: 'Space Grotesk', sans-serif;
      --font-body: 'Inter', sans-serif;
      --font-mono: 'JetBrains Mono', monospace;
      --ease: cubic-bezier(.22,1,.36,1);
    }

    * { box-sizing:border-box; margin:0; padding:0; }
    html { scroll-behavior:smooth; }
    body {
      background: var(--bg);
      color: var(--text);
      font-family: var(--font-body);
      line-height: 1.6;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
      position: relative;
    }

    /* ============ STUNNING AMBIENT BACKGROUND EFFECTS ============ */
    .bg-ambient-effects {
      position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden;
    }
    .bg-grid-mesh {
      position: absolute; inset: 0;
      background-image: radial-gradient(rgba(18, 75, 40, 0.05) 1px, transparent 1px);
      background-size: 32px 32px;
      mask-image: radial-gradient(ellipse 70% 60% at 50% 30%, #000 40%, transparent 100%);
      -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 30%, #000 40%, transparent 100%);
    }
    .bg-orb {
      position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.6;
      animation: floatOrb 18s ease-in-out infinite alternate;
    }
    .bg-orb-1 {
      top: -10%; left: -5%; width: 550px; height: 550px;
      background: radial-gradient(circle, rgba(16, 185, 129, 0.18) 0%, transparent 70%);
    }
    .bg-orb-2 {
      top: 25%; right: -8%; width: 600px; height: 600px;
      background: radial-gradient(circle, rgba(245, 158, 11, 0.16) 0%, transparent 70%);
      animation-delay: -6s;
    }
    .bg-orb-3 {
      bottom: 10%; left: 15%; width: 500px; height: 500px;
      background: radial-gradient(circle, rgba(18, 75, 40, 0.12) 0%, transparent 70%);
      animation-delay: -12s;
    }
    @keyframes floatOrb {
      0% { transform: translate(0, 0) scale(1); }
      50% { transform: translate(40px, -30px) scale(1.08); }
      100% { transform: translate(-30px, 40px) scale(0.95); }
    }

    img, svg { display:block; max-width:100%; }
    a { color:inherit; text-decoration:none; }
    ul { list-style:none; }
    button { font-family:inherit; cursor:pointer; border:none; }
    input, select { font-family:inherit; }
    section { position:relative; z-index:1; }

    @media (prefers-reduced-motion: reduce) {
      * { animation-duration:0.01ms !important; animation-iteration-count:1 !important; transition-duration:0.01ms !important; scroll-behavior:auto !important; }
    }

    .wrap { max-width:1240px; margin:0 auto; padding:0 24px; }
    .eyebrow {
      font-family: var(--font-mono);
      font-size: 12.5px;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--ion);
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 600;
    }
    .eyebrow::before {
      content: '';
      width: 7px; height: 7px; border-radius: 50%;
      background: var(--ion);
      box-shadow: 0 0 10px 2px var(--ion);
    }
    h1, h2, h3, h4 { font-family: var(--font-display); font-weight: 700; letter-spacing: -0.01em; color: var(--text); }
    .section-head { max-width: 640px; margin-bottom: 56px; }
    .section-head h2 { font-size: clamp(30px, 4vw, 44px); margin-top: 14px; line-height: 1.12; color: #0B1910; }
    .section-head p { color: var(--text-muted); margin-top: 14px; font-size: 16.5px; max-width: 520px; }
    .section-pad { padding: 110px 0; }
    @media(max-width:760px) { .section-pad { padding: 72px 0; } }

    /* ============ SIGNATURE: CURRENT LINE ============ */
    .current-line {
      position: absolute; top: 0; left: 50%; transform: translateX(-50%);
      width: 2px; height: 100%; z-index: 0; pointer-events: none;
      background: linear-gradient(180deg, transparent 0%, var(--stroke) 8%, var(--stroke) 92%, transparent 100%);
    }
    .current-line .pulse {
      position: absolute; left: 50%; top: -40px; transform: translateX(-50%);
      width: 6px; height: 6px; border-radius: 50%;
      background: var(--ion);
      box-shadow: 0 0 16px 4px var(--ion), 0 0 40px 12px var(--ion-soft);
      animation: travel 7s linear infinite;
    }
    .current-line .pulse.b { animation-delay: 3.4s; background: var(--ember); box-shadow: 0 0 16px 4px var(--ember), 0 0 40px 12px var(--ember-soft); }
    @keyframes travel { 0% { top:-40px; opacity:0; } 6% { opacity:1; } 94% { opacity:1; } 100% { top:100%; opacity:0; } }
    @media(max-width:900px) { .current-line { display: none; } }

    /* ============ NAV ============ */
    .nav {
      position: sticky; top: 0; z-index: 50;
      backdrop-filter: blur(20px) saturate(160%);
      background: rgba(255, 255, 255, 0.85);
      border-bottom: 1px solid var(--stroke);
      box-shadow: 0 4px 20px rgba(18, 55, 30, 0.03);
    }
    .nav-inner { display: flex; align-items: center; justify-content: space-between; height: 76px; }
    .logo { font-family: var(--font-display); font-weight: 800; font-size: 22px; letter-spacing: -0.02em; display: flex; align-items: center; gap: 9px; color: var(--text); }
    .logo .dot { width: 9px; height: 9px; border-radius: 50%; background: var(--ion); box-shadow: 0 0 12px 3px var(--ion); }
    .nav-links { display: flex; gap: 36px; font-size: 14.5px; color: var(--text-muted); font-weight: 500; }
    .nav-links a { transition: color .2s var(--ease); }
    .nav-links a:hover { color: var(--ion); }
    .nav-cta {
      background: var(--ion); color: #FFFFFF; font-weight: 600; font-size: 14px;
      padding: 11px 22px; border-radius: 100px; transition: transform .25s var(--ease), box-shadow .25s var(--ease);
      box-shadow: 0 6px 18px rgba(18, 75, 40, 0.22);
    }
    .nav-cta:hover { transform: translateY(-1px); box-shadow: 0 10px 24px rgba(18, 75, 40, 0.35); }
    @media(max-width:820px) { .nav-links { display: none; } }

    /* ============ HERO SCROLL & STICKY ANIMATION ============ */
    .hero-scroll-section {
      position: relative;
      height: 350vh;
    }
    .hero-sticky-wrap {
      position: sticky;
      top: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      overflow: hidden;
      z-index: 1;
      padding: 40px 0;
    }
    .hero { position: relative; overflow: visible; }
    .hero-bg {
      position: absolute; inset: -10% -10% auto -10%; height: 100vh; z-index: -1;
      background:
        radial-gradient(ellipse 55% 40% at 22% 18%, rgba(16,185,129,0.16), transparent 60%),
        radial-gradient(ellipse 45% 38% at 82% 8%, rgba(245,158,11,0.14), transparent 60%),
        radial-gradient(ellipse 60% 50% at 50% 100%, rgba(18,75,40,0.06), transparent 70%);
      filter: blur(4px);
    }
    .hero-grid {
      display: grid; grid-template-columns: 1.05fr 0.95fr; gap: 40px; align-items: center; width: 100%;
    }
    @media(max-width:900px) {
      .hero-scroll-section { height: 280vh; }
      .hero-sticky-wrap { padding: 20px 0; }
      .hero-grid { grid-template-columns: 1fr; gap: 16px; }
    }

    .hero-copy h1 {
      font-size: clamp(34px, 5.5vw, 66px); line-height: 1.05; margin-top: 14px;
      color: #0B1910; font-weight: 800;
    }
    .hero-copy h1 em { font-style: normal; background: linear-gradient(97deg, var(--ion), #059669); -webkit-background-clip: text; background-clip: text; color: transparent; }
    .hero-copy p.lead { font-size: 17.5px; color: var(--text-muted); max-width: 460px; margin-top: 18px; font-weight: 400; }
    .hero-ctas { display: flex; gap: 14px; margin-top: 28px; flex-wrap: wrap; }

    .btn {
      display: inline-flex; align-items: center; justify-content: center; gap: 8px;
      padding: 15px 28px; border-radius: 100px; font-weight: 600; font-size: 15px;
      transition: transform .28s var(--ease), box-shadow .28s var(--ease), background .28s var(--ease);
      white-space: nowrap;
    }
    .btn-primary { background: linear-gradient(97deg, var(--ion), #059669); color: #fff; box-shadow: 0 12px 32px -8px rgba(18,75,40,0.45); }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 16px 40px -6px rgba(18,75,40,0.6); }
    .btn-ghost { background: #FFFFFF; color: var(--text); border: 1px solid var(--stroke-strong); box-shadow: 0 4px 14px rgba(18,55,30,0.04); }
    .btn-ghost:hover { background: #F1F6F3; transform: translateY(-2px); border-color: var(--ion); }
    .btn-block { width: 100%; }

    .hero-trust { display: flex; gap: 24px; margin-top: 36px; flex-wrap: wrap; }
    .hero-trust div { font-family: var(--font-mono); font-size: 13px; color: var(--text-dim); }
    .hero-trust strong { display: block; font-family: var(--font-display); font-size: 20px; color: var(--text); font-weight: 700; }

    .hero-stage { position: relative; height: 560px; display: flex; align-items: center; justify-content: center; }
    .hero-stage .orbit {
      position: absolute; width: 440px; height: 440px; border-radius: 50%;
      border: 1.5px dashed rgba(18, 75, 40, 0.2);
      animation: spin 26s linear infinite;
    }
    .hero-stage .orbit.o2 { width: 340px; height: 340px; animation-duration: 20s; animation-direction: reverse; border-color: rgba(245, 158, 11, 0.25); }
    @keyframes spin { to { transform: rotate(360deg); } }
    .hero-product {
      position: relative; width: 320px; height: 540px; display: flex; align-items: center; justify-content: center;
      filter: drop-shadow(0 20px 45px rgba(18, 75, 40, 0.12));
      transition: transform 0.15s ease-out;
    }
    .real-bottle-container {
      position: relative; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
    }
    .scroll-product-frame {
      position: relative; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
    }
    .scroll-bottle-canvas {
      width: 100%; height: 100%; object-fit: contain; pointer-events: none;
      filter: drop-shadow(0 16px 36px rgba(0, 0, 0, 0.18));
    }
    .essence-aura {
      position: absolute; top: 18%; left: 50%; transform: translateX(-50%);
      width: 150px; height: 150px; border-radius: 50%;
      background: radial-gradient(circle, rgba(245,158,11,0.55) 0%, rgba(16,185,129,0.2) 50%, transparent 75%);
      z-index: 0; opacity: 0; filter: blur(16px);
      transition: opacity 0.3s ease, transform 0.3s ease;
      pointer-events: none;
    }
    @keyframes float { 0%,100% { transform: translateY(0px) rotate(-2deg); } 50% { transform: translateY(-22px) rotate(2deg); } }
    .hero-chip {
      position: absolute; background: rgba(255, 255, 255, 0.92); border: 1px solid var(--stroke-strong);
      border-radius: 14px; padding: 10px 16px; font-size: 13px; font-family: var(--font-mono); font-weight: 600;
      display: flex; align-items: center; gap: 8px; backdrop-filter: blur(12px);
      box-shadow: 0 10px 25px rgba(18, 55, 30, 0.08); color: var(--text);
      animation: chipfloat 4.5s ease-in-out infinite;
    }
    .hero-chip.c1 { top: 6%; left: -4%; animation-delay: .3s; }
    .hero-chip.c2 { bottom: 12%; right: -6%; animation-delay: 1.1s; }
    @keyframes chipfloat { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
    @media(max-width:900px) { .hero-stage { height: 360px; margin-top: 20px; } .hero-chip { display: none; } }

    /* ============ BENEFIT STRIP ============ */
    .benefit-strip {
      border-top: 1px solid var(--stroke); border-bottom: 1px solid var(--stroke);
      padding: 20px 0; overflow: hidden; background: #FFFFFF;
      box-shadow: 0 4px 14px rgba(18, 55, 30, 0.02);
    }
    .benefit-track { display: flex; gap: 60px; white-space: nowrap; animation: scroll-x 26s linear infinite; width: max-content; }
    .benefit-track span { font-family: var(--font-mono); font-size: 13.5px; color: var(--text-muted); font-weight: 500; letter-spacing: .05em; display: flex; align-items: center; gap: 10px; }
    .benefit-track span::before { content: '◆'; color: var(--ion); font-size: 9px; }
    @keyframes scroll-x { from { transform: translateX(0); } to { transform: translateX(-50%); } }

    /* ============ REVEAL ============ */
    .reveal { opacity: 0; transform: translateY(28px); transition: opacity .8s var(--ease), transform .8s var(--ease); }
    .reveal.in { opacity: 1; transform: translateY(0); }
    .reveal-delay-1.in { transition-delay: .08s; }
    .reveal-delay-2.in { transition-delay: .16s; }
    .reveal-delay-3.in { transition-delay: .24s; }

    /* ============ PRODUCT ICONS ============ */
    .picon-stage {
      position: relative; height: 190px; display: flex; align-items: center; justify-content: center;
      background: radial-gradient(ellipse 70% 60% at 50% 50%, rgba(16,185,129,0.12), transparent 70%);
      border-radius: 20px; margin-bottom: 22px; overflow: hidden;
    }
    .picon { width: 104px; height: 104px; transition: transform .5s var(--ease); }

    /* ============ OFFER CARDS (WHITE THEME) ============ */
    .products-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 22px;
      max-width: 1160px;
      margin: 0 auto;
    }
    @media(max-width: 860px) {
      .products-grid {
        grid-template-columns: 1fr;
      }
    }

    .product-offer-card {
      position: relative;
      background: #FFFFFF;
      color: var(--text);
      border: 1px solid rgba(18,55,30,0.12);
      border-radius: 20px;
      padding: 22px 20px 22px 18px;
      cursor: pointer;
      box-shadow: 0 10px 30px rgba(18, 55, 30, 0.05);
      transition: transform 0.25s var(--ease), box-shadow 0.25s var(--ease), border-color 0.25s var(--ease);
      overflow: hidden;
    }
    .product-offer-card:hover {
      transform: translateY(-4px);
      border-color: var(--ion);
      box-shadow: 0 18px 40px rgba(18, 55, 30, 0.12), 0 0 20px rgba(16,185,129,0.08);
    }
    .product-offer-card.selected {
      border-color: var(--ion);
      background: #FFFFFF;
      box-shadow: 0 0 0 2px var(--ion), 0 16px 38px rgba(18, 75, 40, 0.14);
    }

    .offer-top-badge {
      position: absolute;
      top: 0;
      right: 0;
      background: rgba(18,75,40,0.10);
      color: var(--ion);
      border: 1px solid rgba(18,75,40,0.2);
      border-top: none;
      border-right: none;
      font-size: 12px;
      font-weight: 700;
      padding: 6px 14px;
      border-bottom-left-radius: 12px;
      display: flex;
      align-items: center;
      gap: 6px;
      backdrop-filter: blur(8px);
    }

    .offer-card-inner {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .offer-radio {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      border: 2px solid rgba(18,55,30,0.25);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      transition: border-color 0.2s var(--ease);
    }
    .product-offer-card.selected .offer-radio {
      border-color: var(--ion);
    }
    .radio-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--ion);
      box-shadow: 0 0 10px var(--ion);
      transform: scale(0);
      transition: transform 0.2s var(--ease);
    }
    .product-offer-card.selected .radio-dot {
      transform: scale(1);
    }

    .offer-img-box {
      width: 110px;
      height: 130px;
      border-radius: 14px;
      overflow: hidden;
      background: #F8FAF9;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 6px;
      border: 1px solid rgba(18,55,30,0.08);
    }
    .offer-img-box img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .offer-details {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 4px;
      min-width: 0;
    }

    .offer-title {
      font-size: 17px;
      font-weight: 700;
      color: #0B1910;
      line-height: 1.3;
      margin-top: 4px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .offer-leaf-divider {
      display: flex;
      align-items: center;
      gap: 6px;
      margin: 2px 0 4px;
    }
    .offer-leaf-divider .line {
      flex: 1;
      height: 1px;
      background: rgba(18,55,30,0.1);
    }
    .offer-leaf-divider .leaf {
      font-size: 12px;
      color: var(--ion);
    }

    .offer-price-stack {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }
    .price-row {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 13.5px;
    }
    .price-row .label {
      color: var(--text-muted);
      font-weight: 500;
    }
    .price-row.reg-price .old-val {
      color: var(--text-dim);
      text-decoration: line-through;
      font-weight: 500;
      font-size: 14.5px;
    }
    .price-row.offer-price {
      margin-top: 1px;
    }
    .price-row.offer-price .new-val {
      color: var(--ion);
      font-size: 23px;
      font-weight: 800;
      letter-spacing: -0.01em;
    }

    .offer-tags-row {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
      margin-top: 6px;
    }
    .tag-badge {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      font-size: 11.5px;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 6px;
    }
    .tag-badge.orange-tag {
      background: rgba(217,119,6,0.12);
      color: var(--ember);
      border: 1px solid rgba(217,119,6,0.25);
    }
    .tag-badge.green-tag {
      background: rgba(18,75,40,0.10);
      color: var(--ion);
      border: 1px solid rgba(18,75,40,0.22);
    }

    @media(max-width: 520px) {
      .offer-title {
        white-space: normal;
        font-size: 15.5px;
      }
      .offer-card-inner {
        gap: 10px;
      }
      .offer-img-box {
        width: 90px;
        height: 110px;
      }
    }

    /* ============ FEATURED ============ */
    .featured-wrap {
      background: #FFFFFF;
      border: 1px solid var(--stroke); border-radius: var(--radius-lg);
      box-shadow: 0 16px 40px rgba(18,55,30,0.06);
      display: grid; grid-template-columns: 1fr 1fr; align-items: center; overflow: hidden;
      position: relative;
    }
    @media(max-width:900px) { .featured-wrap { grid-template-columns: 1fr; } }
    .featured-visual {
      position: relative; height: 440px; display: flex; align-items: center; justify-content: center;
      background: radial-gradient(circle at 50% 40%, rgba(16,185,129,0.12), transparent 65%);
    }
    .featured-visual .picon { width: 220px; height: 220px; animation: float 6s ease-in-out infinite; filter: drop-shadow(0 20px 40px rgba(18,75,40,0.2)); }
    .featured-copy { padding: 56px; }
    @media(max-width:760px) { .featured-copy { padding: 36px 28px 44px; } }
    .featured-copy h3 { font-size: clamp(26px, 3.4vw, 36px); margin-top: 14px; color: #0B1910; }
    .featured-copy p.desc { color: var(--text-muted); margin-top: 14px; font-size: 15.5px; }
    .featured-benefits { margin-top: 26px; display: flex; flex-direction: column; gap: 12px; }
    .featured-benefits li { display: flex; align-items: center; gap: 12px; font-size: 14.5px; color: var(--text); }
    .featured-benefits li::before { content: ''; width: 18px; height: 18px; border-radius: 50%; background: var(--ion-soft); border: 1px solid var(--ion); flex-shrink: 0; }
    .featured-price { display: flex; align-items: baseline; gap: 12px; margin-top: 28px; }
    .featured-price .now { font-family: var(--font-mono); font-size: 32px; font-weight: 700; color: var(--ion); }
    .featured-price .old { font-family: var(--font-mono); color: var(--text-dim); text-decoration: line-through; font-size: 17px; }
    .featured-copy .btn { margin-top: 26px; }

    /* ============ VIDEO ============ */
    .video-card {
      position: relative; border-radius: var(--radius-lg); overflow: hidden;
      border: 1px solid var(--stroke); aspect-ratio: 16/8; max-height: 520px;
      background: #FFFFFF;
      box-shadow: 0 24px 60px rgba(18,55,30,0.10);
    }
    .video-card::before {
      content: ''; position: absolute; inset: 0;
      background: radial-gradient(circle at 30% 30%, rgba(16,185,129,0.15), transparent 55%), radial-gradient(circle at 75% 75%, rgba(245,158,11,0.12), transparent 55%);
    }
    .video-card video { width: 100%; height: 100%; object-fit: cover; position: relative; z-index: 1; }
    .video-play {
      position: absolute; inset: 0; z-index: 2; display: flex; align-items: center; justify-content: center;
      background: rgba(11,25,16,0.3); transition: opacity .4s var(--ease);
    }
    .video-play.hidden { opacity: 0; pointer-events: none; }
    .play-btn {
      width: 84px; height: 84px; border-radius: 50%; background: #FFFFFF; color: var(--ion);
      display: flex; align-items: center; justify-content: center; transition: transform .3s var(--ease);
      box-shadow: 0 20px 50px rgba(18,75,40,0.3);
    }
    .video-play:hover .play-btn { transform: scale(1.08); }
    .play-btn svg { width: 26px; height: 26px; margin-left: 4px; fill: var(--ion); }

    /* ============ WHY CHOOSE ============ */
    .why-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    @media(max-width:900px) { .why-grid { grid-template-columns: repeat(2, 1fr); } }
    @media(max-width:560px) { .why-grid { grid-template-columns: 1fr; } }
    .why-card {
      background: #FFFFFF; border: 1px solid var(--stroke); border-radius: var(--radius-md);
      padding: 26px; transition: transform .35s var(--ease), border-color .35s var(--ease), box-shadow .35s var(--ease);
      box-shadow: 0 10px 30px rgba(18,55,30,0.04);
    }
    .why-card:hover { transform: translateY(-6px); border-color: var(--ion); box-shadow: 0 18px 40px rgba(18,55,30,0.1); }
    .why-icon { width: 44px; height: 44px; border-radius: 12px; background: var(--ion-soft); display: flex; align-items: center; justify-content: center; margin-bottom: 16px; }
    .why-icon svg { width: 22px; height: 22px; stroke: var(--ion); }
    .why-card h4 { font-size: 17px; color: #0B1910; }
    .why-card p { color: var(--text-muted); font-size: 14px; margin-top: 8px; }

    /* ============ ORDER ============ */
    .order-wrap {
      background: #FFFFFF;
      border: 1px solid var(--stroke); border-radius: var(--radius-lg);
      box-shadow: 0 24px 60px rgba(18,55,30,0.08);
      display: grid; grid-template-columns: 1fr 1fr; overflow: hidden;
    }
    @media(max-width:900px) { .order-wrap { grid-template-columns: 1fr; } }
    .order-info { padding: 52px; border-right: 1px solid var(--stroke); background: #F8FAF9; }
    @media(max-width:900px) { .order-info { border-right: none; border-bottom: 1px solid var(--stroke); padding: 40px 28px; } }
    .order-info h3 { font-size: 28px; margin-top: 14px; color: #0B1910; }
    .order-info p { color: var(--text-muted); margin-top: 12px; font-size: 15px; }
    .order-perks { margin-top: 26px; display: flex; flex-direction: column; gap: 14px; }
    .order-perks div { display: flex; gap: 12px; align-items: flex-start; font-size: 14px; color: var(--text-muted); }
    .order-perks strong { color: var(--text); display: block; font-size: 14.5px; }

    .order-form { padding: 52px; background: #FFFFFF; }
    @media(max-width:900px) { .order-form { padding: 32px 24px 40px; } }
    .field { margin-bottom: 16px; }
    .field label { display: block; font-size: 13.5px; font-weight: 600; color: var(--text); margin-bottom: 7px; }
    .field input, .field select {
      width: 100%; background: #F8FAF9; border: 1px solid var(--stroke-strong);
      border-radius: 12px; padding: 13px 16px; color: var(--text); font-size: 15px; outline: none;
      transition: border-color .25s var(--ease), background .25s var(--ease);
    }
    .field input::placeholder { color: var(--text-dim); }
    .field input:focus, .field select:focus { border-color: var(--ion); background: #FFFFFF; box-shadow: 0 0 0 3px rgba(18,75,40,0.12); }
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .field.error input, .field.error select { border-color: var(--ember); }
    .field-msg { font-size: 12px; color: var(--ember); margin-top: 5px; display: none; }
    .field.error .field-msg { display: block; }

    .order-summary {
      margin-top: 8px; background: #F8FAF9; border: 1px solid var(--stroke);
      border-radius: 14px; padding: 18px 20px; font-family: var(--font-mono); font-size: 13.5px;
    }
    .order-summary .row { display: flex; justify-content: space-between; padding: 6px 0; color: var(--text-muted); }
    .order-summary .row.total { color: var(--ion); font-size: 17px; font-weight: 700; border-top: 1px solid var(--stroke); margin-top: 6px; padding-top: 12px; }
    .order-success {
      display: none; text-align: center; padding: 30px 10px; color: var(--mint); font-size: 15px; font-weight: 600;
    }
    .order-success.show { display: block; }
    .order-form.submitted form { display: none; }

    /* ============ STICKY CTA ============ */
    .sticky-cta {
      position: fixed; bottom: 22px; left: 50%; transform: translateX(-50%); z-index: 60;
      background: linear-gradient(97deg, var(--ion), #059669); color: #fff; font-weight: 600; font-size: 15px;
      padding: 15px 30px; border-radius: 100px; box-shadow: 0 16px 40px -8px rgba(18,75,40,0.55);
      display: flex; align-items: center; gap: 8px;
      opacity: 0; pointer-events: none; transition: opacity .35s var(--ease), transform .3s var(--ease);
    }
    .sticky-cta.show { opacity: 1; pointer-events: auto; }
    .sticky-cta:active { transform: translateX(-50%) scale(.96); }

    footer { border-top: 1px solid var(--stroke); padding: 44px 0 100px; background: #FFFFFF; }
    .footer-inner { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; }
    footer p { color: var(--text-dim); font-size: 13.5px; }
  </style>
  @stack('styles')
</head>
<body>

  <!-- STUNNING AMBIENT BACKGROUND EFFECTS -->
  <div class="bg-ambient-effects">
    <div class="bg-grid-mesh"></div>
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>
  </div>

  @include('frontend.partials.header')

  <main>
    @yield('content')
  </main>

  @include('frontend.partials.footer')

  <button class="sticky-cta" id="stickyCta">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2l3 6h6l3-6M4 8h16l-1.5 11a2 2 0 0 1-2 1.8H7.5a2 2 0 0 1-2-1.8L4 8z"/></svg>
    Order Now
  </button>

  @stack('scripts')
</body>
</html>
