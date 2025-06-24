<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simulate real-time updates
        function updateStats() {
            const stats = document.querySelectorAll('.card-body h4');
            stats.forEach(stat => {
                if (Math.random() > 0.8) {
                    const current = parseInt(stat.textContent);
                    const change = Math.floor(Math.random() * 3) - 1;
                    stat.textContent = Math.max(0, current + change);
                }
            });
        }

        // Update stats every 10 seconds
        setInterval(updateStats, 10000);

        // Add click handlers for action buttons
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.textContent.includes('Kelola') || 
                    this.textContent.includes('Input') || 
                    this.textContent.includes('Lihat') || 
                    this.textContent.includes('Atur')) {
                    e.preventDefault();
                    // Show toast notification
                    const toast = document.createElement('div');
                    toast.className = 'toast position-fixed top-0 end-0 m-3';
                    toast.innerHTML = `
                        <div class="toast-body bg-info text-white">
                            <i class="fas fa-info-circle"></i> Fitur ${this.textContent} akan segera tersedia
                        </div>
                    `;
                    document.body.appendChild(toast);
                    const bsToast = new bootstrap.Toast(toast);
                    bsToast.show();
                    
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 3000);
                }
            });
        });
    </script>
</body>
</html>