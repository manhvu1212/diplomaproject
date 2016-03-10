<body>
<h2>Chào {!! $first_name !!},</h2>
<p>
    Email này được gửi tự động vì bạn đã đăng ký từ {!! trans('email.name') !!}
    <br/>
    Hãy vào đường dẫn bên dưới để kích hoạt tài khoản của bạn.
</p>
<blockquote>
    <a href="{!! route('activation', ['user_id' => $user_id, 'code' => $code]) !!}" target="_blank">
        {!! route('activation', ['user_id' => $user_id, 'code' => $code]) !!}
    </a>
</blockquote>
<p>
    Cảm ơn {!! $first_name !!} đã đăng ký.
</p>
</body>