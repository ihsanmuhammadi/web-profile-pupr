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

// PAGINATION
document.addEventListener("DOMContentLoaded", function() {

    let itemsPerPage = 5;
    const isJobPage = document.querySelector('.job-pagination');
    if (isJobPage) {
        itemsPerPage = 9;
    }

    const projectListContainer = document.querySelector('.project-list');
    const paginationContainer = document.querySelector('.pagination');
    const paginationNav = document.getElementById('pagination-nav');

    if (!projectListContainer || !paginationContainer) {
        console.warn('Pagination script: Kontainer tidak ditemukan.');
        if (paginationNav) paginationNav.style.display = 'none';
        return;
    }

    const allProjects = isJobPage
        ? Array.from(projectListContainer.querySelectorAll('.col-md-4, .col-sm-6'))
        : Array.from(projectListContainer.querySelectorAll('.card'));


    if (allProjects.length === 0) {
        console.warn('Pagination script: Tidak ada data proyek ditemukan.');
        if (paginationNav) paginationNav.style.display = 'none';
        return;
    }

    const totalItems = allProjects.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    let currentPage = 1;

    const dataDitemukan = document.getElementById('data-ditemukan');
    if (dataDitemukan) dataDitemukan.textContent = `${totalItems} data ditemukan`;

    function showPage(page) {
        currentPage = page;
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        allProjects.forEach(item => {
            item.style.display = 'none';
        });

        const itemsToShow = allProjects.slice(startIndex, endIndex);
        itemsToShow.forEach(item => {
            item.style.display = 'block';
        });

        renderPaginationControls();
    }

    function renderPaginationControls() {
        paginationContainer.innerHTML = '';

        // Tombol Previous
        const prevItem = document.createElement('li');
        prevItem.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
        prevItem.innerHTML = `<a class="page-link" href="#" data-page="${currentPage - 1}">&lt;</a>`;
        paginationContainer.appendChild(prevItem);

        // Tombol angka
        for (let i = 1; i <= totalPages; i++) {
            const pageItem = document.createElement('li');
            pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
            pageItem.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
            paginationContainer.appendChild(pageItem);
        }

        // Tombol Next
        const nextItem = document.createElement('li');
        nextItem.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
        nextItem.innerHTML = `<a class="page-link" href="#" data-page="${currentPage + 1}">&gt;</a>`;
        paginationContainer.appendChild(nextItem);
    }

    paginationContainer.addEventListener('click', function(e) {
        e.preventDefault();
        const target = e.target.closest('a.page-link');
        if (!target) return;

        const page = parseInt(target.dataset.page, 10);
        if (isNaN(page) || page < 1 || page > totalPages) return;

        if (page !== currentPage) {
            showPage(page);
        }
    });

    if (totalPages > 1) {
        showPage(1);
    } else {
        if (paginationNav) paginationNav.style.display = 'none';
        allProjects.forEach(item => {
            item.style.display = 'block';
        });
    }
});

// DETAIL PEKERJAAN
document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('jobOverlay');
    const closeBtn = document.getElementById('closeSidebar');
    const jobCards = document.querySelectorAll('.job-card');

    jobCards.forEach(card => {
      card.addEventListener('click', () => {
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
      });
    });

    closeBtn.addEventListener('click', () => {
      overlay.classList.remove('show');
      document.body.style.overflow = 'auto';
    });

    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        overlay.classList.remove('show');
        document.body.style.overflow = 'auto';
      }
    });
  });

// FORM LAMAR
document.addEventListener('DOMContentLoaded', () => {
  const openBtn = document.getElementById('openApplyForm');
  const overlay = document.getElementById('applyOverlay');
  const cancelBtn = document.getElementById('cancelApply');

  openBtn.addEventListener('click', () => overlay.classList.remove('d-none'));
  cancelBtn.addEventListener('click', () => overlay.classList.add('d-none'));
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) overlay.classList.add('d-none');
  });
});

// Nav breadcrumb + program category badge
document.addEventListener("DOMContentLoaded", () => {
    const breadcrumbLink = document.getElementById("breadcrumbPrev");
    const categoryBadge = document.querySelector(".program-category-badge");
    const referrer = document.referrer;
    const pageMap = {
        "/jalan-lingkungan": "Jalan Lingkungan",
        "/drainase-lingkungan": "Drainase Lingkungan",
        "/jembatan-lingkungan": "Jembatan Lingkungan",
        "/rumah-taklayak": "Rumah Tak Layak Huni",
        "/perumahan": "Perumahan",
    };

    if (referrer) {
        try {
            // path dari url sebelumnya
            const referrerPath = new URL(referrer).pathname;

            if (pageMap[referrerPath]) {
                const label = pageMap[referrerPath];
                breadcrumbLink.textContent = label;
                breadcrumbLink.href = referrerPath;

                if (categoryBadge) {
                    categoryBadge.textContent = label;
                }
            }
        } catch (e) {
            console.warn("Tidak bisa membaca halaman sebelumnya:", e);
        }
    }
});


// form wajib isi
document.getElementById('applyForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const requiredFields = ['namaLengkap', 'telepon', 'email', 'lokasi', 'institusi', 'jurusan', 'cv'];
  let valid = true;

  requiredFields.forEach(id => {
    const field = document.getElementById(id);
    if (!field.value.trim()) {
      field.classList.add('is-invalid');
      valid = false;
    } else {
      field.classList.remove('is-invalid');
    }
  });

  if (!valid) return;
  document.getElementById('successOverlay').classList.remove('d-none');
  this.reset();
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
document.getElementById('copyBtn').addEventListener('click', function () {
    const link = document.getElementById('youtubeLink').href;
    navigator.clipboard.writeText(link).then(() => {
      //alert box
      const alertBox = document.createElement('div');
      alertBox.textContent = 'Link berhasil disalin!';
      alertBox.style.position = 'fixed';
      alertBox.style.top = '50%';
      alertBox.style.left = '50%';
      alertBox.style.transform = 'translate(-50%, -50%)';
      alertBox.style.backgroundColor = '#0d6efd';
      alertBox.style.color = 'white';
      alertBox.style.padding = '14px 28px';
      alertBox.style.borderRadius = '12px';
      alertBox.style.boxShadow = '0 4px 12px rgba(0,0,0,0.25)';
      alertBox.style.fontWeight = '500';
      alertBox.style.zIndex = '9999';
      alertBox.style.transition = 'opacity 0.4s ease';
      alertBox.style.opacity = '1';
      document.body.appendChild(alertBox);

      setTimeout(() => {
        alertBox.style.opacity = '0';
        setTimeout(() => alertBox.remove(), 400);
      }, 1800);
    });
  });




