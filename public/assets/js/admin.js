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
// logout
document.addEventListener('DOMContentLoaded', function () {
    const sidebarFooter = document.getElementById('sidebarFooter');
    const logoutDropdown = document.getElementById('logoutDropdown');
    const logoutBtn = document.getElementById('logoutBtn');

    sidebarFooter.addEventListener('click', function (event) {
        event.stopPropagation();
        logoutDropdown.style.display =
            logoutDropdown.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function () {
        logoutDropdown.style.display = 'none';
    });

    logoutBtn.addEventListener('click', function () {
        const modal = new bootstrap.Modal(document.getElementById('logoutModal'));
        modal.show();
    });
});

//enter for search
document.getElementById("searchInput").addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
        e.preventDefault();
        document.getElementById("searchBtn").click();
    }
});

// add inputan contoh program
document.addEventListener("DOMContentLoaded", function () {

    const MAX_PROGRAM = 3;

    function updateLimit(modal) {
        const container = modal.querySelector(".program-container");
        const addBtn = modal.querySelector(".add-program-btn");
        const items = container.querySelectorAll(".program-item");

        // matikan tombol jika sudah 3 input
        addBtn.disabled = items.length >= MAX_PROGRAM;

        // atur tombol remove (baris pertama tidak bisa dihapus)
        items.forEach((item, index) => {
            const btn = item.querySelector(".remove-program-btn");
            if (index === 0) btn.classList.add("d-none");
            else btn.classList.remove("d-none");

            // mapping name sesuai urutan input
            const input = item.querySelector("input");
            if (input) input.name = "contoh_program_" + (index + 1);
        });
    }
    // Tambah program
    document.addEventListener("click", function (e) {
        if (e.target.closest(".add-program-btn")) {
            const modal = e.target.closest(".modal");
            const container = modal.querySelector(".program-container");

            const newItem = document.createElement("div");
            newItem.classList.add("input-group", "mb-2", "program-item");

            newItem.innerHTML = `
                <input type="text" class="form-control rounded-3" placeholder="Masukkan Contoh Program Kategori Program...">
                <button type="button" class="btn btn-outline-secondary rounded-3 ms-2 remove-program-btn">
                    <i class="bi bi-x"></i>
                </button>
            `;

            container.appendChild(newItem);
            updateLimit(modal);
        }
    });
    // Remove program
    document.addEventListener("click", function (e) {
        if (e.target.closest(".remove-program-btn")) {
            const modal = e.target.closest(".modal");
            const item = e.target.closest(".program-item");
            item.remove();
            updateLimit(modal);
        }
    });
    // Saat modal dibuka, reset status
    document.querySelectorAll(".modal").forEach(modal => {
        modal.addEventListener("shown.bs.modal", function () {
            updateLimit(modal);
        });
    });

});

// add inputan tenaga kerja
document.addEventListener("DOMContentLoaded", function () {

    function updateAddButtonStatus(container, button) {
        const total = container.querySelectorAll(".program-item").length;
        if (total >= 5) {
            button.setAttribute("disabled", "true");
            button.classList.add("disabled");
        } else {
            button.removeAttribute("disabled");
            button.classList.remove("disabled");
        }
    }

    function setupTambahTenagaKerja() {
        const addButtons = document.querySelectorAll(".add-tenaga-btn");

        addButtons.forEach(button => {
            const modal = button.closest(".modal");
            const container = modal.querySelector(".tenaga-container");

            updateAddButtonStatus(container, button);

            button.addEventListener("click", function () {

                // Cek total item saat ini
                let total = container.querySelectorAll(".program-item").length;
                if (total >= 5) {
                    return;
                }

                let index = total + 1;

                const newItem = document.createElement("div");
                newItem.classList.add("input-group", "mb-2", "program-item");

                newItem.innerHTML = `
                    <input type="text" name="tenaga_kerja_${index}" class="form-control rounded-3" placeholder="Masukkan Nama...">
                    <input type="text" name="posisi_${index}" class="form-control rounded-3 ms-2" placeholder="Masukkan Posisi...">
                    <button type="button" class="btn btn-outline-secondary rounded-3 ms-2 remove-program-btn">
                        <i class="bi bi-x"></i>
                    </button>
                `;

                container.appendChild(newItem);
                updateAddButtonStatus(container, button);
                newItem.querySelector(".remove-program-btn")
                    .addEventListener("click", function () {
                        newItem.remove();
                        updateAddButtonStatus(container, button);
                    });
            });
        });
    }

    setupTambahTenagaKerja();
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
    document.querySelectorAll(".btn-see-news").forEach(button => {
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
// detail guidance
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-see-guidance").forEach(button => {
        button.addEventListener("click", function () {

            const id = this.getAttribute("data-id");

            fetch(`/guidances/${id}`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById("detailLink").value = data.link;
                    document.getElementById("detailKategori").value = data.kategori;
                    document.getElementById("detailCreatedAt").value = data.created_at;
                    document.getElementById("detailUpdatedAt").value = data.updated_at;

                    const modal = new bootstrap.Modal(document.getElementById("detailModal"));
                    modal.show();
                });
        });
    });
});
// detail category
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-see-category").forEach(button => {
        button.addEventListener("click", function () {

            const id = this.getAttribute("data-id");

            fetch(`/categories/${id}`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById("detailName").value = data.name;
                    document.getElementById("detailDescription").value = data.description;
                    document.getElementById("detailTujuan").value = data.tujuan;
                    document.getElementById("contohProgram").value =
                    `${data.contoh_program_1 ?? ""}\n${data.contoh_program_2 ?? ""}\n${data.contoh_program_3 ?? ""}`;

                    const modal = new bootstrap.Modal(document.getElementById("detailModal"));
                    modal.show();
                });
        });
    });
});
// detail data program
document.addEventListener("DOMContentLoaded", function () {

    function formatTanggal(tanggal) {
        if (!tanggal) return "-";
        const date = new Date(tanggal);
        const options = { day: "2-digit", month: "long", year: "numeric" };
        return date.toLocaleDateString("id-ID", options);
    }

    document.querySelectorAll(".btn-see-dataprogram").forEach(button => {

        function formatTanggal(tanggal) {
            if (!tanggal) return "-";
            const date = new Date(tanggal);
            const day = String(date.getDate()).padStart(2, "0");
            const month = String(date.getMonth() + 1).padStart(2, "0");
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }
        button.addEventListener("click", function () {

            const id = this.getAttribute("data-id");

            fetch(`/data-programs/${id}`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById("detailJudul").value = data.judul;
                    document.getElementById("detailKategori").value = data.kategori;
                    document.getElementById("detailSubJudul").value = data.sub_judul;
                    document.getElementById("detailDeskripsi").value = data.deskripsi;
                    document.getElementById("detailStatusProyek").value = data.status_proyek;
                    document.getElementById("detailWaktuMulai").value = formatTanggal(data.waktu_mulai);
                    document.getElementById("detailWaktuSelesai").value = formatTanggal(data.waktu_selesai);
                    document.getElementById("detailTahunAnggaran").value = data.tahun_anggaran;
                    document.getElementById("detailKecamatan").value = data.kecamatan;
                    document.getElementById("detailLokasi").value = data.lokasi;
                    document.getElementById("detailDokumentasi").value = data.dokumentasi;

                    for (let i = 1; i <= 5; i++) {
                        const tenaga = data[`tenaga_kerja_${i}`];
                        const posisi = data[`posisi_${i}`];

                        const tenagaInput = document.getElementById(`detailTenaga${i}`);
                        const posisiInput = document.getElementById(`detailPosisi${i}`);
                        const groupDiv = tenagaInput.closest(".input-group");

                        if (tenaga || posisi) {
                            groupDiv.style.display = "flex";

                            tenagaInput.value = tenaga ?? "-";
                            posisiInput.value = posisi ?? "-";
                        } else {
                            groupDiv.style.display = "none";
                        }
                    }

                    const modal = new bootstrap.Modal(document.getElementById("detailModal"));
                    modal.show();
                });
        });
    });
});
// detail works
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-see-works").forEach(button => {
        button.addEventListener("click", function () {

            const id = this.getAttribute("data-id");

            fetch(`/works/${id}`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById("detailPosisi").value = data.posisi;
                    document.getElementById("detailProyek").value = data.proyek;
                    document.getElementById("detailLevel").value = data.level;
                    document.getElementById("detailJenis").value = data.jenis;
                    document.getElementById("detailTipe").value = data.tipe;
                    document.getElementById("detailLokasi").value = data.lokasi;
                    const gajiFormatted = data.gaji
                        ? "Rp. " + data.gaji.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                        : "-";
                    document.getElementById("detailGaji").value = gajiFormatted;
                    document.getElementById("detailDeskripsi").value = data.deskripsi;
                    document.getElementById("detailKualifikasi").value = data.kualifikasi;

                    const modal = new bootstrap.Modal(document.getElementById("detailModal"));
                    modal.show();
                });
        });
    });
});
// detail applications
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-see-applications").forEach(button => {
        button.addEventListener("click", function () {

            const id = this.getAttribute("data-id");

            fetch(`/applications/${id}`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById("detailNama").value = data.nama;
                    document.getElementById("detailPosisi").value = data.posisi;
                    document.getElementById("detailProyek").value = data.proyek;
                    document.getElementById("detailEmail").value = data.email;
                    document.getElementById("detailNoTelepon").value = data.nomor_telepon;
                    document.getElementById("detailLokasi").value = data.lokasi;
                    document.getElementById("detailPendidikan").value = data.pendidikan;
                    document.getElementById("detailJurusan").value = data.jurusan;
                    document.getElementById("detailCV").textContent = data.cv;
                    document.getElementById("detailCV").href = "/storage/" + data.cv;
                    document.getElementById("detailPortofolio").value = data.portofolio;

                    const modal = new bootstrap.Modal(document.getElementById("detailModal"));
                    modal.show();
                });
        });
    });
});
// detail complaints
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-see-complaints").forEach(button => {
        button.addEventListener("click", function () {

            const id = this.getAttribute("data-id");

            fetch(`/complaints/${id}`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById("detailNama").value = data.nama;
                    document.getElementById("detailEmail").value = data.email;
                    document.getElementById("detailAduan").value = data.pesan;

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
    // edit banner
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
    //edit guidance
    document.querySelectorAll(".btn-edit-guidance").forEach(button => {
        button.addEventListener("click", function () {
            const modal = new bootstrap.Modal(document.getElementById("editModal"));
            modal.show();

            const id = this.dataset.id;
            const link = this.dataset.link;
            const kategori = this.dataset.kategori;

            // ISI VALUE
            document.getElementById("editLinkyt").value = link;
            document.getElementById("editKategori").value = kategori;

            // PASANG ACTION FORM
            const form = document.getElementById("editPedomanForm");
            form.action = `/guidances/${id}`;
        });
    });
    //edit category
    document.querySelectorAll(".btn-edit-category").forEach(button => {
        button.addEventListener("click", function () {
            const modalElement = document.getElementById("editKategoriModal");
            const modal = new bootstrap.Modal(modalElement);
            modal.show();

            const id = this.dataset.id;
            const name = this.dataset.name;
            const description = this.dataset.description;
            const tujuan = this.dataset.tujuan;

            const contoh1 = this.dataset.contoh1;
            const contoh2 = this.dataset.contoh2;
            const contoh3 = this.dataset.contoh3;

            document.getElementById("editName").value = name ?? "";
            document.getElementById("editDescription").value = description ?? "";
            document.getElementById("editTujuan").value = tujuan ?? "";

            // input contoh program dinamis
            const container = document.getElementById("editProgramContainer");
            container.innerHTML = "";

            let contohList = [contoh1, contoh2, contoh3].filter(v => v && v !== "null");

            if (contohList.length === 0) contohList = [""];

            contohList.forEach((value, index) => {
                const item = document.createElement("div");
                item.classList.add("input-group", "mb-2", "program-item");

                item.innerHTML = `
                    <input type="text" name="contoh_program_${index + 1}"
                        value="${value}" class="form-control rounded-3">
                    <button type="button"
                        class="btn btn-outline-secondary rounded-3 ms-2 remove-program-btn ${index === 0 ? 'd-none' : ''}">
                        <i class="bi bi-x"></i>
                    </button>
                `;

                container.appendChild(item);
            });

            const form = document.getElementById("editKategoriForm");
            form.action = `/categories/${id}`;
        });
    });
    //edit data program
    document.querySelectorAll(".btn-edit-dataprogram").forEach(button => {
        button.addEventListener("click", function () {

            const modalEl = document.getElementById("editModal");
            const modal = new bootstrap.Modal(modalEl);
            modal.show();

            const id = this.dataset.id;
            const judul = this.dataset.judul ?? "";
            const kategori = this.dataset.kategori_id ?? "";
            const subJudul = this.dataset.sub_judul ?? "";
            const deskripsi = this.dataset.deskripsi ?? "";
            const status = this.dataset.status_proyek ?? "";
            const waktuMulai = this.dataset.waktu_mulai ?? "";
            const waktuSelesai = this.dataset.waktu_selesai ?? "";
            const tahunAnggaran = this.dataset.tahun_anggaran ?? "";
            const kecamatan = this.dataset.kecamatan ?? "";
            const lokasi = this.dataset.lokasi ?? "";
            const dokumentasi = this.dataset.dokumentasi ?? "";

            document.getElementById("editJudul").value = this.dataset.judul ?? "";
            document.getElementById("editKategori").value = this.dataset.kategori ?? "";
            document.getElementById("editSubJudul").value = this.dataset.sub_judul ?? "";
            document.getElementById("editDeskripsi").value = this.dataset.deskripsi ?? "";
            document.getElementById("editStatus").value = this.dataset.status_proyek ?? "";
            document.getElementById("editWaktuMulai").value = this.dataset.waktu_mulai ?? "";
            document.getElementById("editWaktuSelesai").value = this.dataset.waktu_selesai ?? "";
            document.getElementById("editTahunAnggaran").value = this.dataset.tahun_anggaran ?? "";
            document.getElementById("editKecamatan").value = this.dataset.kecamatan ?? "";
            document.getElementById("editLokasi").value = this.dataset.lokasi ?? "";
            document.getElementById("editDokumentasi").value = this.dataset.dokumentasi ?? "";

            // === TENAGA KERJA DINAMIS ===
            const container = document.querySelector("#editModal .tenaga-container");
            container.innerHTML = "";

            const tenaga = [];
            const posisi = [];

            for (let i = 1; i <= 5; i++) {

                const nama = this.dataset[`tenaga_kerja_${i}`] ?? "";
                const posisi = this.dataset[`posisi_${i}`] ?? "";

                if (!nama && !posisi && i > 1) continue;

                const item = document.createElement("div");
                item.classList.add("input-group", "mb-2", "program-item");

                item.innerHTML = `
                    <input type="text" name="tenaga_kerja_${i}" class="form-control rounded-3"
                        placeholder="Masukkan Nama..." value="${nama}">

                    <input type="text" name="posisi_${i}" class="form-control rounded-3 ms-2"
                        placeholder="Masukkan Posisi..." value="${posisi}">

                    <button type="button" class="btn btn-outline-secondary rounded-3 ms-2 remove-program-btn ${i === 1 ? "d-none" : ""}">
                        <i class="bi bi-x"></i>
                    </button>
                `;

                item.querySelector(".remove-program-btn")?.addEventListener("click", () => item.remove());

                container.appendChild(item);
            }

            const form = document.getElementById("editDataProgramForm");
            form.action = `/data-programs/${id}`;
        });
    });
    //edit works
    document.querySelectorAll(".btn-edit-works").forEach(button => {
        button.addEventListener("click", function () {

            const modal = new bootstrap.Modal(document.getElementById("editWorkModal"));
            modal.show();

            const id = this.dataset.id;
            const posisi = this.dataset.posisi;
            const proyek = this.dataset.data_program_id;
            const level = this.dataset.level;
            const jenis = this.dataset.jenis;
            const tipe = this.dataset.tipe;
            const lokasi = this.dataset.lokasi;
            const gaji = this.dataset.gaji;
            const deskripsi = this.dataset.deskripsi;
            const kualifikasi = this.dataset.kualifikasi;

            document.getElementById("editPosisi").value = posisi || "";
            document.getElementById("editProyek").value = proyek || "";
            document.getElementById("editLevel").value = level || "";
            document.getElementById("editJenis").value = jenis || "";
            document.getElementById("editTipe").value = tipe || "";
            document.getElementById("editLokasi").value = lokasi || "";
            document.getElementById("editGaji").value = gaji || "";
            document.getElementById("editDeskripsi").value = deskripsi || "";
            document.getElementById("editKualifikasi").value = kualifikasi || "";

            const form = document.getElementById("editPeluangKerjaForm");
            form.action = `/works/${id}`;
        });
    });
});

//modal delete
document.addEventListener("DOMContentLoaded", function () {

    let deleteId = null; // untuk simpan ID yang mau dihapus

    // Ketika tombol delete ditekan → tampilkan modal
    document.querySelectorAll(".btn-delete").forEach(button => {
        button.addEventListener("click", function () {

            deleteId = this.dataset.id; // SIMPAN ID DARI DATA-ID

            const modal = new bootstrap.Modal(
                document.getElementById("confirmDeleteModal")
            );
            modal.show();
        });
    });

    // Ketika tombol HAPUS di modal ditekan → submit form delete
    document.getElementById("confirmDeleteBtn").addEventListener("click", function () {

        if (deleteId) {
            document.getElementById("delete-form-" + deleteId).submit();
        }
    });

});



// Inputan tgl mulai, selesai & tahun anggaran (tambah + edit)
document.addEventListener("DOMContentLoaded", function () {

    function setupTanggal(mulaiId, selesaiId, tahunId) {
        const mulai = document.getElementById(mulaiId);
        const selesai = document.getElementById(selesaiId);
        const tahun = document.getElementById(tahunId);

        if (!mulai || !selesai || !tahun) return;
        mulai.addEventListener("change", () => {
            if (selesai.value && mulai.value > selesai.value) {
                selesai.value = "";
            }
            selesai.min = mulai.value;
        });
        selesai.addEventListener("change", () => {
            if (mulai.value && selesai.value < mulai.value) {
                mulai.value = "";
            }
            mulai.max = selesai.value;
        });
        tahun.addEventListener("input", () => {
            tahun.value = tahun.value.replace(/\D/g, "").slice(0, 4);
        });
    }
    setupTanggal("waktuMulai", "waktuSelesai", "tahunAnggaran");
    setupTanggal("editWaktuMulai", "editWaktuSelesai", "editTahunAnggaran");
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

// format inputan gaji Rp
// TAMBAH
const tambahGajiInput = document.getElementById("gajiInput");
if (tambahGajiInput) {
    tambahGajiInput.addEventListener("input", function () {
        let angka = this.value.replace(/[^0-9]/g, "");
        this.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });

    document.querySelector('#tambahModal form')?.addEventListener("submit", function () {
        tambahGajiInput.value = tambahGajiInput.value.replace(/\./g, "");
    });
}
// EDIT
const editGajiInput = document.getElementById("editGaji");
if (editGajiInput) {
    editGajiInput.addEventListener("input", function () {
        let angka = this.value.replace(/[^0-9]/g, "");
        this.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });

    document.getElementById("editPeluangKerjaForm")?.addEventListener("submit", function () {
        editGajiInput.value = editGajiInput.value.replace(/\./g, "");
    });
}


