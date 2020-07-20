<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">JS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item <?= $title == 'Home | JS' ? 'active' : '' ?>">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?= $title == 'About Me' ? 'active' : '' ?>">
                    <a class="nav-link" href="/Pages/about">About</a>
                </li>
                <li class="nav-item <?= $title == 'Contacts List' ? 'active' : '' ?>">
                    <a class="nav-link" href="/Contacts">Contacts</a>
                </li>
                <li class="nav-item <?= $title == 'Comics List' ? 'active' : '' ?>">
                    <a class="nav-link" href="/Comics">Comics</a>
                </li>

            </ul>
        </div>
    </div>
</nav>