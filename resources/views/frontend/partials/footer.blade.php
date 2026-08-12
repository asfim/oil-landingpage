<footer>
  <div class="wrap footer-inner">
    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
      <a href="{{ route('home') }}" class="logo">
        @if(!empty($settings['site_logo']))
          <img src="{{ \Illuminate\Support\Str::startsWith($settings['site_logo'], ['http://', 'https://']) ? $settings['site_logo'] : asset($settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Crowns IT' }}" style="max-height:28px; object-fit:contain;">
        @else
          <span class="dot"></span>{{ $settings['site_name'] ?? 'Crowns IT' }}
        @endif
      </a>
      <p style="margin: 0; padding-top: 4px;">© {{ date('Y') }} {{ $settings['site_name'] ?? 'Crowns IT' }}. সকল স্বত্ব সংরক্ষিত।</p>
    </div>

    <div style="text-align: right; font-size: 13.5px; color: var(--text-dim);">
      Developed by <a href="https://crownsit.com" target="_blank" style="color: var(--ion); font-weight: 600; text-decoration: none;">Crowns IT</a>
    </div>
  </div>
</footer>
