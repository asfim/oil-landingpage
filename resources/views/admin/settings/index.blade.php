@extends('admin.layouts.app')

@section('title', 'Website Settings')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold fs-5">Website Settings</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
            @csrf

            <!-- Nav Tabs -->
            <ul class="nav custom-tabs mb-4 flex-nowrap overflow-x-auto hide-scrollbar" id="settingTabs" role="tablist" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link active text-nowrap" id="general-tab" data-bs-toggle="tab" data-bs-target="#general-panel" type="button" role="tab" aria-controls="general-panel" aria-selected="true">
                        <i class="bi bi-sliders me-1"></i> General & Shipping
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link text-nowrap" id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero-panel" type="button" role="tab" aria-controls="hero-panel" aria-selected="false">
                        <i class="bi bi-window me-1"></i> Hero Section
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link text-nowrap" id="collection-tab" data-bs-toggle="tab" data-bs-target="#collection-panel" type="button" role="tab" aria-controls="collection-panel" aria-selected="false">
                        <i class="bi bi-grid me-1"></i> Collection Section
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link text-nowrap" id="why-tab" data-bs-toggle="tab" data-bs-target="#why-panel" type="button" role="tab" aria-controls="why-panel" aria-selected="false">
                        <i class="bi bi-star me-1"></i> Why Choose Us
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link text-nowrap" id="checkout-tab" data-bs-toggle="tab" data-bs-target="#checkout-panel" type="button" role="tab" aria-controls="checkout-panel" aria-selected="false">
                        <i class="bi bi-cart-check me-1"></i> Checkout Section
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link text-nowrap" id="video-tab" data-bs-toggle="tab" data-bs-target="#video-panel" type="button" role="tab" aria-controls="video-panel" aria-selected="false">
                        <i class="bi bi-play-circle me-1"></i> Video Section
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link text-nowrap" id="branding-tab" data-bs-toggle="tab" data-bs-target="#branding-panel" type="button" role="tab" aria-controls="branding-panel" aria-selected="false">
                        <i class="bi bi-image me-1"></i> Branding & Media
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link text-nowrap" id="scripts-tab" data-bs-toggle="tab" data-bs-target="#scripts-panel" type="button" role="tab" aria-controls="scripts-panel" aria-selected="false">
                        <i class="bi bi-code-slash me-1"></i> Custom Scripts
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="settingTabsContent">
                <!-- 1. General & Shipping Settings -->
                <div class="tab-pane fade show active" id="general-panel" role="tabpanel" aria-labelledby="general-tab">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Website Brand Name</label>
                            <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'Crowns IT' }}" placeholder="e.g. Crowns IT">
                            <small class="text-muted">Displays in header logo and footer.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Website Page Title Tag</label>
                            <input type="text" name="site_title" class="form-control" value="{{ $settings['site_title'] ?? 'Crowns IT — Power your everyday' }}" placeholder="e.g. Crowns IT — Power your everyday">
                            <small class="text-muted">Displays in browser tab title.</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Meta Description (SEO)</label>
                            <textarea name="site_description" class="form-control" rows="2">{{ $settings['site_description'] ?? 'Crowns IT প্রিমিয়াম টেক ও ভেষজ প্রোডাক্টস — ক্যাশ অন ডেলিভারি সহ দ্রুত ডেলিভারি।' }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Delivery Charge (৳)</label>
                            <input type="number" step="0.01" name="delivery_charge" class="form-control" value="{{ $settings['delivery_charge'] ?? '60' }}" required>
                            <small class="text-muted">Flat delivery charge applied to every order.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Contact Phone Number</label>
                            <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '' }}" placeholder="e.g. +8801700000000">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">WhatsApp Number</label>
                            <input type="text" name="whatsapp_number" class="form-control" value="{{ $settings['whatsapp_number'] ?? '' }}" placeholder="e.g. 8801700000000">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Support Email</label>
                            <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? '' }}" placeholder="info@example.com">
                        </div>
                    </div>
                </div>

                <!-- 2. Hero Section Settings -->
                <div class="tab-pane fade" id="hero-panel" role="tabpanel" aria-labelledby="hero-tab">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Hero Eyebrow Tag</label>
                            <input type="text" name="hero_eyebrow" class="form-control" value="{{ $settings['hero_eyebrow'] ?? 'নতুন কালেকশন — ৪টি প্রোডাক্ট' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Hero Rating Text</label>
                            <input type="text" name="hero_rating" class="form-control" value="{{ $settings['hero_rating'] ?? '৪.৮/৫' }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Hero Title</label>
                            <input type="text" name="hero_title" class="form-control" value="{{ $settings['hero_title'] ?? 'আপনার প্রতিদিনকে <em>পাওয়ার আপ</em> করুন' }}">
                            <small class="text-muted">HTML tags like &lt;em&gt; are allowed for text styling.</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Hero Description</label>
                            <textarea name="hero_description" class="form-control" rows="3">{{ $settings['hero_description'] ?? 'প্রিমিয়াম সাউন্ড, স্মার্ট ট্র্যাকিং আর সারাদিনের চার্জ — একসাথে, একটাই ব্র্যান্ডে।' }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Order Button Text</label>
                            <input type="text" name="hero_btn_text" class="form-control" value="{{ $settings['hero_btn_text'] ?? 'Order Now' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Hero Chip 1</label>
                            <input type="text" name="hero_chip_1" class="form-control" value="{{ $settings['hero_chip_1'] ?? '🌿 ১০০% ভেষজ উপাদান' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Hero Chip 2</label>
                            <input type="text" name="hero_chip_2" class="form-control" value="{{ $settings['hero_chip_2'] ?? '💧 ১০০ml বিশুদ্ধ তেল' }}">
                        </div>
                    </div>
                </div>

                <!-- Collection Section Settings -->
                <div class="tab-pane fade" id="collection-panel" role="tabpanel" aria-labelledby="collection-tab">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Collection Eyebrow Tag</label>
                            <input type="text" name="collection_eyebrow" class="form-control" value="{{ $settings['collection_eyebrow'] ?? 'আমাদের কালেকশন' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Collection Section Title</label>
                            <input type="text" name="collection_title" class="form-control" value="{{ $settings['collection_title'] ?? '৪টি প্রোডাক্ট, একটাই লক্ষ্য' }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Collection Section Description</label>
                            <textarea name="collection_description" class="form-control" rows="2">{{ $settings['collection_description'] ?? 'প্রতিটা প্রোডাক্ট বানানো হয়েছে আপনার দিন সহজ করার জন্য — সাউন্ড থেকে চার্জ পর্যন্ত।' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 3. Why Choose Us Section Settings -->
                <div class="tab-pane fade" id="why-panel" role="tabpanel" aria-labelledby="why-tab">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Why Choose Us Eyebrow Tag</label>
                            <input type="text" name="why_eyebrow" class="form-control" value="{{ $settings['why_eyebrow'] ?? 'কেন Crowns IT' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Why Choose Us Section Title</label>
                            <input type="text" name="why_title" class="form-control" value="{{ $settings['why_title'] ?? 'যে কারণে গ্রাহকরা আমাদের বেছে নেন' }}">
                        </div>
                        <div class="col-md-12">
                            <div class="alert alert-info d-flex align-items-center mb-0">
                                <i class="bi bi-info-circle fs-4 me-3"></i>
                                <div>
                                    To add, edit or manage individual feature cards under this section, visit the 
                                    <a href="{{ route('admin.why-choose.index') }}" class="fw-bold text-decoration-underline ms-1">Why Choose Us Items Manager</a>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Checkout Section Settings -->
                <div class="tab-pane fade" id="checkout-panel" role="tabpanel" aria-labelledby="checkout-tab">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Checkout Eyebrow Tag</label>
                            <input type="text" name="checkout_eyebrow" class="form-control" value="{{ $settings['checkout_eyebrow'] ?? 'চেকআউট' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Checkout Title</label>
                            <input type="text" name="checkout_title" class="form-control" value="{{ $settings['checkout_title'] ?? 'আপনার অর্ডার কনফার্ম করুন' }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Checkout Subtitle / Description</label>
                            <textarea name="checkout_description" class="form-control" rows="2">{{ $settings['checkout_description'] ?? 'ফর্মটি পূরণ করুন, আমাদের টিম ফোনে কনফার্ম করে ২৪-৪৮ ঘণ্টার মধ্যে ডেলিভারি করবে।' }}</textarea>
                        </div>

                        <div class="col-md-12 mb-2"><h6 class="fw-bold text-primary">Trust Perks (3 Feature Bullets)</h6></div>

                        <!-- Perk 1 -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Perk 1 Title</label>
                            <input type="text" name="perk_1_title" class="form-control" value="{{ $settings['perk_1_title'] ?? 'ক্যাশ অন ডেলিভারি' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Perk 1 Description</label>
                            <input type="text" name="perk_1_desc" class="form-control" value="{{ $settings['perk_1_desc'] ?? 'পণ্য হাতে পেয়ে টাকা দিন' }}">
                        </div>

                        <!-- Perk 2 -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Perk 2 Title</label>
                            <input type="text" name="perk_2_title" class="form-control" value="{{ $settings['perk_2_title'] ?? 'সীমিত স্টক' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Perk 2 Description</label>
                            <input type="text" name="perk_2_desc" class="form-control" value="{{ $settings['perk_2_desc'] ?? 'বর্তমান অফার সীমিত সময়ের জন্য' }}">
                        </div>

                        <!-- Perk 3 -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Perk 3 Title</label>
                            <input type="text" name="perk_3_title" class="form-control" value="{{ $settings['perk_3_title'] ?? 'সহজ রিটার্ন' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Perk 3 Description</label>
                            <input type="text" name="perk_3_desc" class="form-control" value="{{ $settings['perk_3_desc'] ?? '৭ দিনের এক্সচেঞ্জ সুবিধা' }}">
                        </div>
                    </div>
                </div>

                <!-- 5. Video Section Settings -->
                <div class="tab-pane fade" id="video-panel" role="tabpanel" aria-labelledby="video-tab">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Video Eyebrow Tag</label>
                            <input type="text" name="video_eyebrow" class="form-control" value="{{ $settings['video_eyebrow'] ?? 'লাইভ ডেমো' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Video Section Title</label>
                            <input type="text" name="video_title" class="form-control" value="{{ $settings['video_title'] ?? 'See It In Action' }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Video Section Description</label>
                            <textarea name="video_description" class="form-control" rows="2">{{ $settings['video_description'] ?? 'প্রোডাক্টগুলো বাস্তবে কেমন পারফর্ম করে, নিজের চোখে দেখুন।' }}</textarea>
                        </div>

                        <!-- Direct Video File Upload & External URL -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Upload Direct Video File (MP4, WebM, MOV)</label>
                            <input type="file" name="video_file" class="form-control" accept="video/mp4,video/webm,video/quicktime,video/mov">
                            <small class="text-muted d-block mt-1">Upload video file directly to server (Max 100MB).</small>
                            @if(!empty($settings['video_url']))
                                <div class="mt-3 p-3 bg-light rounded border">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div>
                                            <strong class="d-block text-dark"><i class="bi bi-play-circle me-1"></i> Current Video</strong>
                                            <small class="text-muted" style="word-break: break-all;"><code>{{ $settings['video_url'] }}</code></small>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="remove_video" value="1" id="removeVideo">
                                            <label class="form-check-label text-danger fw-semibold" for="removeVideo">Remove</label>
                                        </div>
                                    </div>
                                    <video src="{{ Str::startsWith($settings['video_url'], ['http://', 'https://']) ? $settings['video_url'] : asset($settings['video_url']) }}" controls style="max-width: 100%; border-radius: 8px; border: 1px solid #dee2e6; background: #000; max-height: 200px;"></video>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Or YouTube Video Link</label>
                            <input type="url" name="youtube_url" class="form-control" value="{{ $settings['youtube_url'] ?? '' }}" placeholder="https://www.youtube.com/watch?v=...">
                            <small class="text-muted d-block mt-1">Enter a YouTube video link. This will override the direct video upload if provided.</small>
                        </div>

                        <!-- Thumbnail / Poster Image -->
                        <div class="col-md-12 mb-3">
                            <hr class="my-3">
                            <label class="form-label fw-semibold">Thumbnail / Poster Image (Optional)</label>
                            <input type="file" name="poster_file" class="form-control" accept="image/*">
                            <small class="text-muted d-block mt-1">
                                <i class="bi bi-info-circle me-1"></i> 
                                Thumbnail image optional. If no custom thumbnail is uploaded, the 1st frame of the video will automatically display as the thumbnail.
                            </small>

                            @if(!empty($settings['video_poster']))
                                <div class="mt-3 p-3 bg-light rounded border d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ Str::startsWith($settings['video_poster'], ['http://', 'https://']) ? $settings['video_poster'] : asset($settings['video_poster']) }}" alt="Poster" style="max-height:70px; border-radius:4px;" class="border p-1 bg-white">
                                        <div>
                                            <strong class="d-block text-dark">Custom Thumbnail Active</strong>
                                            <small class="text-muted">Will display on website instead of video 1st frame.</small>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch me-2">
                                        <input class="form-check-input" type="checkbox" name="remove_poster" value="1" id="removePoster">
                                        <label class="form-check-label text-danger fw-semibold" for="removePoster">Remove Thumbnail (Use 1st Frame)</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- 6. Branding & Media Settings -->
                <div class="tab-pane fade" id="branding-panel" role="tabpanel" aria-labelledby="branding-tab">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Site Logo Image</label>
                            <input type="file" name="logo_file" class="form-control" accept="image/*">
                            <small class="text-muted d-block mt-1">Upload PNG, JPG, SVG, or WEBP logo image for navbar & footer.</small>
                            @if(!empty($settings['site_logo']))
                                <div class="mt-3 p-3 bg-light rounded border d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ Str::startsWith($settings['site_logo'], ['http://', 'https://']) ? $settings['site_logo'] : asset($settings['site_logo']) }}" alt="Logo" style="max-height:50px;" class="border p-1 bg-white rounded">
                                        <div>
                                            <strong class="d-block text-dark">Current Logo Active</strong>
                                            <small class="text-muted">Displays in header & footer.</small>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch me-2">
                                        <input class="form-check-input" type="checkbox" name="remove_logo" value="1" id="removeLogo">
                                        <label class="form-check-label text-danger fw-semibold" for="removeLogo">Remove Logo</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Site Favicon Image</label>
                            <input type="file" name="favicon_file" class="form-control" accept="image/*,.ico">
                            <small class="text-muted d-block mt-1">Upload 32x32 ICO, PNG, or SVG favicon image for browser tab.</small>
                            @if(!empty($settings['site_favicon']))
                                <div class="mt-3 p-3 bg-light rounded border d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ Str::startsWith($settings['site_favicon'], ['http://', 'https://']) ? $settings['site_favicon'] : asset($settings['site_favicon']) }}" alt="Favicon" style="max-height:36px;" class="border p-1 bg-white rounded">
                                        <div>
                                            <strong class="d-block text-dark">Current Favicon Active</strong>
                                            <small class="text-muted">Displays in browser tab.</small>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch me-2">
                                        <input class="form-check-input" type="checkbox" name="remove_favicon" value="1" id="removeFavicon">
                                        <label class="form-check-label text-danger fw-semibold" for="removeFavicon">Remove Favicon</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- 7. Custom Scripts Settings -->
                <div class="tab-pane fade" id="scripts-panel" role="tabpanel" aria-labelledby="scripts-tab">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Head Scripts</label>
                            <textarea name="head_scripts" class="form-control font-monospace text-muted" rows="6" placeholder="<script>...</script>">{!! $settings['head_scripts'] ?? '' !!}</textarea>
                            <small class="text-muted d-block mt-1">Injected just before the closing &lt;/head&gt; tag. (e.g., Meta Pixel, Google Analytics, Custom CSS)</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Body Scripts</label>
                            <textarea name="body_scripts" class="form-control font-monospace text-muted" rows="6" placeholder="<script>...</script>">{!! $settings['body_scripts'] ?? '' !!}</textarea>
                            <small class="text-muted d-block mt-1">Injected just before the closing &lt;/body&gt; tag. (e.g., Live Chat, additional tracking scripts)</small>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            
            <div id="uploadProgressContainer" style="display: none;" class="mb-3">
                <div class="d-flex justify-content-between mb-1">
                    <span class="fw-semibold text-primary" id="uploadProgressText">Uploading... 0%</span>
                </div>
                <div class="progress" style="height: 10px;">
                    <div id="uploadProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary px-4 py-2" id="saveSettingsBtn">
                <i class="bi bi-save me-1"></i> Save Settings
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('settingsForm').addEventListener('submit', function (e) {
        e.preventDefault();
        
        let videoInput = document.querySelector('input[name="video_file"]');
        let videoFile = videoInput ? videoInput.files[0] : null;
        
        let formData = new FormData(this);
        let submitBtn = document.getElementById('saveSettingsBtn');
        let progressBarContainer = document.getElementById('uploadProgressContainer');
        let progressBar = document.getElementById('uploadProgressBar');
        let progressText = document.getElementById('uploadProgressText');
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving...';
        
        if (videoFile) {
            progressBarContainer.style.display = 'block';
        }
        
        let xhr = new XMLHttpRequest();
        xhr.open('POST', this.action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        
        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable && videoFile) {
                let percentComplete = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = percentComplete + '%';
                progressBar.setAttribute('aria-valuenow', percentComplete);
                progressText.innerText = 'Uploading... ' + percentComplete + '%';
            }
        };
        
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Settings updated successfully.',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-save me-1"></i> Save Settings';
                progressBarContainer.style.display = 'none';
                
                let errorMsg = 'Something went wrong. Please try again.';
                try {
                    let res = JSON.parse(xhr.responseText);
                    if(res.message) errorMsg = res.message;
                } catch(e) {}
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMsg,
                });
            }
        };
        
        xhr.onerror = function() {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-save me-1"></i> Save Settings';
            progressBarContainer.style.display = 'none';
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Network error occurred. Please try again.',
            });
        };
        
        xhr.send(formData);
    });
</script>
@endpush

@push('styles')
<style>
    /* Custom Scrollbar for Desktop */
    .hide-scrollbar::-webkit-scrollbar {
        height: 4px;
    }
    .hide-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9; 
        border-radius: 4px;
    }
    .hide-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1; 
        border-radius: 4px;
    }
    .hide-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8; 
    }
    
    /* Hide scrollbar completely on mobile (touch devices) */
    @media (max-width: 768px) {
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    }
    
    /* Custom Beautiful Tabs */
    .custom-tabs {
        border-bottom: 2px solid #edf2f7;
        gap: 8px;
        padding-bottom: 0;
    }
    .custom-tabs .nav-item {
        margin-bottom: -2px;
    }
    .custom-tabs .nav-link {
        color: #64748b;
        font-weight: 500;
        font-size: 15px;
        border: none;
        border-bottom: 2px solid transparent;
        padding: 12px 16px;
        border-radius: 0;
        transition: all 0.2s ease;
        background: transparent;
    }
    .custom-tabs .nav-link:hover {
        color: #3b82f6;
        border-bottom: 2px solid #cbd5e1;
    }
    .custom-tabs .nav-link.active {
        color: #2563eb;
        border-bottom: 2px solid #2563eb;
        font-weight: 600;
    }
    .custom-tabs .nav-link i {
        font-size: 1.1em;
        vertical-align: text-bottom;
    }
</style>
@endpush
