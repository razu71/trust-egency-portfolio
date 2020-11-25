<!-- start footer section -->

<link rel="stylesheet" href="{{asset('admin/css/sweetalert2.css')}}">

<footer class="footer" id="contact">
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="footer__title">Contact us</div>
					<ul class="footer-contacts">
						<li class="footer-contacts__item">@if(!empty(setting('address'))) {{setting('address')}} @endif</li>
						<li class="footer-contacts__item">Phone: <a class="footer-contacts__link" href="tel:@if(!empty(setting('phone'))) {{setting('phone')}} @endif">@if(!empty(setting('phone'))) {{setting('phone')}} @endif</a></li>
						<li class="footer-contacts__item">Email: <a class="footer-contacts__link" href="mailto:@if(!empty(setting('email'))) {{setting('email')}} @endif">@if(!empty(setting('email'))) {{setting('email')}} @endif</a></li>
					</ul>
					<div class="footer-social">
						<a href="@if(!empty(setting('facebook'))) {{setting('facebook')}} @endif"><i class="ico-7 footer-social__item"></i></a>
						<a href="@if(!empty(setting('twitter'))) {{setting('twitter')}} @endif"><i class="ico-6 footer-social__item"></i></a>
						<a href="@if(!empty(setting('google_plus'))) {{setting('google_plus')}} @endif"><i class="ico-5 footer-social__item"></i></a>
						<a href="@if(!empty(setting('linked_in'))) {{setting('linked_in')}} @endif"><i class="ico-2 footer-social__item"></i></a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="footer__title">Get in touch</div>
					{{--<form class="footer-form">--}}
						<input class="footer-form__input" type="text" name="formName" placeholder="Name" id="name" required>
						<input class="footer-form__input" type="email" name="formEmail" placeholder="Email" id="email">
						<input class="footer-form__input" type="number" name="formNumber" placeholder="number" id="number" required>
						<input class="footer-form__input" type="text" name="formSubject" id="subject" placeholder="Subject">
						<textarea class="footer-form__input" name="formMessage" cols="30" rows="5" placeholder="Message" id="message" required></textarea>
						<button class="footer-form__submit" type="button" value="Send" id="contact_submit">Send</button>
					{{--</form>--}}
				</div>
			</div>
		</div>
	</div>
	<!-- footer bottom -->
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<ul class="footer-copy col-xs-12 col-sm-7 col-md-8">
					<li>&copy; {{setting('year')}} &amp; Copyright by <a href="{{setting('website')}}" title="author" class="likeapro">{{setting('company_name')}}</a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<!-- end footer section -->
<script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/js/sweetalert2.js')}}"></script>
<script>
    $(document).ready(function () {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		onOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	});
        $("#contact_submit").on("click", function () {
            var name = $("#name").val();
            var email = $("#email").val();
            var number = $("#number").val();
            var subject = $("#subject").val();
            var message = $("#message").val();
			// alert(name);
            $.ajax({
                url: "{{route('saveContact')}}",
                dataType:"JSON",
                method:"POST",
                data:{
                    name:name,
                    email:email,
                    number:number,
                    subject:subject,
                    message:message,
                },
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
                success:function (data) {
                	if (data.success == true){
						Swal.fire({
							title: 'Contact Submitted, An Admin Will notify You',
							icon: 'success',
							confirmButtonText: 'ok',
							confirmButtonColor: '#3085d6',
						});
						$("#name").val('');
						$("#email").val('');
						$("#subject").val('');
						$("#message").val('');
					}
                },
				error:function () {
					Swal.fire({
						title: 'Something Went Wrong, Try Again!',
						icon: 'error',
						confirmButtonText: 'ok',
						confirmButtonColor: '#3085d6',
					});
				}
            });
        });
    });
</script>