<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center mb-4">OTP Verification</h3>
                        <form method="POST" action="{{ route('verify.otp', ['email' => $email]) }}">
                            @csrf

                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="mb-4">
                                <label class="form-label">Enter OTP</label>
                                <div class="d-flex justify-content-between gap-2">
                                    <input type="text" class="form-control text-center" maxlength="1" name="otp[]" required>
                                    <input type="text" class="form-control text-center" maxlength="1" name="otp[]" required>
                                    <input type="text" class="form-control text-center" maxlength="1" name="otp[]" required>
                                    <input type="text" class="form-control text-center" maxlength="1" name="otp[]" required>
                                    <input type="text" class="form-control text-center" maxlength="1" name="otp[]" required>
                                    <input type="text" class="form-control text-center" maxlength="1" name="otp[]" required>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Verify OTP</button>
                            </div>

                            <div class="text-center mt-3">
                                <p class="mb-0">Didn't receive the code?</p>
                                <a href="{{ route('resend.otp') }}" class="text-decoration-none">Resend OTP</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[name="otp[]"]');

            inputs.forEach((input, index) => {
                input.addEventListener('input', function() {
                    if (this.value.length === 1) {
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    }
                });

                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && !this.value) {
                        if (index > 0) {
                            inputs[index - 1].focus();
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>