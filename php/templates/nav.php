<nav class="navigation navigation--top">
    <div class="navigation__row">
        <a class="noUnderline" href="./index.php">
            <figure class="navigation__logo">
                <img src="./imgs/logo.png" alt="logo">
            </figure>
        </a>
        <a href="javascript:void(0)" class="hamburger hamburger-btn hamburger-zone noUnderline">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
    <ul class="hamburger-zone">
        <li><a href="./gallery.php?search=FOTOGALERIE/">GALERIE</a></li>
        <li><a href="./kontakt.php">KONTAKT</a></li>
        <li><a href="./preisliste.php">preisliste</a></li>
    </ul>
</nav>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let hamelmnts = document.querySelectorAll(".hamburger-zone");
        for (const btn of document.querySelectorAll(".hamburger-btn")) {
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                for (const element of hamelmnts) {
                    element.classList.toggle("active");
                }
            });
        }
    });
    document.addEventListener("scroll", () => {
        let navigation = document.getElementsByClassName("navigation")[0]
        if (window.pageYOffset > 50) {
            navigation.classList.remove("navigation--top")
            return
        }
        navigation.classList.add("navigation--top")
    })
</script>