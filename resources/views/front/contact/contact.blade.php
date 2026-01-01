@extends('front.template.master')
@section('title', $PageInfo->Name)
@section('description', $PageInfo->MetaDescription)
@section('keywords',$PageInfo->MetaKeyword)
@section('title', $PageInfo->Name ?? 'Liên hệ') 
@section('url', url('lien-he'))
@section('images', url('images/page/'.$PageInfo->Images ?? ''))

@section('lien-he', 'active')
@section('content')
<div class="container py-5">
    {{-- Phần tiêu đề giữ nguyên --}}
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="border-start border-4 border-warning ps-3">Liên hệ</h2>
            <p class="text-muted mt-3">
                (Nội dung giới thiệu...)
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        {{-- Cột Map giữ nguyên --}}
        <div class="col-md-6 mb-4">
            <div class="map-container h-100">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.424167504386!2d106.6900!3d10.7755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDQ2JzMxLjgiTiAxMDbCsDQxJzI0LjAiRQ!5e0!3m2!1svi!2s!4v1600000000000!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <div class="col-md-6">
            {{-- 1. THÊM id="contactForm" VÀO ĐÂY --}}
            <form id="contactForm" action="{{ route('contact.post') }}" method="POST">
                @csrf 
                
                <div class="mb-3">
                    <input type="text" name="Name" class="form-control p-3" placeholder="Họ và tên..." required>
                    @error('Name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    {{-- 2. THÊM id="email" VÀO ĐÂY --}}
                    <input type="email" name="Email" id="email" class="form-control p-3" placeholder="Email..." required>
                    
                    {{-- Lỗi từ Server --}}
                    @error('Email') <span class="text-danger small">{{ $message }}</span> @enderror
                    
                    {{-- 3. THÊM SPAN HIỂN THỊ LỖI JS VÀO ĐÂY --}}
                    <span id="emailError" class="text-danger small" style="display:none;">
                        Email không đúng định dạng (ví dụ: abc@gmail.com)
                    </span>
                </div>

                <div class="mb-3">
                    <input type="text" name="Phone" class="form-control p-3" placeholder="Số điện thoại..." required>
                    @error('Phone') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <textarea name="Message" class="form-control p-3" rows="5" placeholder="Lời nhắn..." required></textarea>
                    @error('Message') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-dark px-5 py-2 fw-bold text-uppercase" style="background-color: #333;">
                    Gửi liên hệ
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Phần Footer giữ nguyên --}}
<div class="bg-dark text-white py-4 mt-5" style="border-top: 2px solid #ff6600;">
   {{-- ... --}}
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Bây giờ JS mới tìm thấy được các thẻ này
        const form = document.getElementById('contactForm');
        const emailInput = document.getElementById('email');
        const errorSpan = document.getElementById('emailError');

        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
            return regex.test(email);
        }

        // Sự kiện gõ phím
        if(emailInput) { // Kiểm tra tồn tại để tránh lỗi console
            emailInput.addEventListener('input', function() {
                const emailValue = emailInput.value.trim();
                
                if (emailValue === "") {
                    errorSpan.style.display = 'none';
                    emailInput.classList.remove('is-invalid');
                } else if (!isValidEmail(emailValue)) {
                    errorSpan.style.display = 'block';
                    emailInput.classList.add('is-invalid');
                } else {
                    errorSpan.style.display = 'none';
                    emailInput.classList.remove('is-invalid');
                    emailInput.classList.add('is-valid');
                }
            });
        }

        // Sự kiện Submit
        if(form) {
            form.addEventListener('submit', function(event) {
                const emailValue = emailInput.value.trim();
                
                // Kiểm tra lại lần cuối trước khi gửi
                if (!isValidEmail(emailValue)) {
                    event.preventDefault(); // CHẶN GỬI FORM Ở ĐÂY
                    errorSpan.style.display = 'block';
                    emailInput.classList.add('is-invalid');
                    emailInput.focus();
                    alert("Vui lòng nhập đúng địa chỉ Email trước khi gửi!");
                }
            });
        }
    });
</script>
@endsection