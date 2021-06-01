<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/') }}/storage/webconfigs/logo-1610999163.png">
    <link rel="icon" type="image/png" href="{{ url('/') }}/storage/webconfigs/logo-1610999163.png">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Kanit:300&display=swap" >
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('assets/material/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets/material/demo/demo.css') }}" rel="stylesheet" />

</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('assets/material/img/sidebar-2.jpg') }}">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
        Tip 2: you can also add an image using data-image tag
        -->
            <div class="logo">
                <a href="{{ url('/') }}" class="simple-text logo-normal">
                    <img src="{{ url('/') }}/storage/webconfigs/logo-1610999163.png" alt="">
                    Malaiplace
                </a>
            </div>
            <div class="sidebar-wrapper">
                @include('admin.sidebar')
            </div>
        </div>

        <div class="main-panel">
            <!-- Navbar -->
            @include('admin.navbar')
            <!-- End Navbar -->

            <div class="content">
                @yield('content')
            </div>

            <footer class="footer">
                <!-- footer -->
                {{-- @include('admin.footer') --}}
                <!-- End footer -->
            </footer>
        </div>
    </div>

    <!-- fixed-plugin -->
    {{-- @include('admin.fixed-plugin') --}}
    <!-- End fixed-plugin -->

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/material/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/material/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/material/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('assets/material/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <!-- Plugin for the momentJs  -->
    <script src="{{ asset('assets/material/js/plugins/moment.min.js') }}"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="{{ asset('assets/material/js/plugins/sweetalert2.js') }}"></script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/material/js/plugins/jquery.validate.min.js') }}"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/material/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/material/js/plugins/bootstrap-selectpicker.js') }}"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{{ asset('assets/material/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="{{ asset('assets/material/js/plugins/jquery.dataTables.min.js') }}"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="{{ asset('assets/material/js/plugins/bootstrap-tagsinput.js') }}"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('assets/material/js/plugins/jasny-bootstrap.min.js') }}"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="{{ asset('assets/material/js/plugins/fullcalendar.min.js') }}"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="{{ asset('assets/material/js/plugins/jquery-jvectormap.js') }}"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('assets/material/js/plugins/nouislider.min.js') }}"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script> --}}
    <script src="{{ asset('assets/material/js/core/core.js?v=2.4.1') }}"></script>
    <!-- Library for adding dinamically elements -->
    <script src="{{ asset('assets/material/js/plugins/arrive.min.js') }}"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chartist JS -->
    <script src="{{ asset('assets/material/js/plugins/chartist.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('assets/material/js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/material/js/material-dashboard.js?v=2.1.2') }}" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/material/demo/demo.js') }}"></script>
    {{-- <script>
        $(document).ready(function() {
            $().ready(function() {
                $sidebar = $('.sidebar');
                $sidebar_img_container = $sidebar.find('.sidebar-background');
                $full_page = $('.full-page');
                $sidebar_responsive = $('body > .navbar-collapse');
                window_width = $(window).width();
                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
                if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                    if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                        $('.fixed-plugin .dropdown').addClass('open');
                    }
                }
                $('.fixed-plugin a').click(function(event) {
                    // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });
                $('.fixed-plugin .active-color span').click(function() {
                    $full_page_background = $('.full-page-background');
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');
                    var new_color = $(this).data('color');
                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-color', new_color);
                    }
                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }
                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data-color', new_color);
                    }
                });
                $('.fixed-plugin .background-color .badge').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');
                    var new_color = $(this).data('background-color');
                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-background-color', new_color);
                    }
                });
                $('.fixed-plugin .img-holder').click(function() {
                    $full_page_background = $('.full-page-background');
                    $(this).parent('li').siblings().removeClass('active');
                    $(this).parent('li').addClass('active');
                    var new_image = $(this).find("img").attr('src');
                    if ($sidebar_img_container.length != 0 && $(
                            '.switch-sidebar-image input:checked').length != 0) {
                        $sidebar_img_container.fadeOut('fast', function() {
                            $sidebar_img_container.css('background-image', 'url("' +
                                new_image + '")');
                            $sidebar_img_container.fadeIn('fast');
                        });
                    }
                    if ($full_page_background.length != 0 && $(
                            '.switch-sidebar-image input:checked').length != 0) {
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                            'img').data('src');
                        $full_page_background.fadeOut('fast', function() {
                            $full_page_background.css('background-image', 'url("' +
                                new_image_full_page + '")');
                            $full_page_background.fadeIn('fast');
                        });
                    }
                    if ($('.switch-sidebar-image input:checked').length == 0) {
                        var new_image = $('.fixed-plugin li.active .img-holder').find("img")
                            .attr('src');
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                            'img').data('src');
                        $sidebar_img_container.css('background-image', 'url("' + new_image +
                            '")');
                        $full_page_background.css('background-image', 'url("' +
                            new_image_full_page + '")');
                    }
                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                    }
                });
                $('.switch-sidebar-image input').change(function() {
                    $full_page_background = $('.full-page-background');
                    $input = $(this);
                    if ($input.is(':checked')) {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar_img_container.fadeIn('fast');
                            $sidebar.attr('data-image', '#');
                        }
                        if ($full_page_background.length != 0) {
                            $full_page_background.fadeIn('fast');
                            $full_page.attr('data-image', '#');
                        }
                        background_image = true;
                    } else {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar.removeAttr('data-image');
                            $sidebar_img_container.fadeOut('fast');
                        }
                        if ($full_page_background.length != 0) {
                            $full_page.removeAttr('data-image', '#');
                            $full_page_background.fadeOut('fast');
                        }
                        background_image = false;
                    }
                });
                $('.switch-sidebar-mini input').change(function() {
                    $body = $('body');
                    $input = $(this);
                    if (md.misc.sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        md.misc.sidebar_mini_active = false;
                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
                    } else {
                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');
                        setTimeout(function() {
                            $('body').addClass('sidebar-mini');
                            md.misc.sidebar_mini_active = true;
                        }, 300);
                    }
                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);
                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);
                });
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();
        });
    </script>


    <script type="text/javascript">
        function autoTab2(obj, typeCheck) {
            if (typeCheck == 1) {
                var pattern = new String("_-____-_____-__-_");
                var pattern_ex = new String("-");
            } else {
                var pattern = new String("___-___-____");
                var pattern_ex = new String("-");
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
        function onChangeDate() {
            let begin = '';
            let end = '';
            begin = $('#begin').val();
            end = $('#end').val();
            if (begin > end) {
                alert('กรุณาเลือกวันให้ถูกต้องด้วยคะ...')
                $("#end").val('');
            }
        }
    </script>

<script type="text/javascript">
    function autoTab2(obj, typeCheck) {
        if (typeCheck == 1) {
            var pattern = new String("_-____-_____-__-_");
            var pattern_ex = new String("-");
        } else {
            var pattern = new String("___-___-____");
            var pattern_ex = new String("-");
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
    function onChangeDate() {
        let begin = '';
        let end = '';
        begin = $('#begin').val();
        end = $('#end').val();
        if (begin > end) {
            alert('กรุณาเลือกวันให้ถูกต้องด้วยคะ...')
            $("#end").val('');
        }
    }
</script>

<!-- JS Script Booking -->
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Modal Show Photo Booking Slip ok
        $("#dataTableBooking").on('click', '#photoBooking', function() {
            $('#ModalShowBooking').modal('show');
            $('#ModalShowBooking .category').html($(this).data('title'));
            $('#ModalShowBooking #photoShowBooking').attr('src', '{{ url('/') }}/storage/' + $(this).data('img') + '');
            $("#ModalShowBooking .showbooking a").attr('href',"{{ url('/booking') }}" + '/' + $(this).data('id'));
            if ($(this).data('status') === 'booking') {
                $('#ModalShowBooking .confirm').html('<button type="button" class="btn btn-success btn-block confirmbooking" data-id="' + $(this).data('id') + '">ยืนยันการจอง</button>');
            }
        });

        $('body #ModalShowBooking').on('click', '.confirmbooking', function() {
            if ($(this).data('id')) {
                var confirm = confirm("คุณแน่ใจใช่หรือไม่ที่ต้องการยืนยันการจองห้องเช่านี้ ?");
                if (confirm == true) {
                    $.ajax({
                        url: "{{ url('booking-confirm') }}" + '?bkgid=' + $(this).data('id'),
                        type: "GET",
                        success: function(data) {
                            if (data.success) {
                                var content = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>ยืนยันการจองห้องเรียบร้อยแล้วคะ!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                                $('#ModalShowBooking .modal-footer .confirm').html('');
                                $('#ModalShowBooking').modal('hide');
                                $("#dataTableBooking").load("{{ url('/booking') }} #dataTableBooking");
                                document.getElementById("bookingconfirm").innerHTML = content;
                            } else {
                                $('#ModalShowBooking').modal('hide');
                                alert('เกิดข้อผิดพลาด? ไม่สามารถยืนยันการจอง!');
                                $("#dataTableBooking").load("{{ url('/booking') }} #dataTableBooking");
                            }
                        },
                        error: function(data) {
                            alert('Error:', data);
                        }
                    });
                }
            }else{
                alert('NO ID:');
            }
        });
    });
</script>


    <!-- JS Script Notices -->
    <script type="text/javascript">
        $(document).ready(function() {

            // Modal Show Photo Notice ok
            $("#dataNotice").on('click', '#photoNotice', function() {
                $('#ModalShowNotice').modal('show');
                $('.modal-title').html($(this).data('title'));
                $('#ModalShowNotice #photoShowNotice').attr('src', '{{ url('/') }}/storage/' + $(this).data('img') + '');
            });
        });
    </script>

    <!-- Theme JS Files DataTables Ajax -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("#dataTableBooking").on('click', '#photoBooking', function() {
                var path = $(this).attr("path");
                var title = $(this).attr("title");
                $('#ModalPhotoBooking').modal('show');
                $('.modal-title').html(title);
                $('#ShowPhotoBooking').html('<img src="' + path +
                    '" class="img-fluid rounded-lg border border-success">');
            });
            // Modal Receipt Invoice
            $("#dataTableInvoice").on('click', '#ReceiptInvoice', function() {
                var path = $(this).attr("path");
                var title = $(this).attr("title");
                $('#ModalReceiptInvoice').modal('show');
                $('.modal-title').html(title);
                $('#ShowReceiptInvoice').html('<img src="' + path +
                    '" class="img-fluid rounded-lg border border-success">');
            });

             // Modal Confirm Maintenance
            $("#dataTableMaintenance").on('click', '#mtn_confirm', function() {
                $('#ModalConfirmMaintenance').modal('show');
                $('#ModalConfirmMaintenance .category').html($(this).data('date'));
                $('#ModalConfirmMaintenance textarea').val($(this).data('detail'))
                $("#ModalConfirmMaintenance .mnt-id input").val($(this).data('id'));
            });

            $("#dataTableIncome").on('click', '#ShowModalIncome', function() {
                $('#ModalShowIncome').modal('show');
                $('#ModalShowIncome .category').html('วันที่ '+ $(this).data('date'));
                if ($(this).data('income') > 0) {
                    $('#ModalShowIncome #type').val('รายรับ');
                    $('#ModalShowIncome #income').val($(this).data('income'))
                } else {
                    $('#ModalShowIncome #type').val('รายจ่าย');
                    $('#ModalShowIncome #income').val($(this).data('income') * (-1))
                }
                $("#ModalShowIncome #remark").val($(this).data('remark'));
            });

            $("#dataTableIncome").on('click', '#ShowModalUpdateIncome', function() {
                $('#ModalUpdateIncome').modal('show');
                $('#ModalUpdateIncome .modal-title').html('ดูข้อมูลบัญชี  : ' + $(this).data('id') + ' วันที่ '+ $(this).data('date'));
                $('#ModalUpdateIncome #id').val($(this).data('id'));
                if ($(this).data('income') > 0) {
                    $('#ModalUpdateIncome #type').val('รายรับ');
                    $('#ModalUpdateIncome #income').val($(this).data('income'))
                } else {
                    $('#ModalUpdateIncome #type').val('รายจ่าย');
                    $('#ModalUpdateIncome #income').val($(this).data('income') * (-1))
                }
                $("#ModalUpdateIncome #remark_item").val($(this).data('remark'));
            });
        });
    </script>

    <!-- FileInput -->
    <script type="text/javascript">
        $(document).ready(function() {

            // FileInput
            $('.form-file-simple .inputFileVisible').click(function() {
                $(this).siblings('.inputFileHidden').trigger('click');
            });

            $('.form-file-simple .inputFileHidden').change(function() {
                var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
                $(this).siblings('.inputFileVisible').val(filename);
            });

            $('.form-file-multiple .inputFileVisible, .form-file-multiple .input-group-btn').click(function() {
                $(this).parent().parent().find('.inputFileHidden').trigger('click');
                $(this).parent().parent().addClass('is-focused');
            });

            $('.form-file-multiple .inputFileHidden').change(function() {
            var names = '';
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                if (i < $(this).get(0).files.length - 1) {
                names += $(this).get(0).files.item(i).name + ',';
                } else {
                names += $(this).get(0).files.item(i).name;
                }
            }
            $(this).siblings('.input-group').find('.inputFileVisible').val(names);
            });

            $('.form-file-multiple .btn').on('focus', function() {
                $(this).parent().siblings().trigger('focus');
            });

            $('.form-file-multiple .btn').on('focusout', function() {
                $(this).parent().siblings().trigger('focusout');
            });

            // Check Upload Photo Room
            $("#formRoom #photo1").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#photo1").val('');
                    return false;
                }
            });
            $("#formRoom #photo2").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#photo2").val('');
                    return false;
                }
            });
            $("#formRoom #photo3").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#photo3").val('');
                    return false;
                }
            });
            $("#formRoom #photo4").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#photo4").val('');
                    return false;
                }
            });

            // Check Upload Photo User
            $("#formUser #photo").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formUser #photo").val('');
                    return false;
                }
            });
                    // Check Upload file lease
            $("#formLease #idcard_doc").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['application/pdf'];
                if (!((fileType == match[0]))) {
                    alert('กรุณาเลือกไฟล์ .pdf เท่านั้นคะ......');
                    $("#idcard_doc").val('');
                    $("#idcard_doc_text").val('');
                    return false;
                }
            });
            $("#formLease #lease_doc").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['application/pdf'];
                if (!((fileType == match[0]))) {
                    alert('กรุณาเลือกไฟล์ .pdf เท่านั้นคะ......');
                    $("#lease_doc").val('');
                    $("#lease_doc_text").val('');
                    return false;
                }
            });

            // Check Upload Photo Type ok
            $("#formType #photo").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formType #photo").val('');
                    return false;
                }
            });

            // Check Upload Photo Notices ok
            $("#formNotice #photo").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formNotice #photo").val('');
                    return false;
                }
            });
            // SHOW Photo Notices ok
            $("#formNotice #file").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['application/pdf'];
                if (!((fileType == match[0]))) {
                    alert('กรุณาเลือกไฟล์ .pdf เท่านั้นคะ......');
                    $("#file").val('');
                    return false;
                }
            });
        });

    </script>

    <!-- JS Script Config -->
    <script type="text/javascript">
        $(document).ready(function() {
            // Check Upload Photo Config
            $("#formConfig #logo").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formConfig #logo").val('');
                    return false;
                }
            });

            $("#formConfig #bbl_logo").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formConfig #bbl_logo").val('');
                    return false;
                }
            });


            $("#formConfig #kbsnk_logo").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formConfig #kbsnk_logo").val('');
                    return false;
                }
            });

            $("#formConfig #scb_logo").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formConfig #scb_logo").val('');
                    return false;
                }
            });

            $("#formConfig #bay_logo").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formConfig #bay_logo").val('');
                    return false;
                } else {
                    let files = this.files
                    bay_logo(files)
                }
            });

            $("#formConfig #photo1").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formConfig #photo1").val('');
                    return false;
                }
            });

            $("#formConfig #photo2").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formConfig #photo2").val('');
                    return false;
                }
            });

            $("#formConfig #photo3").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formConfig #photo3").val('');
                    return false;
                }
            });

            $("#formConfig #photo4").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formConfig #photo4").val('');
                    return false;
                }
            });

            $("#formConfig #photo5").change(function() {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['image/jpeg', 'image/png'];
                if (!((fileType == match[0]) || (fileType == match[1]))) {
                    alert('กรุณาเลือกไฟล์รูปภาพเท่านั้นค่ะ......');
                    $("#formConfig #photo5").val('');
                    return false;
                }
            });

            //Admin Change Password
            $('.navbar').on('click', '#AdminChangePassword', function() {
                $('#ModalChangePassword').modal('show');
            });
        });
    </script>

</body>

</html>
