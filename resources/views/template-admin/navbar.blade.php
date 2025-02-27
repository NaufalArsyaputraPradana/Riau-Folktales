<ul class="metismenu" id="menu">
    <li class="menu-label">DASHBOARD</li>
    <li>
        <a href="/">
            <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
            <div class="menu-title">DASHBOARD</div>
        </a>
    </li>
    <li class="menu-label">MANAGE CERITA</li>
    <li>
        <a href="{{ route('cerita.index') }}">
            <div class="parent-icon"><i class='bx bx-book'></i></div>
            <div class="menu-title">MANAGE CERITA</div>
        </a>
    </li>
    <li class="menu-label">MANAGE READING</li>
    <li>
        <a href="{{ route('reading.index') }}">
            <div class="parent-icon"><i class='bx bx-book-alt'></i></div>
            <div class="menu-title">MANAGE READING</div>
        </a>
    </li>
    <li class="menu-label">MANAGE QUIZ</li>
    <li>
        <a href="{{ route('quis.index') }}">
            <div class="parent-icon"><i class='bx bx-file'></i></div>
            <div class="menu-title">MANAGE QUIZ</div>
        </a>
    </li>
    <li class="menu-label">MANAGE LISTENING</li>
    <li>
        <a href="{{ route('listening.index') }}">
            <div class="parent-icon"><i class='bx bx-headphone'></i></div>
            <div class="menu-title">MANAGE LISTENING</div>
        </a>
    </li>
</ul>
