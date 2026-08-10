<footer>
  <div class="wrap footer-inner">
    <a href="{{ route('home') }}" class="logo">
      @if(!empty($settings['site_logo']))
        <img src="{{ \Illuminate\Support\Str::startsWith($settings['site_logo'], ['http://', 'https://']) ? $settings['site_logo'] : asset($settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'NOVA' }}" style="max-height:40px; object-fit:contain;">
      @else
        <span class="dot"></span>{{ $settings['site_name'] ?? 'NOVA' }}
      @endif
    </a>
    <p>© {{ date('Y') }} {{ $settings['site_name'] ?? 'NOVA' }}. সকল স্বত্ব সংরক্ষিত।</p>
  </div>
</footer>
