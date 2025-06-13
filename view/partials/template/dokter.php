<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter - Medical System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --info-color: #17a2b8;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background: var(--primary-color);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h4 {
            color: white;
            margin: 0;
            font-size: 1.2rem;
        }

        .sidebar-header.collapsed h4 {
            display: none;
        }

        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            padding: 15px 20px;
            border-radius: 0;
            transition: all 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--secondary-color);
            color: white !important;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .top-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 30px;
            margin-bottom: 30px;
        }

        .content-wrapper {
            padding: 0 30px 30px;
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            border-left: 4px solid var(--secondary-color);
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card.warning {
            border-left-color: var(--warning-color);
        }

        .stats-card.success {
            border-left-color: var(--success-color);
        }

        .stats-card.danger {
            border-left-color: var(--accent-color);
        }

        .stats-card.info {
            border-left-color: var(--info-color);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .feature-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .feature-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid var(--secondary-color);
            transition: all 0.3s;
        }

        .feature-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .feature-item:last-child {
            margin-bottom: 0;
        }

        .data-flow {
            background: #2c3e50;
            color: white;
            border-radius: 10px;
            padding: 20px;
            font-family: 'Courier New', monospace;
            overflow-x: auto;
        }

        .data-flow-item {
            margin-left: 20px;
            position: relative;
        }

        .data-flow-item:before {
            content: "└─";
            position: absolute;
            left: -20px;
            color: #3498db;
        }

        .btn-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .btn-toggle {
                display: block;
            }
        }

        @media (min-width: 769px) {
            .btn-toggle {
                display: none;
            }
        }
    </style>
</head>
<body>

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

        // Simulate real-time updates
        setInterval(function() {
            const badges = document.querySelectorAll('.badge');
            badges.forEach(badge => {
                const current = parseInt(badge.textContent);
                if (Math.random() > 0.7) {
                    badge.textContent = Math.max(0, current + Math.floor(Math.random() * 3) - 1);
                }
            });
        }, 5000);
    </script>
</body>
</html>
