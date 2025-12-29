$("#btnSendSub").click(function () {
    // Lấy giá trị từ ô nhập liệu
    var txtEmailSub = $("#txtEmailSub").val();

    // Biểu thức chính quy (Regex) để check email
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

    // Kiểm tra: Nếu sai định dạng thì báo lỗi
    if (reg.test(txtEmailSub) == false) {
        alert("Email không hợp lệ, vui lòng kiểm tra lại !");
        return false;
    }

    // Nếu đúng thì báo OK
    alert("Email này ok");
});
