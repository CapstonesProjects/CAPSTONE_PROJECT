<style>

*{
    text-decoration: none;
    list-style: none;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
}

.logo-text-container {
    display: flex;
    align-items: center;
}

.logo-img-container img {
    max-width: 100px;
    height: auto;
}

.logo-letter-container {
    margin-left: 15px;
}

.logo-letter {
    color: #ffffff;
    font-size: 18px;
}

.IPI-container {
    display: flex;
    margin-top: 5px;
}

.IPI-letter {
    font-size: 12px;
    color: #cccccc;
    margin-right: 10px;
}

.navlist {
    display: flex;
    gap: 10px;
}

.navlist li a {
    color: white;
    font-size: 20px;
    padding: 5px 15px;
    text-align: center;
}


.hamburger {
    display: none;
    flex-direction: column;
    cursor: pointer;
}

.hamburger span {
    height: 3px;
    width: 25px;
    background-color: white;
    margin: 4px 0;
    transition: 0.4s;
}

/* Hide menu on small screens initially */
.navlist {
    flex-direction: row;
}

.navlist.responsive {
    flex-direction: row;
    width: 100%;
    display: flex;
    position: absolute;
    top: 70px;
    left: 0;
    background-color: rgba(0, 0, 0, 0.9);
    font-size: 8px;
}

.navlist.responsive li {
    text-align: center;
    width: 100%;
}

.navlist.responsive li a {
    display: flex;
    padding: 10px;
    font-size: 8px;
}

.navlist.show {
    display: flex;
}


@media (max-width: 768px) {
    .navlist {
        display: none;
    }

    .hamburger {
        display: flex;
    }

    .logo-letter {
        font-size: 16px;
    }

    .IPI-container {
        flex-direction: row;
    }

    .IPI-letter {
        margin-right: 0;
    }
}

</style>

<header>
    <div class="logo-text-container">
        <div class="logo-img-container">
            <a href="#" class="logo"><img src="images/osa_logo.png" alt=""></a>
        </div>
        <div class="logo-letter-container">
            <h1 class="LL1 logo-letter">LOA</h1>
            <p class="LL2 logo-letter">Office of Student Affairs</p>
            <div class="IPI-container">
                <p class="IPI-letter">Integrity</p>
                <p class="IPI-letter">Professionalism</p>
                <p class="IPI-letter">Innovation</p>
            </div>
        </div>
    </div>

    <ul class="navlist">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./Abouts.php">AboutUs</a></li>
        <li><a href="./Events.php">Events</a></li>
        <li><a href="./Scholar.php">Scholar</a></li>
        <li class="relative">
            <button id="loginDropdownLink" data-dropdown-toggle="loginDropdown" class="flex items-center text-xl justify-between w-full py-2 px-3 text-white rounded">
                Login
                <svg class="w-2.5 h-2.5 ms-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="loginDropdown" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class="py-2 text-sm text-gray-700">
                    <li><a href="./Student_Index.php" class="block px-4 py-2" style="color: black;">Student</a></li>
                    <li><a href="./OSA_Index.php" class="block px-4 py-2" style="color: black;">OSA Staff</a></li>
                </ul>
            </div>
        </li>
    </ul>

    <div class="hamburger" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>

<script>
    function toggleMenu() {
        const navList = document.querySelector('.navlist');
        navList.classList.toggle('show');
    }
</script>
