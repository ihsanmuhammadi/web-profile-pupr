// NAVBAR
document.addEventListener("DOMContentLoaded", function() {
    if (window.innerWidth > 992) {
        document.querySelectorAll('.navbar .nav-item.dropdown').forEach(function(everyDropdown){
            everyDropdown.addEventListener('mouseover', function() {
                const dropdownMenu = this.querySelector('.dropdown-menu');
                dropdownMenu.classList.add('show');
            });

            everyDropdown.addEventListener('mouseleave', function() {
                const dropdownMenu = this.querySelector('.dropdown-menu');
                dropdownMenu.classList.remove('show');
            });
        });
    }
});

// // PAGINATION
// document.addEventListener("DOMContentLoaded", function() {

//     let itemsPerPage = 5;
//     const isJobPage = document.querySelector('.job-pagination');
//     if (isJobPage) {
//         itemsPerPage = 9;
//     }

//     const projectListContainer = document.querySelector('.project-list');
//     const paginationContainer = document.querySelector('.pagination');
//     const paginationNav = document.getElementById('pagination-nav');

//     if (!projectListContainer || !paginationContainer) {
//         console.warn('Pagination script: Kontainer tidak ditemukan.');
//         if (paginationNav) paginationNav.style.display = 'none';
//         return;
//     }

//     const allProjects = isJobPage
//         ? Array.from(projectListContainer.querySelectorAll('.col-md-4, .col-sm-6'))
//         : Array.from(projectListContainer.querySelectorAll('.card'));


//     if (allProjects.length === 0) {
//         console.warn('Pagination script: Tidak ada data proyek ditemukan.');
//         if (paginationNav) paginationNav.style.display = 'none';
//         return;
//     }

//     const totalItems = allProjects.length;
//     const totalPages = Math.ceil(totalItems / itemsPerPage);
//     let currentPage = 1;

//     const dataDitemukan = document.getElementById('data-ditemukan');
//     if (dataDitemukan) dataDitemukan.textContent = `${totalItems} data ditemukan`;

//     function showPage(page) {
//         currentPage = page;
//         const startIndex = (page - 1) * itemsPerPage;
//         const endIndex = startIndex + itemsPerPage;

//         allProjects.forEach(item => {
//             item.style.display = 'none';
//         });

//         const itemsToShow = allProjects.slice(startIndex, endIndex);
//         itemsToShow.forEach(item => {
//             item.style.display = 'block';
//         });

//         renderPaginationControls();
//     }

//     function renderPaginationControls() {
//         paginationContainer.innerHTML = '';

//         // Tombol Previous
//         const prevItem = document.createElement('li');
//         prevItem.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
//         prevItem.innerHTML = `<a class="page-link" href="#" data-page="${currentPage - 1}">&lt;</a>`;
//         paginationContainer.appendChild(prevItem);

//         // Tombol angka
//         for (let i = 1; i <= totalPages; i++) {
//             const pageItem = document.createElement('li');
//             pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
//             pageItem.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
//             paginationContainer.appendChild(pageItem);
//         }

//         // Tombol Next
//         const nextItem = document.createElement('li');
//         nextItem.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
//         nextItem.innerHTML = `<a class="page-link" href="#" data-page="${currentPage + 1}">&gt;</a>`;
//         paginationContainer.appendChild(nextItem);
//     }

//     paginationContainer.addEventListener('click', function(e) {
//         e.preventDefault();
//         const target = e.target.closest('a.page-link');
//         if (!target) return;

//         const page = parseInt(target.dataset.page, 10);
//         if (isNaN(page) || page < 1 || page > totalPages) return;

//         if (page !== currentPage) {
//             showPage(page);
//         }
//     });

//     if (totalPages > 1) {
//         showPage(1);
//     } else {
//         if (paginationNav) paginationNav.style.display = 'none';
//         allProjects.forEach(item => {
//             item.style.display = 'block';
//         });
//     }
// });

document.addEventListener('DOMContentLoaded', () => {
    let currentWorkId = null;

    // DETAIL PEKERJAAN
    const jobOverlay = document.getElementById('jobOverlay');
    const closeSidebarBtn = document.getElementById('closeSidebar');
    const jobCards = document.querySelectorAll('.job-card');

    jobCards.forEach(card => {
        card.addEventListener('click', () => {
            // Get data from card
            currentWorkId = card.dataset.id;
            const posisi = card.dataset.posisi;
            const program = card.dataset.program;
            const kualifikasi = card.dataset.kualifikasi;
            const jenis = card.dataset.jenis;
            const bidang = card.dataset.bidang;
            const tipe = card.dataset.tipe;
            const lokasi = card.dataset.lokasi;
            const gaji = card.dataset.gaji;
            const tenggat = card.dataset.tenggat;
            const deskripsi = card.dataset.deskripsi;
            const kualifikasiDetail = card.dataset.kualifikasiDetail;
            const logo = card.dataset.logo;

            // Update overlay detail content
            document.getElementById('detailLogo').src = logo;
            document.getElementById('detailPosisi').textContent = posisi;
            document.getElementById('detailProgram').textContent = program;
            document.getElementById('detailTenggat').textContent = tenggat;
            document.getElementById('detailKualifikasi').textContent = kualifikasi;
            document.getElementById('detailJenis').textContent = jenis;
            document.getElementById('detailBidang').textContent = bidang || '-';
            document.getElementById('detailTipe').textContent = tipe;
            document.getElementById('detailLokasi').textContent = lokasi;
            document.getElementById('detailGaji').textContent = gaji;

            // Parse deskripsi
            if (deskripsi) {
                const deskList = deskripsi.split('\n').filter(item => item.trim() !== '');
                const deskHTML = '<ul class="small mb-3">' +
                    deskList.map(item => `<li>${item}</li>`).join('') +
                    '</ul>';
                document.getElementById('detailDeskripsi').innerHTML = deskHTML;
            }

            // Parse kualifikasi detail
            if (kualifikasiDetail) {
                const kualList = kualifikasiDetail.split('\n').filter(item => item.trim() !== '');
                const kualHTML = '<ul class="small mb-0">' +
                    kualList.map(item => `<li>${item}</li>`).join('') +
                    '</ul>';
                document.getElementById('detailKualifikasiDetail').innerHTML = kualHTML;
            }

            // Show overlay
            jobOverlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    });

    if (closeSidebarBtn) {
        closeSidebarBtn.addEventListener('click', () => {
            jobOverlay.classList.remove('show');
            document.body.style.overflow = 'auto';
        });
    }

    if (jobOverlay) {
        jobOverlay.addEventListener('click', (e) => {
            if (e.target === jobOverlay) {
                jobOverlay.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        });
    }

    // FORM LAMAR
    const openApplyBtn = document.getElementById('openApplyForm');
    const applyOverlay = document.getElementById('applyOverlay');
    const cancelApplyBtn = document.getElementById('cancelApply');
    const clearPortofolioBtn = document.getElementById('clearPortofolio');
    const applyForm = document.getElementById('applyForm');

    if (openApplyBtn) {
        openApplyBtn.addEventListener('click', () => {
            // Get current job data
            const posisi = document.getElementById('detailPosisi').textContent;
            const program = document.getElementById('detailProgram').textContent;

            // Update form header
            document.getElementById('applyPosisi').textContent = 'Lamar ' + posisi;
            document.getElementById('applyProgram').textContent = program;
            document.getElementById('applyWorkId').value = currentWorkId;

            // Show apply form
            applyOverlay.classList.remove('d-none');
        });
    }

    if (cancelApplyBtn) {
        cancelApplyBtn.addEventListener('click', () => {
            applyOverlay.classList.add('d-none');
            applyForm.reset();
        });
    }

    if (applyOverlay) {
        applyOverlay.addEventListener('click', (e) => {
            if (e.target === applyOverlay) {
                applyOverlay.classList.add('d-none');
                applyForm.reset();
            }
        });
    }

    if (clearPortofolioBtn) {
        clearPortofolioBtn.addEventListener('click', () => {
            document.querySelector('input[name="portofolio"]').value = '';
        });
    }

    // Show loading on form submit
    // Just keep this simple version:
    if (applyForm) {
        applyForm.addEventListener('submit', (e) => {
            // Don't prevent default - let the form validate and submit naturally
            const submitBtn = applyForm.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Mengirim...';
            }
        });
    }

    // Handle success overlay if it exists
    const successOverlay = document.getElementById('successOverlay');
    const closeSuccessBtn = document.getElementById('closeSuccess');

    if (closeSuccessBtn && successOverlay) {
        closeSuccessBtn.addEventListener('click', () => {
            successOverlay.classList.add('d-none');
            document.body.style.overflow = 'auto';
        });
    }
});
//     // Close success overlay
//     closeSuccessBtn.addEventListener('click', () => {
//         successOverlay.classList.add('d-none');
//         document.body.style.overflow = 'auto';
//     });

//     // Show success overlay if redirected with success message
//     // @if(session('success'))
//     //     successOverlay.classList.remove('d-none');
//     //     document.body.style.overflow = 'hidden';
//     // @endif
// });

// Nav breadcrumb + program category badge
// document.addEventListener("DOMContentLoaded", () => {
//     const breadcrumbLink = document.getElementById("breadcrumbPrev");
//     const categoryBadge = document.querySelector(".program-category-badge");
//     const referrer = document.referrer;
//     const pageMap = {
//         "/jalan-lingkungan": "Jalan Lingkungan",
//         "/drainase-lingkungan": "Drainase Lingkungan",
//         "/jembatan-lingkungan": "Jembatan Lingkungan",
//         "/rumah-taklayak": "Rumah Tak Layak Huni",
//         "/perumahan": "Perumahan",
//     };

//     if (referrer) {
//         try {
//             // path dari url sebelumnya
//             const referrerPath = new URL(referrer).pathname;

//             if (pageMap[referrerPath]) {
//                 const label = pageMap[referrerPath];
//                 breadcrumbLink.textContent = label;
//                 breadcrumbLink.href = referrerPath;

//                 if (categoryBadge) {
//                     categoryBadge.textContent = label;
//                 }
//             }
//         } catch (e) {
//             console.warn("Tidak bisa membaca halaman sebelumnya:", e);
//         }
//     }
// });


// form wajib isi
document.getElementById('applyForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const requiredFields = ['nama', 'nomor_telepon', 'email', 'lokasi', 'pendidikan', 'jurusan', 'cv', 'portofolio'];
    let valid = true;

    requiredFields.forEach(name => {
        const field = document.querySelector(`[name="${name}"]`);

        if (!field) return; // Skip if field doesn't exist

        // Handle file input differently
        if (field.type === 'file') {
            if (!field.files || field.files.length === 0) {
                field.classList.add('is-invalid');
                valid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        } else {
            // Handle text/email/tel/url inputs
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                valid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        }
    });

    if (!valid) return;

    // If validation passes, submit the form
    const successOverlay = document.getElementById('successOverlay');
    if (successOverlay) {
        successOverlay.classList.remove('d-none');
    }

    // Actually submit the form to the server
    this.submit();
});

document.getElementById('closeSuccess').addEventListener('click', function () {
  document.getElementById('successOverlay').classList.add('d-none');
});

// trash portofolio
document.getElementById('clearPortofolio').addEventListener('click', function () {
const input = document.getElementById('portofolio');
input.value = '';
input.focus();
});




// filter checkbox
// document.querySelectorAll('.filter-single').forEach(input => {
//     input.addEventListener('change', function() {
//         if (this.checked) {
//             const name = this.getAttribute('name');
//             document.querySelectorAll(`.filter-single[name="${name}"]`).forEach(other => {
//                 if (other !== this) other.checked = false;
//             });
//         }
//     });
// });

// copy link yt pedoman
// document.getElementById('copyBtn').addEventListener('click', function () {
//     const link = document.getElementById('youtubeLink').href;
//     navigator.clipboard.writeText(link).then(() => {
//       //alert box
//       const alertBox = document.createElement('div');
//       alertBox.textContent = 'Link berhasil disalin!';
//       alertBox.style.position = 'fixed';
//       alertBox.style.top = '50%';
//       alertBox.style.left = '50%';
//       alertBox.style.transform = 'translate(-50%, -50%)';
//       alertBox.style.backgroundColor = '#0d6efd';
//       alertBox.style.color = 'white';
//       alertBox.style.padding = '14px 28px';
//       alertBox.style.borderRadius = '12px';
//       alertBox.style.boxShadow = '0 4px 12px rgba(0,0,0,0.25)';
//       alertBox.style.fontWeight = '500';
//       alertBox.style.zIndex = '9999';
//       alertBox.style.transition = 'opacity 0.4s ease';
//       alertBox.style.opacity = '1';
//       document.body.appendChild(alertBox);

//       setTimeout(() => {
//         alertBox.style.opacity = '0';
//         setTimeout(() => alertBox.remove(), 400);
//       }, 1800);
//     });
//   });




