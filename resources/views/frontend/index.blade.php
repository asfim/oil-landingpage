@extends('frontend.layouts.app')

@section('title', $settings['site_title'])

@section('content')
<!-- ============ HERO ============ -->
<header class="hero hero-scroll-section" id="heroScrollSection">
  <div class="hero-sticky-wrap">
    <div class="current-line" aria-hidden="true">
      <div class="pulse"></div>
      <div class="pulse b"></div>
    </div>
    <div class="hero-bg"></div>
    <div class="wrap hero-grid">
      <div class="hero-copy">
        <div class="eyebrow reveal in">{{ $settings['hero_eyebrow'] ?? 'নতুন কালেকশন — ৪টি প্রোডাক্ট' }}</div>
        <h1 class="reveal in">{!! $settings['hero_title'] ?? 'আপনার প্রতিদিনকে <em>পাওয়ার আপ</em> করুন' !!}</h1>
        <p class="lead reveal in">{{ $settings['hero_description'] ?? 'প্রিমিয়াম সাউন্ড, স্মার্ট ট্র্যাকিং আর সারাদিনের চার্জ — একসাথে, একটাই ব্র্যান্ডে। Crowns IT-র ৪টি ফ্ল্যাগশিপ প্রোডাক্ট এখন বিশেষ ছাড়ে।' }}</p>
        <div class="hero-ctas reveal in">
          <a href="#order" class="btn btn-primary">{{ $settings['hero_btn_text'] ?? 'Order Now' }}</a>
          <a href="#products" class="btn btn-ghost">View Products</a>
        </div>
        <div class="hero-trust reveal in">
          <div><strong>{{ $settings['hero_rating'] ?? '৪.৮/৫' }}</strong>গ্রাহক রেটিং</div>
        </div>
      </div>
      <div class="hero-stage">
        <div class="orbit"></div>
        <div class="orbit o2"></div>
        <div class="hero-chip c1">{{ $settings['hero_chip_1'] ?? '🌿 ১০০% ভেষজ উপাদান' }}</div>
        <div class="hero-chip c2">{{ $settings['hero_chip_2'] ?? '💧 ১০০ml বিশুদ্ধ তেল' }}</div>
        <div class="hero-product" id="heroBottleWrap">
          <div class="real-bottle-container">
            <div class="scroll-product-frame">
              <canvas id="scrollBottleCanvas" class="scroll-bottle-canvas"></canvas>
            </div>
            <div class="essence-aura" id="essenceAura"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="benefit-strip">
  <div class="benefit-track">
    @if($benefits->count() > 0)
      @foreach($benefits as $benefit)
        <span>{{ $benefit->title }}</span>
      @endforeach
      @foreach($benefits as $benefit)
        <span>{{ $benefit->title }}</span>
      @endforeach
    @else
      <span>প্রিমিয়াম কোয়ালিটি</span><span>ফাস্ট ডেলিভারি</span><span>ক্যাশ অন ডেলিভারি</span><span>সিকিউর প্যাকেজিং</span><span>বেস্ট প্রাইস</span><span>১ বছর ওয়ারেন্টি</span>
      <span>প্রিমিয়াম কোয়ালিটি</span><span>ফাস্ট ডেলিভারি</span><span>ক্যাশ অন ডেলিভারি</span><span>সিকিউর প্যাকেজিং</span><span>বেস্ট প্রাইস</span><span>১ বছর ওয়ারেন্টি</span>
    @endif
  </div>
</div>

<!-- ============ PRODUCTS ============ -->
<section id="products" class="section-pad">
  <div class="wrap">
    <div class="section-head reveal">
      <div class="eyebrow">{{ $settings['collection_eyebrow'] ?? 'আমাদের কালেকশন' }}</div>
      <h2>{{ $settings['collection_title'] ?? '৪টি প্রোডাক্ট, একটাই লক্ষ্য' }}</h2>
      <p>{{ $settings['collection_description'] ?? 'প্রতিটা প্রোডাক্ট বানানো হয়েছে আপনার দিন সহজ করার জন্য — সাউন্ড থেকে চার্জ পর্যন্ত।' }}</p>
    </div>

    <div class="products-grid" id="productGrid">
      @foreach($products as $index => $p)
        <div class="product-offer-card reveal reveal-delay-{{ ($index % 3) + 1 }} {{ $loop->first ? 'selected' : '' }}" data-id="{{ $p->id }}" data-price="{{ $p->price }}">
          @if($p->badge)
          <div class="offer-top-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 3h15v13H1z"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            <span>{{ $p->badge }}</span>
          </div>
          @endif
          
          <div class="offer-card-inner">
            <div class="offer-img-box">
              <div class="offer-img-glow"></div>
              <img src="{{ asset($p->img) }}" alt="{{ $p->name }}" loading="lazy" width="280" height="280">
            </div>
            
            <div class="offer-details">
              <div class="offer-rating-row">
                <span class="stars">★★★★★</span>
                <span class="score">{{ $p->rating }} ({{ $p->reviews }}+ রিভিউ)</span>
              </div>
              <h3 class="offer-title">{{ $p->name }}</h3>
              <p class="offer-subdesc">{{ $p->tagline }}</p>

              <div class="offer-price-stack">
                @if($p->old_price)
                <div class="price-row reg-price">
                  <span class="label">রেগুলার মূল্য:</span>
                  <span class="old-val">৳ {{ number_format($p->old_price, 0) }}</span>
                </div>
                @endif
                <div class="price-row offer-price">
                  <span class="label">অফার মূল্য:</span>
                  <span class="new-val">৳ {{ number_format($p->price, 0) }}</span>
                </div>
              </div>

              <div class="offer-card-action">
                <button type="button" class="btn-card-select">
                  <span>অর্ডার করুন</span>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>


<!-- ============ VIDEO ============ -->
<section id="video" class="section-pad">
  <div class="wrap">
    <div class="section-head reveal">
      <div class="eyebrow">{{ $settings['video_eyebrow'] ?? 'লাইভ ডেমো' }}</div>
      <h2>{{ $settings['video_title'] ?? 'See It In Action' }}</h2>
      <p>{{ $settings['video_description'] ?? 'Crowns IT প্রোডাক্টগুলো বাস্তবে কেমন পারফর্ম করে, নিজের চোখে দেখুন।' }}</p>
    </div>
    <div class="video-card reveal">
      @php
        $hasPoster = !empty($settings['video_poster']);
        $posterUrl = $hasPoster ? (\Illuminate\Support\Str::startsWith($settings['video_poster'], ['http://', 'https://']) ? $settings['video_poster'] : asset($settings['video_poster'])) : null;
        
        $youtubeUrl = $settings['youtube_url'] ?? '';
        $youtubeId = null;
        if ($youtubeUrl) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $youtubeUrl, $match);
            $youtubeId = $match[1] ?? null;
        }

        $rawVideoUrl = $settings['video_url'] ?? '';
        if (!empty($rawVideoUrl)) {
            $videoSrc = \Illuminate\Support\Str::startsWith($rawVideoUrl, ['http://', 'https://', '/']) ? $rawVideoUrl : asset($rawVideoUrl);
        } else {
            $videoSrc = '';
        }
      @endphp
      
      @if($youtubeId)
        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $youtubeId }}?rel=0&showinfo=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 5;"></iframe>
      @else
        <video id="crownsItVideo" @if($posterUrl) poster="{{ $posterUrl }}" @endif preload="auto" playsinline controls>
          @if($videoSrc)
            <source src="{{ $videoSrc }}" type="video/mp4">
          @endif
        </video>
        <div class="video-play" id="videoPlayOverlay">
          <button class="play-btn" id="playBtn" aria-label="ভিডিও চালান">
            <svg viewBox="0 0 24 24" fill="#0A0D13"><path d="M8 5v14l11-7z"/></svg>
          </button>
        </div>
      @endif
    </div>
  </div>
</section>

<!-- ============ WHY CHOOSE ============ -->
<section id="why" class="section-pad">
  <div class="wrap">
    <div class="section-head reveal">
      <div class="eyebrow">{{ $settings['why_eyebrow'] ?? 'কেন Crowns IT' }}</div>
      <h2>{{ $settings['why_title'] ?? 'যে কারণে গ্রাহকরা আমাদের বেছে নেন' }}</h2>
    </div>
    <div class="why-grid" id="whyGrid">
      @foreach($whyItems as $index => $w)
        <div class="why-card reveal reveal-delay-{{ ($index % 3) + 1 }}">
          <div class="why-icon">
            @if(Str::startsWith($w->icon ?? '', 'bi-'))
              <i class="bi {{ $w->icon }}" style="font-size: 26px; color: var(--ion);"></i>
            @else
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                @if(Str::contains($w->icon ?? '', ['<path', '<polyline', '<circle', '<rect', '<line']))
                  {!! $w->icon !!}
                @else
                  <path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z"/><path d="M9 12l2 2 4-4"/>
                @endif
              </svg>
            @endif
          </div>
          <h4>{{ $w->title }}</h4>
          <p>{{ $w->description ?? $w->desc ?? '' }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============ ORDER ============ -->
<section id="order" class="section-pad">
  <div class="wrap">
    <div class="order-wrap reveal">
      <div class="order-info">
        <div class="eyebrow">{{ $settings['checkout_eyebrow'] ?? 'চেকআউট' }}</div>
        <h3>{{ $settings['checkout_title'] ?? 'আপনার অর্ডার কনফার্ম করুন' }}</h3>
        <p>{{ $settings['checkout_description'] ?? 'ফর্মটি পূরণ করুন, আমাদের টিম ফোনে কনফার্ম করে ২৪-৪৮ ঘণ্টার মধ্যে ডেলিভারি করবে।' }}</p>
        <div class="order-perks">
          <div>
            <strong>{{ $settings['perk_1_title'] ?? 'ক্যাশ অন ডেলিভারি' }}</strong>
            {{ $settings['perk_1_desc'] ?? 'পণ্য হাতে পেয়ে টাকা দিন' }}
          </div>
          <div>
            <strong>{{ $settings['perk_2_title'] ?? 'সীমিত স্টক' }}</strong>
            {{ $settings['perk_2_desc'] ?? 'বর্তমান অফার সীমিত সময়ের জন্য' }}
          </div>
          <div>
            <strong>{{ $settings['perk_3_title'] ?? 'সহজ রিটার্ন' }}</strong>
            {{ $settings['perk_3_desc'] ?? '৭ দিনের এক্সচেঞ্জ সুবিধা' }}
          </div>
        </div>
      </div>
      <div class="order-form" id="orderFormWrap">
        <form id="orderForm" action="{{ route('order.store') }}" method="POST" novalidate>
          @csrf
          <div class="field" id="f-name">
            <label for="fullName">পূর্ণ নাম</label>
            <input type="text" name="customer_name" id="fullName" placeholder="যেমন: রাহাত হোসেন" required>
            <div class="field-msg">নাম লিখুন</div>
          </div>
          <div class="field" id="f-phone">
            <label for="phone">ফোন নম্বর</label>
            <input type="tel" name="phone" id="phone" placeholder="01XXXXXXXXX" required>
            <div class="field-msg">সঠিক ফোন নম্বর দিন</div>
          </div>
          <div class="field" id="f-address">
            <label for="address">পূর্ণ ঠিকানা</label>
            <input type="text" name="address" id="address" placeholder="বাসা/রোড, থানা, জেলা" required>
            <div class="field-msg">ঠিকানা লিখুন</div>
          </div>
          <div class="field" id="f-product">
            <label>প্রোডাক্ট বাছাই করুন</label>
            <select name="product_ids[]" id="productSelect" style="display:none;" multiple>
              @foreach($products as $p)
                <option value="{{ $p->id }}" data-price="{{ $p->price }}" {{ $loop->first ? 'selected' : '' }}>{{ $p->name }} — ৳{{ number_format($p->price, 0) }}</option>
              @endforeach
            </select>
            
            <div class="visual-product-list" id="visualProductList">
              @foreach($products as $p)
                <div class="v-prod-item {{ $loop->first ? 'active' : '' }}" data-id="{{ $p->id }}">
                  <div class="v-prod-img">
                    <img src="{{ asset($p->img) }}" alt="{{ $p->name }}" loading="lazy" width="60" height="60">
                  </div>
                  <div class="v-prod-info">
                    <div class="v-prod-name">{{ $p->name }}</div>
                    <div class="v-prod-price">
                      <span class="now">৳ {{ number_format($p->price, 0) }}</span>
                      @if($p->old_price)
                        <span class="old">৳ {{ number_format($p->old_price, 0) }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="v-prod-check">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <div class="field" id="f-qty">
            <label for="qty">পরিমাণ</label>
            <input type="number" name="quantity" id="qty" value="1" min="1" max="10">
          </div>

          <div class="order-summary">
            <div class="row"><span>ইউনিট প্রাইস</span><span id="sumPrice">৳0</span></div>
            <div class="row"><span>পরিমাণ</span><span id="sumQty">1</span></div>
            <div class="row"><span>ডেলিভারি চার্জ</span><span id="sumDelivery">৳60</span></div>
            <div class="row total"><span>সর্বমোট</span><span id="sumTotal">৳0</span></div>
          </div>

          <button type="submit" id="submitBtn" class="btn btn-primary btn-block" style="margin-top:20px;">Confirm Order</button>
        </form>
        <div class="order-success" id="orderSuccess">
          অর্ডার রিসিভ হয়েছে। আমাদের টিম শীঘ্রই আপনার ফোনে যোগাযোগ করবে।
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

<!-- Sales Popup Container -->
@if(isset($salesPopups) && $salesPopups->count() > 0)
<div class="sales-popup" id="salesPopup">
  <div class="sp-content">
    <div class="sp-img">
      <img src="" alt="Product">
    </div>
    <div class="sp-info">
      <div class="sp-header">
        <span class="sp-name fw-bold"></span>
        <span class="sp-time text-muted small"></span>
      </div>
      <div class="sp-text">
         <span class="sp-product fw-semibold"></span>
      </div>
    </div>
  </div>
</div>

<style>
.sales-popup {
  position: fixed;
  bottom: 20px;
  left: 20px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.15);
  padding: 12px;
  z-index: 9999;
  width: 320px;
  transform: translateY(150px);
  opacity: 0;
  visibility: hidden;
  transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  border: 1px solid rgba(16, 185, 129, 0.2);
}
.sales-popup.show {
  transform: translateY(0);
  opacity: 1;
  visibility: visible;
}
.sp-content {
  display: flex;
  align-items: center;
  gap: 12px;
}
.sp-img img {
  width: 48px;
  height: 48px;
  object-fit: cover;
  border-radius: 8px;
}
.sp-info {
  flex: 1;
  font-size: 13px;
  line-height: 1.4;
}
.sp-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2px;
}
.sp-name {
  color: #0B1910;
  font-size: 14px;
}
.sp-time {
  font-size: 11px;
}
.sp-text {
  color: #4b5563;
}
.sp-product {
  color: #10b981;
}
@media (max-width: 768px) {
  .sales-popup {
    bottom: 10px; /* Above mobile sticky CTA */
    left: 50%;
    transform: translateX(-50%) translateY(150px);
    width: 90%;
    max-width: 340px;
  }
  .sales-popup.show {
    transform: translateX(-50%) translateY(0);
  }
}
</style>
@endif

@push('scripts')
<script>
  const PRODUCTS_DATA = @json($products);
  const DELIVERY_CHARGE = {{ isset($settings['delivery_charge']) ? $settings['delivery_charge'] : 60 }};

  const productCards = document.querySelectorAll('.product-offer-card');
  const productSelect = document.getElementById('productSelect');
  const qtyInput = document.getElementById('qty');
  const sumPrice = document.getElementById('sumPrice');
  const sumQty = document.getElementById('sumQty');
  const sumDelivery = document.getElementById('sumDelivery');
  const sumTotal = document.getElementById('sumTotal');

  function fmt(n) {
    return '৳' + Number(n).toLocaleString('en-US');
  }

  function updateSummary() {
    let subtotal = 0;
    const selectedItems = document.querySelectorAll('.v-prod-item.active');
    selectedItems.forEach(item => {
      const pId = parseInt(item.getAttribute('data-id'));
      const p = PRODUCTS_DATA.find(x => x.id === pId);
      if (p) subtotal += parseFloat(p.price);
    });

    if (subtotal === 0) { // Fallback if no visual items are active
      const p = PRODUCTS_DATA[0];
      if (p) subtotal = parseFloat(p.price);
    }

    const qty = Math.max(1, parseInt(qtyInput.value) || 1);
    const total = (subtotal * qty) + DELIVERY_CHARGE;
    sumPrice.textContent = fmt(subtotal);
    sumQty.textContent = qty;
    sumDelivery.textContent = fmt(DELIVERY_CHARGE);
    sumTotal.textContent = fmt(total);
  }

  const visualItems = document.querySelectorAll('.v-prod-item');
  visualItems.forEach(item => {
    item.addEventListener('click', () => {
      // Toggle selection
      item.classList.toggle('active');
      
      // Ensure at least one is selected
      const selectedActive = document.querySelectorAll('.v-prod-item.active');
      if(selectedActive.length === 0) {
        item.classList.add('active');
        return;
      }

      if (productSelect) {
        // Update hidden select
        const options = productSelect.options;
        for (let i = 0; i < options.length; i++) {
          const pId = options[i].value;
          const vItem = document.querySelector(`.v-prod-item[data-id="${pId}"]`);
          if (vItem) options[i].selected = vItem.classList.contains('active');
        }
        
        // Sync top cards
        productCards.forEach(c => {
          const pId = c.getAttribute('data-id');
          const vItem = document.querySelector(`.v-prod-item[data-id="${pId}"]`);
          if (vItem) c.classList.toggle('selected', vItem.classList.contains('active'));
        });
        updateSummary();
      }
    });
  });

  function syncVisualProducts(selectedId) {
    // If selecting from a top card, maybe we want to select ONLY that one? Or toggle it?
    // Let's assume clicking top card selects ONLY that one for simplicity.
    visualItems.forEach(v => {
      v.classList.toggle('active', v.getAttribute('data-id') == selectedId);
    });
  }

  /* Card Click Handler */
  productCards.forEach(card => {
    card.addEventListener('click', (e) => {
      productCards.forEach(c => c.classList.remove('selected'));
      card.classList.add('selected');
      const id = card.getAttribute('data-id');
      if (productSelect) {
        const options = productSelect.options;
        for (let i = 0; i < options.length; i++) {
          options[i].selected = (options[i].value == id);
        }
        syncVisualProducts(id);
        updateSummary();
      }
      const orderSec = document.getElementById('order');
      if (orderSec && e.target.closest('.btn-card-select')) {
        orderSec.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  if (productSelect) {
    productSelect.addEventListener('change', () => {
      const selectedIds = Array.from(productSelect.selectedOptions).map(o => o.value);
      productCards.forEach(c => {
        c.classList.toggle('selected', selectedIds.includes(c.getAttribute('data-id')));
      });
      visualItems.forEach(v => {
        v.classList.toggle('active', selectedIds.includes(v.getAttribute('data-id')));
      });
      updateSummary();
    });
  }

  if (qtyInput) {
    qtyInput.addEventListener('input', updateSummary);
  }
  updateSummary();

  /* Preselect buttons */
  document.querySelectorAll('[data-select-product]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const pId = btn.getAttribute('data-select-product');
      if (pId && productSelect) {
        productSelect.value = pId;
        productCards.forEach(c => {
          c.classList.toggle('selected', c.getAttribute('data-id') == pId);
        });
        updateSummary();
      }
      document.getElementById('order').scrollIntoView({ behavior: 'smooth' });
      if (!btn.closest('form')) e.preventDefault();
    });
  });

  /* Form Validation & Submission via Fetch AJAX */
  const orderForm = document.getElementById('orderForm');
  const orderFormWrap = document.getElementById('orderFormWrap');
  const orderSuccess = document.getElementById('orderSuccess');
  const submitBtn = document.getElementById('submitBtn');

  if (orderForm) {
    orderForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      let valid = true;
      const nameField = document.getElementById('fullName');
      const phoneField = document.getElementById('phone');
      const addressField = document.getElementById('address');

      [
        ['f-name', nameField.value.trim().length > 1],
        ['f-phone', /^0\d{10}$/.test(phoneField.value.trim())],
        ['f-address', addressField.value.trim().length > 4]
      ].forEach(([id, ok]) => {
        const wrap = document.getElementById(id);
        if (wrap) {
          wrap.classList.toggle('error', !ok);
        }
        if (!ok) valid = false;
      });

      if (!valid) return;

      submitBtn.disabled = true;
      submitBtn.textContent = 'প্রসেসিং হচ্ছে...';

      try {
        const formData = new FormData(orderForm);
        const response = await fetch(orderForm.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
          },
          body: formData
        });

        const result = await response.json();

        if (response.ok && result.success) {
          orderFormWrap.classList.add('submitted');
          orderSuccess.classList.add('show');
          if (result.message) {
            orderSuccess.textContent = result.message;
          }
          
          if (typeof fbq === 'function') {
             fbq('track', 'Purchase', {
                 value: result.total_amount,
                 currency: 'BDT'
             });
          }
        } else {
          alert(result.message || 'অর্ডার করতে সমস্যা হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।');
          submitBtn.disabled = false;
          submitBtn.textContent = 'Confirm Order';
        }
      } catch (err) {
        console.error(err);
        alert('নেটওয়ার্ক সমস্যা হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।');
        submitBtn.disabled = false;
        submitBtn.textContent = 'Confirm Order';
      }
    });
  }

  /* Scroll Reveal */
  const revealEls = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  revealEls.forEach(el => io.observe(el));

  /* Video Play Overlay */
  const video = document.getElementById('crownsItVideo');
  const playOverlay = document.getElementById('videoPlayOverlay');
  const playBtn = document.getElementById('playBtn');
  if (playBtn && video && playOverlay) {
    playBtn.addEventListener('click', () => {
      playOverlay.classList.add('hidden');
      video.play().catch(() => {});
    });
    video.addEventListener('pause', () => playOverlay.classList.remove('hidden'));
    video.addEventListener('ended', () => playOverlay.classList.remove('hidden'));
  }

  /* Sticky CTA */
  const stickyCta = document.getElementById('stickyCta');
  const orderSection = document.getElementById('order');
  if (stickyCta && orderSection) {
    window.addEventListener('scroll', () => {
      const hero = document.querySelector('.hero');
      const heroHeight = hero ? hero.offsetHeight : 500;
      const orderTop = orderSection.getBoundingClientRect().top + window.scrollY;
      const scrollY = window.scrollY;
      const show = scrollY > heroHeight * 0.6 && scrollY < orderTop - 200;
      stickyCta.classList.toggle('show', show);
    }, { passive: true });
    stickyCta.addEventListener('click', () => {
      orderSection.scrollIntoView({ behavior: 'smooth' });
    });
  }

  /* ============ APPLE-STYLE PROGRESSIVE SCROLL ANIMATION ============ */
  (function initScrollFrameAnimation() {
    const totalFrames = 240;
    const frameImages = new Array(totalFrames);
    let targetFrameIndex = 0;
    let currentFrameIndex = 0;
    let lastDrawnFrame = -1;

    const canvas = document.getElementById('scrollBottleCanvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d', { alpha: true });
    const heroSection = document.getElementById('heroScrollSection');
    const essenceAura = document.getElementById('essenceAura');

    // Base URL resolver for XAMPP / artisan serve / live domain
    const getFrameUrl = (index) => {
      const num = String(index + 1).padStart(3, '0');
      const bladeAsset = "{{ asset('jotno-frames') }}";
      return `${bladeAsset}/ezgif-frame-${num}.webp`;
    };

    // Helper to load a single frame
    function loadFrame(index, callback) {
      if (frameImages[index]) return;
      const img = new Image();
      img.onload = () => {
        frameImages[index] = img;
        if (callback) callback(img);
      };
      img.onerror = () => {
        if (!img.dataset.retried) {
          img.dataset.retried = 'true';
          const num = String(index + 1).padStart(3, '0');
          const pathName = window.location.pathname.replace(/\/+$/, '');
          img.src = `${pathName}/jotno-frames/ezgif-frame-${num}.webp`;
        }
      };
      img.src = getFrameUrl(index);
    }

    // PHASE 1: Load Frame 0 (First Frame) Instantly (< 20ms!)
    loadFrame(0, () => {
      drawFrame(0);
    });

    // PHASE 2: Load Keyframes every 4th frame (60 frames total) for fast smooth scroll coverage
    const keyStep = 4;
    for (let i = 0; i < totalFrames; i += keyStep) {
      loadFrame(i);
    }

    // PHASE 3: Background fill of intermediate frames during idle time
    if ('requestIdleCallback' in window) {
      requestIdleCallback(() => {
        for (let i = 0; i < totalFrames; i++) {
          if (!frameImages[i]) loadFrame(i);
        }
      });
    } else {
      setTimeout(() => {
        for (let i = 0; i < totalFrames; i++) {
          if (!frameImages[i]) loadFrame(i);
        }
      }, 300);
    }

    function getScrollProgress() {
      if (!heroSection) return 0;
      const rect = heroSection.getBoundingClientRect();
      const scrollableHeight = heroSection.offsetHeight - window.innerHeight;
      if (scrollableHeight <= 0) return 0;

      const scrolled = -rect.top;
      return Math.min(Math.max(scrolled / scrollableHeight, 0), 1);
    }

    function drawFrame(index) {
      let img = frameImages[index];

      // Fallback to nearest loaded frame for instant display
      if (!img || !img.complete || img.naturalWidth === 0) {
        for (let offset = 1; offset < totalFrames; offset++) {
          const prev = frameImages[Math.max(0, index - offset)];
          const next = frameImages[Math.min(totalFrames - 1, index + offset)];
          if (prev && prev.complete && prev.naturalWidth > 0) { img = prev; break; }
          if (next && next.complete && next.naturalWidth > 0) { img = next; break; }
        }
      }

      if (!img || !img.complete || img.naturalWidth === 0) return;

      const dpr = window.devicePixelRatio || 1;
      const rect = canvas.getBoundingClientRect();
      if (rect.width === 0 || rect.height === 0) return;

      const targetW = Math.round(rect.width * dpr);
      const targetH = Math.round(rect.height * dpr);

      if (canvas.width !== targetW || canvas.height !== targetH) {
        canvas.width = targetW;
        canvas.height = targetH;
      }

      ctx.save();
      ctx.scale(dpr, dpr);
      ctx.clearRect(0, 0, rect.width, rect.height);

      const imgRatio = img.naturalWidth / img.naturalHeight;
      const containerRatio = rect.width / rect.height;

      let drawW, drawH;
      if (containerRatio > imgRatio) {
        drawH = rect.height;
        drawW = rect.height * imgRatio;
      } else {
        drawW = rect.width;
        drawH = rect.width / imgRatio;
      }

      const drawX = (rect.width - drawW) / 2;
      const drawY = (rect.height - drawH) / 2;

      ctx.drawImage(img, drawX, drawY, drawW, drawH);
      ctx.restore();
    }

    function renderLoop() {
      const progress = getScrollProgress();
      targetFrameIndex = progress * (totalFrames - 1);

      const delta = targetFrameIndex - currentFrameIndex;
      if (Math.abs(delta) > 0.001) {
        currentFrameIndex += delta * 0.15;
      } else {
        currentFrameIndex = targetFrameIndex;
      }

      const frameToDraw = Math.min(
        Math.max(Math.round(currentFrameIndex), 0),
        totalFrames - 1
      );

      if (frameToDraw !== lastDrawnFrame) {
        drawFrame(frameToDraw);
        lastDrawnFrame = frameToDraw;
      }

      if (essenceAura) {
        essenceAura.style.opacity = progress * 0.9;
        essenceAura.style.transform = `translateX(-50%) translateY(${-20 * progress}px) scale(${1 + 0.25 * progress})`;
      }

      requestAnimationFrame(renderLoop);
    }

    requestAnimationFrame(renderLoop);

    window.addEventListener('resize', () => {
      lastDrawnFrame = -1;
    }, { passive: true });
  })();

  /* Sales Popup Logic */
  @if(isset($salesPopups) && $salesPopups->count() > 0)
    const salesPopups = @json($salesPopups);
    const popupEl = document.getElementById('salesPopup');
    if (popupEl && salesPopups.length > 0) {
      let currentPopupIndex = 0;

      function showNextPopup() {
        // Hide first
        popupEl.classList.remove('show');
        
        setTimeout(() => {
          const popup = salesPopups[currentPopupIndex];
          
          // Update content
          const imgEl = popupEl.querySelector('.sp-img img');
          if (popup.image) {
            imgEl.src = `{{ asset('') }}${popup.image}`;
            imgEl.style.display = 'block';
          } else {
            imgEl.style.display = 'none';
          }
          
          popupEl.querySelector('.sp-name').textContent = popup.customer_name;
          popupEl.querySelector('.sp-time').textContent = popup.time_ago;
          popupEl.querySelector('.sp-product').textContent = popup.product_name;

          // Show
          popupEl.classList.add('show');
          
          // Move to next index
          currentPopupIndex = (currentPopupIndex + 1) % salesPopups.length;
          
          // Hide after 5 seconds, then wait 5 seconds to show next
          setTimeout(() => {
            popupEl.classList.remove('show');
            setTimeout(showNextPopup, 5000);
          }, 5000);
          
        }, 500); // Small delay to ensure transition finishes before changing content
      }

      // Start the cycle after 3 seconds
      setTimeout(showNextPopup, 3000);
    }
  @endif
</script>
@endpush
