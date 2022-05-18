<header class="mb-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        {{-- トップページ --}}
        <a class="navbar-brand bold" href="/">Reading record</a>
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    {{-- 読書記録登録ページへのリンク --}}
                    <li class="nav-link">{!! link_to_route('reading_records.get', 'Register Record') !!}</li>
                    {{-- 一覧表示へのリンク --}}
                    <li class="nav-item"><a href="/" class="nav-link">List</a></li>
                    {{-- ログアウトページへのリンク --}}
                    <li class="nav-link">{!! link_to_route('logout.get', 'Logout') !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>