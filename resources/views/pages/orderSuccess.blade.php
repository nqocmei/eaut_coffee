@extends('layouts.site_layout')
@section('content')
    <style>
        .checkout-card {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }

        .checkmark {
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }
    </style>

    <div class="body mt-5">
        <div class="checkout-card">
            <div class="card_order">
                <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                    <i class="checkmark text-center text-success">✓</i>
                </div>
                <h1 class="text-center text-success">Đặt hàng thành công</h1>
                <p class="text-center text-success">Chúng tôi đang trên đường giao đến bạn<br />hãy để ý đơn hàng!</p>
                <p id="redirectMessage" class="text-center text-success mt-3">Bạn sẽ được chuyển hướng sau <span
                        id="countdown">5</span> giây.</p>
            </div>
        </div>
    </div>

    <script>
        var countdownNumber = 5;
        var countdownElement = document.getElementById('countdown');

        var countdownInterval = setInterval(function() {
            countdownNumber--;
            countdownElement.textContent = countdownNumber;
            if (countdownNumber <= 0) {
                clearInterval(countdownInterval);
                window.location.href = '/';
            }
        }, 1000);
    </script>
@endsection
