<footer class="footer-section">

    <div class="footer-overlay"></div> <div class="container footer-content">
        <div class="subscribe-box">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0 text-white">Đăng ký nhận tin khuyến mại</h5>
                </div>
                <div class="col-md-6">
                    <form action="" method="POST">
                        <div class="input-group">
                            <input type="email" class="form-control subscribe-input" placeholder="Email của bạn..." id="txtEmailSub">
                            
                            <button class="btn btn-orange" type="button" id="btnSendSub">SEND</button>
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
                <div class="mb-0" style="font-size: 14px; opacity: 0.8; color: white;">
                    @if(isset($copyright))
                        {!! $copyright->Description !!}
                    @else
                        Copyright © 2024 SCF.
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom-bar"></div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> <script>
    $(document).ready(function(){
        $('#btnSendSub').click(function(){
            // 1. Lấy giá trị email
            var txtEmailSub = $('#txtEmailSub').val();

            // 2. Regex kiểm tra email
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

            // 3. Kiểm tra rỗng
            if(txtEmailSub == ''){
                alert('Vui lòng nhập email!');
                return false;
            }

            // 4. Kiểm tra định dạng
            if (reg.test(txtEmailSub) == false){
                alert('Email không hợp lệ, vui lòng kiểm tra lại!');
                return false;
            }

            // 5. Nếu đúng
            alert('Email hợp lệ! Đang xử lý đăng ký...');
            // Tại đây bạn có thể viết thêm code Ajax để gửi dữ liệu về Server
        });
    });
</script>