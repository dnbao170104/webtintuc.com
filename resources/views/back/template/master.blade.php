<!-- resources/views/back/template/master.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <!-- Trong master.blade.php -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>
    <title>Admin Dashboard</title>
    @include('back.template.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('back.template.navbar')
    @include('back.template.sidebar')
    
    <!-- Flash Messages -->
    <div class="content-wrapper">
        <section class="content">
    <div class="container-fluid">
        @if(Session::has('flash_message'))
            <div class="ad-message alert alert-{{ Session::get('flash_level') }}">
                {!! Session::get('flash_message') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- Main content -->
        @yield('content')
        <!-- /.content -->
    </div>
</section>
    </div>
    
    @include('back.template.footer')
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap Bundle (gồm Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- OverlayScrollbars -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/js/OverlayScrollbars.min.js"></script>

<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>{{ url("public/filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=") }}</script>

<script>
    CKEDITOR.replace('ckeditor',{
        filebrowserBrowseUrl : '{!! url("public/filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=") !!}',
        filebrowserUploadUrl : '{!! url("public/filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=") !!}',
        filebrowserImageBrowseUrl : '{!! url("public/filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=") !!}'
    });
</script>
<script>
function ChangeToSlug()
{
    var title, slug;

    //Lấy text từ thẻ input title
    title = document.getElementById("title").value;

    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    document.getElementById('slug').value = slug;
};

</>
</body>
</html><!-- resources/views/back/template/master.blade.php -->
