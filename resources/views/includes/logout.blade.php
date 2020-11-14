<!--Start Logout System-->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<script>
    function logout(){
        Swal.fire({
            title: '{{ __('auth.logout_confirmation') }}',
            text: "{{ __('auth.logout_text') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ __('auth.logout_confirm_btn') }}'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '{{ __('auth.logout_success_alert') }}',
                    '{{ __('auth.logout_success_test') }}',
                    'success'
                )
                setTimeout(function() {
                    //your code to be executed after 1 second
                    document.getElementById('logout-form').submit();
                }, 1000);//2 second
            }
        })
    }
</script>
<!--End Logout System-->
