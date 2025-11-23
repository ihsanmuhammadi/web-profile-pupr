<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        .toast-notif {
    display: flex;
    align-items: center;
    justify-content: space-between;
   gap: 20px;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    border-left-width: 6px;
    border-left-style: solid;
    min-width: 420px;
}

/* SUCCESS STYLE (mirip toast-sukses.png) */
.toast-success {
    background-color: #e7f4ec;
    border-left-color: #4CAF50;
    color: #2c5e37;
}

/* ERROR STYLE (mirip toast-gagal.png) */
.toast-error {
    background-color: #f9e8e7;
    border-left-color: #d9534f;
    color: #8a2e2c;
}

/* ICON BULAT */
.toast-icon {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

/* Hijau */
.toast-icon-success {
    background-color: #4CAF50;
    color: white;
}

/* Merah */
.toast-icon-error {
    background-color: #d9534f;
    color: white;
}

/* TEXT AREA */
.toast-body {
    display: flex;
    flex-direction: column;
}

.toast-title {
    font-weight: 600;
    font-size: 1rem;
}

.toast-message {
    font-size: 0.95rem;
    margin-top: -2px;
}

/* CLOSE BUTTON */
.toast-close {
    cursor: pointer;
    font-size: 20px;
    color: inherit;
    opacity: 0.7;
}

.toast-close:hover {
    opacity: 1;
}
    </style>
</head>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.getElementById("wrapper");
    const toggleBtn = document.getElementById("toggleSidebar");

    // === Restore state on page load ===
    const savedState = localStorage.getItem("sidebar-collapsed");
    if (savedState === "true") {
        wrapper.classList.add("toggled");
    }

    // === Toggle state on click ===
    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            wrapper.classList.toggle("toggled");

            // Simpan state ke localStorage
            const isCollapsed = wrapper.classList.contains("toggled");
            localStorage.setItem("sidebar-collapsed", isCollapsed);
        });
    }
});
</script>

<body>
    <div id="wrapper" class="d-flex">
        {{-- Sidebar --}}
        @include('components.sidebar_admin')

        {{-- Konten utama --}}
        <div id="content-wrapper" class="">
            <main class="p-5">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/admin.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000 });
    </script>

    <!-- Toast Container -->
<div id="toastContainer"
    style="position: fixed; top: 20px; right: 20px; z-index: 99999; display: flex; flex-direction: column; gap: 10px;">
</div>

<script>
    function showToast(message, type = "success") {
        const toast = document.createElement("div");
        toast.className = "toast-notif " + (type === "success" ? "toast-success" : "toast-error");
        toast.style.backgroundColor = type === "success" ? "#28a745" : "#dc3545";
        toast.style.minWidth = "280px";
        toast.style.opacity = "0";
        toast.style.transform = "translateX(100%)";
        toast.style.transition = "all .4s ease";

        toast.innerHTML = `
    <div class="d-flex align-items-center">
        <div class="toast-icon ${type === "success" ? "toast-icon-success" : "toast-icon-error"}">
            <i class="bi ${type === "success" ? "bi-check-lg" : "bi-x-lg"}"></i>
        </div>

        <div class="toast-body">
            <span class="toast-title">${type === "success" ? "Sukses!" : "Gagal!"}</span>
            <span class="toast-message">${message}</span>
        </div>
    </div>

    <i class="bi bi-x-lg toast-close"></i>
`;

        document.getElementById("toastContainer").appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = "1";
            toast.style.transform = "translateX(0)";
        }, 50);

        setTimeout(() => {
            toast.style.opacity = "0";
            toast.style.transform = "translateX(100%)";
        }, 3000);

        setTimeout(() => toast.remove(), 3500);
    }

    @if(session('success'))
        showToast("{{ session('success') }}", "success");
    @endif

    @if(session('error'))
        showToast("{{ session('error') }}", "error");
    @endif
</script>
</body>
</html>
