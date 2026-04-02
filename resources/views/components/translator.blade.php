<!-- Language Dropdown -->
<div class="dropdown mx-2">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        🌐
        @if(app()->getLocale() == 'en') 🇬🇧 English
        @elseif(app()->getLocale() == 'ps') 🇦🇫 پښتو
        @else 🇦🇫 دری
        @endif
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item @if(app()->getLocale()=='en') active @endif"
                href="{{ route('lang.switch','en') }}">🇬🇧 English</a></li>
        <li><a class="dropdown-item @if(app()->getLocale()=='ps') active @endif"
                href="{{ route('lang.switch','ps') }}">🇦🇫 پښتو</a></li>
        <li><a class="dropdown-item @if(app()->getLocale()=='fa') active @endif"
                href="{{ route('lang.switch','fa') }}">🇦🇫 دری</a></li>
    </ul>
</div>