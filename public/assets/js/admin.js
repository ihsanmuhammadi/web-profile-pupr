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
    document.querySelectorAll(".btn-primary").forEach(button => {
        button.addEventListener("click", function () {
            const modal = new bootstrap.Modal(document.getElementById("detailBannerModal"));
            modal.show();
        });
    });
});

// edit banner
document.addEventListener("DOMContentLoaded", function () {
    const editFileInput = document.getElementById("editFileInput");
    const editFileName = document.getElementById("editFileName");
    const editFileText = document.getElementById("editFileText");

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

    document.querySelectorAll(".btn-warning").forEach(button => {
        button.addEventListener("click", function () {
            const modal = new bootstrap.Modal(document.getElementById("editBannerModal"));
            modal.show();

            document.getElementById("editJudul").value = "Judul banner contoh";
            document.getElementById("editFileName").textContent = "banner_lama.jpg";
            document.getElementById("editFileText").textContent = "File saat ini:";
        });
    });
});

//delete banner
document.addEventListener("DOMContentLoaded", function () {

    let deleteId = null;

    document.querySelectorAll(".btn-danger").forEach((button, index) => {
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

