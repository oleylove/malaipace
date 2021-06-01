<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/') }}/storage/webconfigs/logo-1610999163.png">
    <link rel="icon" sizes="76x76" type="image/png" href="{{ url('/') }}/storage/webconfigs/logo-1610999163.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Sarabun" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Kanit:300&display=swap" rel="stylesheet">

    <!-- CSS Files Font Awesome Free 5.13.0 -->
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <style type="text/css">
        .receipt img {
            width: 250px;
            height: 250px;
            margin: 5px
        }
    </style>

</head>

<body style="font-family: Kanit">

    <div class="click-closed"></div>

    <div class="box-collapse">
        @include('layouts.formlogin')
    </div>

    <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
        @include('layouts.navbar')
    </nav>

    @yield('content')

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>

    <!-- JS Files jQuery JavaScript Library v3.3.1 -->
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>

    <!-- JS Files Popper Zivolo 2017 -->
    <script src="{{ asset('js/popper.min.js') }}"></script>

    <!-- JS Files Bootstrap v4.4.1 -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/scrollreveal/scrollreveal.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript">
        function autoTab2(obj, typeCheck) {
            if (typeCheck == 1) {
                var pattern = new String("_-____-_____-__-_"); // กำหนดรูปแบบในนี้
                var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
            } else {
                var pattern = new String("___-___-____"); // กำหนดรูปแบบในนี้
                var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
            }
            var returnText = new String("");
            var obj_l = obj.value.length;
            var obj_l2 = obj_l - 1;
            for (i = 0; i < pattern.length; i++) {
                if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                    returnText += obj.value + pattern_ex;
                    obj.value = returnText;
                }
            }
            if (obj_l >= pattern.length) {
                obj.value = obj.value.substr(0, pattern.length);
            }
        }
    </script>

    <!-- JS Files DataTables Ajax -->
    <script type="text/javascript">
        $(document).ready(function() {
            //Check Image file Receipt
            $("#bkg_receipt").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#bkg_receipt").val('');
                    return false;
                }
            });
            $("#bkg_receipt").on("change", function(e) {
                var files = this.files
                showReceipt(files)
            });
            // success comfirm booking ok
            $('#ModelConfirmBooking').on('submit', '#FormConfirmBooking', function(event) {
                event.preventDefault();
                $('#SaveComfirmBooking').attr('disabled', 'disabled');
                $.ajax({
                    url: "{{ url('confirm-booking') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#FormConfirmBooking')[0].reset();
                        $('#FormConfirmBooking').trigger("reset");
                        $('#FormConfirmBooking').css('opacity', '');
                        $("#FormConfirmBooking").removeAttr("disabled");
                        $('#ModelConfirmBooking').modal('hide');
                        $('#SaveComfirmBooking').attr('disabled', false);
                        location.href = "{{ url('payment-booking') }}";
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#SaveComfirmBooking').val('');
                    }
                });
            });
            // Comfirm Invoice receipt ok
            $("#dataInvoice").on('click', '#confirmIvn', function() {
                var inv_id = $(this).attr('inv_id');
                $('#ModalInv' + inv_id).modal('show');
                $('#FormConfirmInvoice')[0].reset();
                $('#SaveComfirmInvoice').val('แจ้งชำระเงิน');
            });
            //Check Image file Receipt
            $("#inv_pay_receipt").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#inv_pay_receipt").val('');
                    return false;
                }
            });
            $("#inv_pay_receipt").on("change", function(e) {
                var files = this.files
                showReceipt(files)
            });
            // success comfirm Invoice ok
            $('#ModelConfirmInvoice').on('submit', '#FormConfirmInvoice', function(event) {
                event.preventDefault();
                $('#SaveComfirmInvoice').attr('disabled', 'disabled');
                $.ajax({
                    url: "{{ url('confirm-invoice') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#FormConfirmInvoice')[0].reset();
                        $('#FormConfirmInvoice').trigger("reset");
                        $('#FormConfirmInvoice').css('opacity', '');
                        $("#FormConfirmInvoice").removeAttr("disabled");
                        $('#ModelConfirmInvoice').modal('hide');
                        $('#SaveComfirmInvoice').attr('disabled', false);
                        location.href = "{{ url('user-invoice') }}";
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#SaveComfirmInvoice').val('');
                    }
                });
            });
            // SHOW Receipt
            function showReceipt(files) {
                $("#receipt").html("");
                for (var i = 0; i < files.length; i++) {
                    var file = files[i]
                    var image = document.createElement("img");
                    var receipt = document.getElementById("receipt");
                    image.file = file;
                    receipt.appendChild(image)
                    var reader = new FileReader()
                    reader.onload = (function(aImg) {
                        return function(e) {
                            aImg.src = e.target.result;
                        };
                    }(image))
                    var ret = reader.readAsDataURL(file);
                    var canvas = document.createElement("canvas");
                    ctx = canvas.getContext("2d");
                    image.onload = function() {
                        ctx.drawImage(image, 200, 200)
                    }
                } // end for loop
            } // end receipt


            // Show Modal Change Password
            $("body #navbarDefault").on('click', '#UserChangePassword', function() {
                $('#ModalChangePassword').modal('show');
            });

            // Show data Notice
            $("#dataNotice").on('click', '#photoNotice', function() {
                $('#ModalShowNotice').modal('show');
                $('#ModalShowNotice .modal-title').html('ประกาศจากทางอพาร์ทเม้นท์');
                $('#ModalShowNotice #detailShowNotice').html($(this).data('detail'));

                if ($(this).data('img')) {
                    $('#ModalShowNotice #photoShowNotice').attr('src', '{{ url('/') }}/storage/' + $(this).data('img'));
                } else {
                    $('#ModalShowNotice #photoShowNotice').attr('src', '{{ url('/') }}/storage/404/404.jpg');
                }
            });

            // Show data Maintenance
            $("#dataMaintenance").on('click', '#ShowMaintenance', function() {
                $('#ModalShowMaintenance').modal('show');
                $('#ModalShowMaintenance .card-header').html('ผู้เช่า : ' + $(this).data('user') + ' ห้อง : ' + $(this).data('number') + ' ตึก : ' + $(this).data('building'));
                $('#ModalShowMaintenance .mtn-date').html('วันแจ้ง : ' + $(this).data('date'));
                $('#ModalShowMaintenance .mtn-detail').html('รายละเอียด : ' + $(this).data('detail'));
                $('#ModalShowMaintenance .mtn-status').html('สถานะ : ' + $(this).data('status'));
                $('#ModalShowMaintenance .mtn-done').html('เสร็จสิ้น : ' + $(this).data('done'));
                $('#ModalShowMaintenance .mtn-price').html('ค่าซ่อม : ' + $(this).data('price'));
            });
        });

    </script>

</body>

</html>
