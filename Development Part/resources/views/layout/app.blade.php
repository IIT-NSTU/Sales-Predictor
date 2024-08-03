<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sales Predictor</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" />

    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/form-validation.js') }}"></script>
    <script src="{{ asset('js/toastify-js.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
</head>

<body>

    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <nav class="navbar fixed-top px-0 shadow-sm bg-white">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">
                <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                    <img class="nav-logo-sm mx-2" src="{{ asset('images/menu.svg') }}" alt="logo" />
                </span>
                <img class="nav-logo  mx-2" src="{{ asset('images/logo3.png') }}" alt="logo" />
            </a>

            <div class="float-right h-auto d-flex">
                <div class="user-dropdown">
                    <img class="icon-nav-img" src="{{ asset('images/user.webp') }}" alt="" />
                    <div class="user-dropdown-content ">
                        <div class="mt-4 text-center">
                            <img class="icon-nav-img" src="{{ asset('images/user.webp') }}" alt="" />
                            <h6 id="username"></h6>
                            <hr class="user-dropdown-divider  p-0" />
                        </div>
                        <a href="{{ url('/user-profile') }}" class="side-bar-item">
                            <span class="side-bar-item-caption">Profile</span>
                        </a>
                        <a href="{{url('/user-logout')}}" class="side-bar-item">
                            <span class="side-bar-item-caption">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div id="sideNavRef" class="side-nav-open">
        <a href="{{ url('/') }}" class="side-bar-item">
            <img src="{{ asset('icons/dashboard.ico') }}" alt="Dashboard Icon" class="icon-style">
            <span class="side-bar-item-caption text-lg">Dashboard</span>
        </a>

        <a href="{{ url('/contacts') }}" class="side-bar-item">
            <img src="{{ asset('icons/customer.ico') }}" alt="Customer Icon" class="icon-style">
            <span class="side-bar-item-caption text-lg">Contacts</span>
        </a>

        <a href="{{ url('/categories') }}" class="side-bar-item">
            <img src="{{ asset('icons/category.ico') }}" alt="Category Icon" class="icon-style">
            <span class="side-bar-item-caption text-lg">Categories</span>
        </a>

        <a href="{{ url('/products') }}" class="side-bar-item">
            <img src="{{ asset('icons/product.png') }}" alt="Product Icon" class="icon-style">
            <span class="side-bar-item-caption text-lg">Products</span>
        </a>

        <div class="dropdown">
            <a class="side-bar-item"" type="button" id="invoiceDropDown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('icons/invoice.png') }}" alt="Invoice Icon" class="icon-style">
                <span class="side-bar-item-caption text-lg">Invoice</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-dark" aria-labelledby="invoiceDropDown">
                <li>
                    <a href="{{ url('/create-invoice') }}" class="side-bar-item">Create Invoice</a>
                </li>
                <li>
                    <a href="{{ url('/invoiceList') }}" class="side-bar-item">Invoice List</a>
                </li>
            </ul>
        </div>

        <a href="{{ url('/dues') }}" class="side-bar-item">
            <img src="{{ asset('icons/due.png') }}" alt="Dues Icon" class="icon-style">
            <span class="side-bar-item-caption text-lg">Dues</span>
        </a>

        <a href="{{ url('/expenses') }}" class="side-bar-item">
            <img src="{{ asset('icons/expenses.png') }}" alt="Expenses Icon" class="icon-style">
            <span class="side-bar-item-caption text-lg">Expenses</span>
        </a>

        <a href="{{url('sales-report')}}" class="side-bar-item">
            <img src="{{ asset('icons/report.png') }}" alt="Report Icon" class="icon-style">
            <span class="side-bar-item-caption text-lg">Report</span>
        </a>
    </div>


    <div id="contentRef" class="content">
        @yield('content')
    </div>


    <script>
        function MenuBarClickHandler() {
            let sideNav = document.getElementById('sideNavRef');
            let content = document.getElementById('contentRef');
            if (sideNav.classList.contains("side-nav-open")) {
                sideNav.classList.add("side-nav-close");
                sideNav.classList.remove("side-nav-open");
                content.classList.add("content-expand");
                content.classList.remove("content");
            } else {
                sideNav.classList.remove("side-nav-close");
                sideNav.classList.add("side-nav-open");
                content.classList.remove("content-expand");
                content.classList.add("content");
            }
        }
        const username = document.getElementById('username');
        const showUserName = async () => {
            const res = await axios.get('/user-profile-details');
            const user = res['data']['data'];
            username.innerText = user['first_name'] + " " + user['last_name'] ;
        }
        showUserName();
    </script>
</body>

</html>
