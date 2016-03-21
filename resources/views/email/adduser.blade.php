<body>
<h2>Chào {!! $first_name !!},</h2>
<p>
    Email này được gửi tự động vì chúng tôi đã tạo cho bạn một tài khoảng trong {!! trans('email.name') !!}
    <br/>
    Hãy vào link sau
</p>
<blockquote>
    <a href="{!! route('index') !!}" target="_blank">
        {!! route('index') !!}
    </a>
</blockquote>
<p>
    và đăng nhập với tài khoản:
    <br>
    Email: <em>{!! $email !!}</em>
    <br>
    Mật khẩu: <em>{!! $password !!}</em>
</p>
<p>
    Cảm ơn {!! $first_name !!} đã tham gia.
</p>
</body>