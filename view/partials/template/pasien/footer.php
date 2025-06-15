<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle functionality
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarToggle = document.getElementById('sidebarToggle');

        // Mobile sidebar toggle
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });

        // Desktop sidebar collapse (optional)
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'b') {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        });

        // Navigation active state
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Close mobile sidebar when clicking outside
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Responsive handling
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
            }
        });

        // Simulate real-time updates for notifications
        setInterval(function() {
            const badges = document.querySelectorAll('.badge');
            badges.forEach(badge => {
                if (badge.classList.contains('bg-danger')) {
                    const current = parseInt(badge.textContent);
                    if (Math.random() > 0.8) {
                        badge.textContent = Math.max(0, current + Math.floor(Math.random() * 2) - 1);
                    }
                }
            });
        }, 8000);

        // Quick action buttons functionality
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.textContent.includes('Ajukan Konsultasi')) {
                    alert('Fitur ajukan konsultasi akan membuka form untuk membuat permintaan konsultasi baru');
                } else if (this.textContent.includes('Lihat Jadwal')) {
                    alert('Fitur lihat jadwal akan menampilkan semua jadwal konsultasi pasien');
                } else if (this.textContent.includes('Riwayat Medis')) {
                    alert('Fitur riwayat medis akan menampilkan semua rekam medis pasien');
                } else if (this.textContent.includes('Hasil Lab')) {
                    alert('Fitur hasil lab akan menampilkan semua hasil laboratorium pasien');
                }
            });
        });
    </script>
</body>
</html>