function togglePasswordVisibility() {
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.querySelector('eyeIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.src = "{{ asset('images/login/ojosi.png') }}";
    } else {
        passwordInput.type = 'password';
        eyeIcon.src = "{{ asset('images/login/ojono.png') }}";
    }
}