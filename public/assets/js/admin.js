// SIDEBAR
document.addEventListener('DOMContentLoaded', function() {
    var sidebarToggle = document.getElementById('sidebarToggle');
    var wrapper = document.getElementById('wrapper');

    if (sidebarToggle && wrapper) {
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            wrapper.classList.toggle('toggled');

            if (wrapper.classList.contains('toggled')) {
                localStorage.setItem('sidebarToggled', 'true');
            } else {
                localStorage.removeItem('sidebarToggled');
            }
        });

        if (localStorage.getItem('sidebarToggled') === 'true') {
            wrapper.classList.add('toggled');
        }
    }
});

// add contoh program
document.addEventListener("DOMContentLoaded", function () {

    // Fungsi umum untuk menambah input dinamis
    function setupDynamicInput(addBtnSelector, containerSelector, placeholderText, extraField = false) {
        const addButtons = document.querySelectorAll(addBtnSelector);

        addButtons.forEach(button => {
            button.addEventListener("click", function () {
                const modal = button.closest(".modal") || document;
                const container = modal.querySelector(containerSelector);
                if (!container) return;

                // Elemen input baru
                const newItem = document.createElement("div");
                newItem.classList.add("input-group", "mb-2", "program-item");

                // Template dinamis
                newItem.innerHTML = `
                    <input type="text" class="form-control rounded-3" placeholder="${placeholderText}">
                    ${
                        extraField
                            ? `<input type="text" class="form-control rounded-3 ms-2" placeholder="Masukkan Posisi...">`
                            : ``
                    }
                    <button type="button" class="btn btn-outline-secondary rounded-3 ms-2 remove-program-btn">
                        <i class="bi bi-x"></i>
                    </button>
                `;

                container.appendChild(newItem);

                // Event hapus
                const removeBtn = newItem.querySelector(".remove-program-btn");
                removeBtn.addEventListener("click", () => newItem.remove());
            });
        });
    }

    // Inisialisasi modul "Tambah Program"
    setupDynamicInput(
        ".add-program-btn",
        ".program-container",
        "Masukkan Contoh Program Kategori Program..."
    );

    // Inisialisasi modul "Tambah Tenaga Kerja" + field posisi
    setupDynamicInput(
        ".add-tenaga-btn",
        ".tenaga-container",
        "Masukkan Nama...",
        true // parameter tambahan untuk menyalakan field posisi
    );

    // Tambahkan event listener ke semua tombol remove bawaan
    document.querySelectorAll(".remove-program-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const item = btn.closest(".program-item");
            if (item) item.remove();
        });
    });
});


// input gambar banner
document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("fileInput");
    const fileName = document.getElementById("fileName");
    const fileText = document.getElementById("fileText");

    fileInput.addEventListener("change", function () {
        if (fileInput.files.length > 0) {
            const name = fileInput.files[0].name;
            fileName.textContent = name;
            fileText.textContent = "File dipilih:";
        } else {
            fileName.textContent = "";
            fileText.textContent = "Tambahkan atau seret dan lepas gambar";
        }
    });
});

// detail banner
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-see").forEach(button => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");

            fetch(`/news/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("detailImage").src = data.gambar ?? "/assets/images/no-image.png";
                    document.getElementById("detailImageName").textContent = data.gambar ? data.gambar.split('/').pop() : "No image";
                    document.getElementById("detailJudul").value = data.judul;
                    document.getElementById("detailCreatedAt").value = data.created_at;
                    document.getElementById("detailUpdatedAt").value = data.updated_at;

                    const modal = new bootstrap.Modal(document.getElementById("detailModal"));
                    modal.show();
                });
        });
    });
});

// edit banner
document.addEventListener("DOMContentLoaded", function () {
    const editFileInput = document.getElementById("editFileInput");
    const editFileName = document.getElementById("editFileName");
    const editFileText = document.getElementById("editFileText");

    if (editFileInput) {
        editFileInput.addEventListener("change", function () {
            if (editFileInput.files.length > 0) {
                const name = editFileInput.files[0].name;
                editFileName.textContent = name;
                editFileText.textContent = "File dipilih:";
            } else {
                editFileName.textContent = "";
                editFileText.textContent = "Tambahkan atau seret dan lepas gambar";
            }
        });
    }

    document.querySelectorAll(".btn-edit-banner").forEach(button => {
        button.addEventListener("click", function () {
            const modal = new bootstrap.Modal(document.getElementById("editModal"));
            modal.show();

            const id = this.dataset.id;
            const judul = this.dataset.judul;
            const gambar = this.dataset.gambar;

            document.getElementById("editJudul").value = judul;

            if (gambar) {
                editFileName.textContent = gambar.split('/').pop();
                editFileText.textContent = "File saat ini:";
            } else {
                editFileName.textContent = "";
                editFileText.textContent = "Tidak ada file";
            }

            const form = document.getElementById("editBannerForm");
            form.action = `/news/${id}`;
        });
    });

    // === edit pedoman ===
    document.querySelectorAll(".btn-edit-pedoman").forEach(button => {
        button.addEventListener("click", function () {
            const modal = new bootstrap.Modal(document.getElementById("editModal"));
            modal.show();

            const editLinkyt = document.getElementById("editLinkyt");
            const kategoriSelect = document.querySelector("#editModal select");

            if (editLinkyt) editLinkyt.value = "https://www.youtube.com/watch?v=contoh";
            if (kategoriSelect) kategoriSelect.value = "spesifikasi-teknis";
        });
    });
});

//delete banner
document.addEventListener("DOMContentLoaded", function () {

    let deleteId = null;

    document.querySelectorAll(".btn-delete").forEach((button, index) => {
        button.addEventListener("click", function () {
            deleteId = index + 1;
            const modal = new bootstrap.Modal(document.getElementById("confirmDeleteModal"));
            modal.show();
        });
    });

    document.getElementById("confirmDeleteBtn").addEventListener("click", function () {

        console.log("Data dengan ID", deleteId, "dihapus");

        const modal = bootstrap.Modal.getInstance(document.getElementById("confirmDeleteModal"));
        modal.hide();
    });
});


// data program
document.addEventListener("DOMContentLoaded", function () {
    const waktuMulai = document.getElementById("waktuMulai");
    const waktuSelesai = document.getElementById("waktuSelesai");
    const tahunAnggaran = document.getElementById("tahunAnggaran");

    // --- Validasi range tanggal (otomatis menyesuaikan) ---
    waktuMulai.addEventListener("change", () => {
        if (waktuSelesai.value && waktuMulai.value > waktuSelesai.value) {
            waktuSelesai.value = ""; // reset jika user pilih mundur
        }
        waktuSelesai.min = waktuMulai.value; // tanggal selesai tidak bisa sebelum mulai
    });

    waktuSelesai.addEventListener("change", () => {
        if (waktuMulai.value && waktuSelesai.value < waktuMulai.value) {
            waktuMulai.value = ""; // reset jika salah pilih
        }
        waktuMulai.max = waktuSelesai.value; // tanggal mulai tidak bisa setelah selesai
    });

    // --- Validasi agar input tahun hanya angka ---
    tahunAnggaran.addEventListener("input", () => {
        tahunAnggaran.value = tahunAnggaran.value.replace(/\D/g, "").slice(0, 4);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll("tbody tr"); // semua baris tabel
    const paginationContainer = document.querySelector(".pagination");
    const infoText = document.querySelector(".info-pages"); // teks "Menampilkan ... dari ... entri"
    const selectDisplay = document.querySelector(".display-data select"); // dropdown jumlah entri
    let rowsPerPage = parseInt(selectDisplay.value); // ambil nilai awal dari select (default 10)
    let currentPage = 1;

    // Fungsi menampilkan baris sesuai halaman aktif
    function displayRows() {
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        rows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? "" : "none";
        });
        updateInfoText();
    }

    // Fungsi update teks info
    function updateInfoText() {
        const total = rows.length;
        const end = Math.min(currentPage * rowsPerPage, total);
        infoText.textContent = `Menampilkan ${end} dari ${total} entri`;
    }

    // Fungsi buat pagination dinamis
    function setupPagination() {
        paginationContainer.innerHTML = "";
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        const prevItem = document.createElement("li");
        prevItem.className = "page-item";
        prevItem.innerHTML = `<a class="page-link border-0 text-secondary fs-5" href="#"><i class="bi bi-chevron-left"></i></a>`;
        prevItem.addEventListener("click", (e) => {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                displayRows();
                setupPagination();
            }
        });
        paginationContainer.appendChild(prevItem);

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement("li");
            li.className = `page-item ${i === currentPage ? "active" : ""}`;
            li.innerHTML = `<a class="page-link border-0 ${i === currentPage ? "bg-transparent text-dark fw-semibold" : "text-secondary"} fs-6" href="#">${i}</a>`;
            li.addEventListener("click", (e) => {
                e.preventDefault();
                currentPage = i;
                displayRows();
                setupPagination();
            });
            paginationContainer.appendChild(li);
        }

        const nextItem = document.createElement("li");
        nextItem.className = "page-item";
        nextItem.innerHTML = `<a class="page-link border-0 text-secondary fs-5" href="#"><i class="bi bi-chevron-right"></i></a>`;
        nextItem.addEventListener("click", (e) => {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                displayRows();
                setupPagination();
            }
        });
        paginationContainer.appendChild(nextItem);
    }

    // Saat dropdown jumlah entri berubah
    selectDisplay.addEventListener("change", function () {
        rowsPerPage = parseInt(this.value);
        currentPage = 1; // reset ke halaman pertama
        displayRows();
        setupPagination();
    });

    // Jalankan saat pertama kali halaman dimuat
    if (rows.length > 0) {
        displayRows();
        setupPagination();
    }
});


// Hide and see password login
document.addEventListener("DOMContentLoaded", function () {

    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password-input");

    if (togglePassword) {
        togglePassword.addEventListener("click", function () {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);

            this.classList.toggle("bi-eye");
            this.classList.toggle("bi-eye-slash");
        });
    }

});



