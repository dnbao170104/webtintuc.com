

<footer class="footer-section">
    <div class="footer-overlay"></div>

    <div class="container footer-content">
        <div class="subscribe-box">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0 text-white">Đăng ký nhận tin khuyến mại</h5>
                </div>
                <div class="col-md-6">
                    <form action="" method="POST">
                        <div class="input-group">
                            <input type="email" class="form-control subscribe-input" placeholder="Email của bạn...">
                            <button class="btn btn-orange" type="submit">SEND</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-md-6">
                @if(isset($logo))
                    <img src="{{ url('images/logo/'.$logo->Description) }}" alt="SCF Logo" style="max-height: 60px;">
                @else
                    <h2 class="text-white" style="font-weight: bold; display: flex; align-items: center;">
                        <span style="color: #ff5722; margin-right: 5px;">SCF</span> 
                        <i class="fas fa-dove" style="font-size: 20px;"></i>
                    </h2>
                @endif
            </div>
            
            <div class="col-md-6 text-end">
                <p class="mb-0" style="font-size: 14px; opacity: 0.8;">
                    <div class="footer_copyright">{!! $copyright->Description !!}</div>
                </p>
            </div>
        </div>
    </div>

    <div class="footer-bottom-bar"></div>
</footer>