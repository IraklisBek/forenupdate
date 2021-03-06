@extends('visitor.main')

@section('title', '| Contact')

@section('stylesheets')
    {{ Html::script('tinymce/js/tinymce/tinymce.min.js') }}
    {!! Html::style('visitor/css/contact.css') !!}
    <style>
        body{
            background-color:black !important;;
        }
        p{
            color: white;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .btn:focus, .btn.focus, .btn:active:focus, .btn:active.focus, .btn.active:focus, .btn.active.focus {
            outline: 5px auto -webkit-focus-ring-color;
            outline-offset: -2px;
        }

        .btn:focus, .btn:hover {
            text-decoration: none;
        }

        .btn.focus {
            text-decoration: none;
        }

        .btn:active, .btn.active {
            background-image: none;
            outline: 0;
        }

        .btn.disabled, .btn:disabled {
            cursor: not-allowed;
            opacity: .65;
        }
        .btn-primary {
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
        }
        .btn-primary:hover {
            color: #fff;
            background-color: #025aa5;
            border-color: #01549b;
        }

    </style>
    <script>

    </script>
@endsection

@section('content')
    <!-- Main Content -->
    <div id="contact" style="margin-bottom:100px;">
        <div method="post" id="ContactForm" action="{{ route('pages.postContact') }}">
            <div id="contactF" style="margin-bottom:0; margin-top:10%;">

                <div id="contactForm" style="margin-bottom:0">
                    {!! csrf_field() !!}
                <div class="form-group">
                    <input placeholder="Name" type="text" name="name" id="name" class="form-control"  style="background-color:white !important; background: url('visitor/images/general/username.png') no-repeat left center; padding-left:40px; " required>
                </div>
                <div class="form-group">
                    <input placeholder="E-Mail" type="email" name="email" id="email" class="form-control" style="background-color:white !important; background: url('visitor/images/general/email.png') no-repeat left center; padding-left:40px;" required>
                </div>
                <div class="form-group">
                    <input placeholder="Organization Name" type="text" name="orgname" id="orgname" class="form-control" style="background-color:white !important; background: url('visitor/images/general/orgname.png') no-repeat left center; padding-left:40px;" required>
                </div>
                <div class="form-group">
                    <input placeholder="Subject" type="text" name="subject" id="subject" class="form-control" style="background-color:white !important; background: url('visitor/images/contact/subject.png') no-repeat left center; padding-left:40px;" required>
                </div>
                <div class="form-group">
                    <textarea rows=8 placeholder="Your e-mail" name="body" id="body" class=form-control style=" padding-left:40px;" required=required></textarea>
                </div>
                <input id="sendEmail" type="submit" value="Send e-mail" class="btn btn-primary" style="margin-top:2%">
            </div>
        </div>
        </form>
        <div id="form-messages" style="width:20%; text-align:center; margin-top:-2%; margin-left:40%; padding:25px; background-color:rgb(29, 91, 104); display:none; "></div>
        <img alt="hr" src=visitor/images/general/megaligrammi.png width="95%" style="margin-left:2.5%; height:2px; margin-top:2%; ">
        <div id="contactI" >
            <div id="contactInfo" style="margin-left:1%;">
                <ul style="width:9%; float:left; list-style-type:none; color:white">
                    <li>Address: </li>
                    <li>Phone: </li>
                    <li>Email: </li>
                </ul>
                <ul style="width:70%; float:left; list-style-type:none; margin-left:10%; color:white">
                    <li style="width:100%">Kosti Palama 3, 555 34 Pylaia,
                        Thessaloniki, Greece</li>
                    <li>+30 2310 944121</li>
                    <li>info@foren.gr</li>
                </ul>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            toastr.options = {
                positionClass: "toast-top-center"
            };
        });

        $('#ContactForm').submit(function(event){
            $('#sendEmail').css('cursor', 'not-allowed').attr("disabled", "disabled");
            var name = $('#name').val();
            var orgname = $('#orgname').val();
            var email = $('#email').val();
            var subject = $('#subject').val();
            var body = $('#body').val();
            $.ajax({
                type: "POST",
                url: '/contact',
                data: {name: name, orgname: orgname, email: email, subject: subject, body: body},
                success: function (response) {
                    var notify = toastr.success('Your e-mail has been send');
                    var $notifyContainer = jQuery(notify).closest('.toast-top-center');
                    $('#sendEmail').css('cursor', 'pointer').removeAttr("disabled");
                },
                error : function(responce){
                    var notify = toastr.error('Your e-mail could not been send. Please try again later');
                    var $notifyContainer = jQuery(notify).closest('.toast-top-center');
                    $('#sendEmail').css('cursor', 'pointer').removeAttr("disabled");
                }
            });
            event.preventDefault(); //STOP default action
        });
        setInterval(function(){
            $('#contactI ul').css("font-size", window.innerWidth*0.015);
            $('#contactfooter').css("font-size", window.innerWidth*0.014);
            $('#contactfooter').css("padding", window.innerWidth*0.013);
        },1);
    </script>
@endsection


