<!-- ============ NAV ============ -->
<nav class="nav">
  <div class="wrap nav-inner">
    <a href="{{ route('home') }}" class="logo">
      @if(!empty($settings['site_logo']))
        <img src="{{ \Illuminate\Support\Str::startsWith($settings['site_logo'], ['http://', 'https://']) ? $settings['site_logo'] : asset($settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Crowns IT' }}" style="max-height:48px; object-fit:contain;">
      @else
        <span class="dot"></span>{{ $settings['site_name'] ?? 'Crowns IT' }}
      @endif
    </a>
    <div class="nav-links">
      <a href="#products">প্রোডাক্টস</a>
      <a href="#video">ভিডিও</a>
      <a href="#why">কেন আমরা</a>
    </div>
    <a href="#order" class="nav-cta">অর্ডার করুন</a>
  </div>
</nav>
