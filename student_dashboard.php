<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JETA-MLD-CBT - Learn Without Limits</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        #overlay {
            transition: opacity 0.3s ease-in-out;
        }
        .overlay-hidden {
            opacity: 0;
            pointer-events: none;
        }
        .dropdown-menu {
            transition: opacity 0.2s ease-in-out, visibility 0s linear;
        }
        .dropdown-hidden {
            opacity: 0;
            visibility: hidden;
        }
        .dropdown-item {
            display: block;
            padding: 0.5rem 1rem;
            color: #374151; /* gray-700 */
            text-decoration: none;
            cursor: pointer;
        }
        .dropdown-item:hover {
            background-color: #ECFDF5; /* green-50 */
            color: #16A34A; /* green-600 */
        }
        .dropdown-item.logout:hover {
            color: #DC2626; /* red-600 */
        }
        .logout-button {
            position: sticky;
            bottom: 0;
            width: 100%;
            background-color: #DC2626; /* red-600 */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 0;
            border-radius: 0.375rem; /* rounded-md */
        }
        .logout-button:hover {
            background-color: #B91C1C; /* red-700 */
        }
        /* Ensure Tailwind takes precedence over Bootstrap for dropdown */
        .dropdown-menu {
            z-index: 50 !important;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar Navigation -->
        <div id="sidebar" class="sidebar fixed top-0 left-0 w-64 bg-white shadow-lg h-full flex flex-col p-4 md:translate-x-0 z-50">
            <div class="flex items-center mb-6">
                <img src="./assets/img/jeta-logo-dark.png" alt="Jeta Logo" class="h-10 w-16">
                <img src="./assets/img/mldng.png" alt="Mld Logo" class="h-12 w-20 ml-2">
            </div>
            <nav class="flex flex-col space-y-2 flex-grow">
                <button class="bg-green-100 text-green-600 px-4 py-2 rounded-md text-left font-medium">Start Exam</button>
                <!-- <button class="text-gray-700 hover:text-green-600 px-4 py-2 text-left font-medium">Test Analysis</button> -->
                <button class="text-gray-700 hover:text-green-600 px-4 py-2 text-left font-medium">Buy Units</button>
                <button class="text-gray-700 hover:text-green-600 px-4 py-2 text-left font-medium">Refer a Friend</button>
            </nav>
            <!-- <div class="mt-4 flex items-center space-x-2 p-4">
                <i class="bi-bell h-6 w-6 text-red-500 hover:text-red-600 cursor-pointer" aria-label="Notifications"></i>
                <div class="h-8 w-8 rounded-full bg-red-800"></div>
            </div> -->
            <!-- Logout Button -->
            <button id="sidebarLogout" class="logout-button">
                <i class="bi-box-arrow-right h-5 w-5 mr-2"></i>
                Logout
            </button>
        </div>

        <!-- Overlay for Small Screens -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 overlay-hidden md:hidden z-40"></div>

        <!-- Main Content -->
        <div class="flex-1 ml-0 md:ml-64 transition-all duration-300">
            <!-- Top Bar with Toggle for Small Screens -->
            <div class="bg-white shadow-sm p-4 flex justify-between items-center md:hidden sticky top-0 z-30">
                <button id="toggleSidebar" class="text-green-500 hover:text-green-600 p-2 rounded-md bg-green-50" aria-label="Toggle sidebar">
                    <p class="w-4 h-0.5 bg-black"></p>
                    <p class="w-5 h-0.5 bg-black  mt-1"></p>
                    <p class="w-6 h-0.5 bg-black  mt-1"></p>
                </button>
                <div class="bg-green-50 text-green-600 px-3 py-1 rounded-md text-sm">
                    Units balance: 10
                </div>
            </div>

            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <!-- Profile Section (Visible on All Screens) -->
                <div class="flex justify-end mb-6 relative">
                    <div class="flex items-center space-x-3 group cursor-pointer" id="profileToggle">
                        <div class="h-14 w-14 rounded-full bg-green-200 flex items-center justify-center overflow-hidden">
                            <img src="./assets/img/students.jpeg" alt="Profile Image" class="h-full w-full object-cover">
                        </div>
                        <span class="text-green-900 font-medium capitalize">adekunle Blessing</span>
                        <i class="bi-chevron-down h-4 w-4 text-green-600"></i>
                    </div>
                    <!-- Dropdown Menu -->
                    <div id="profileDropdown" class="dropdown-menu absolute top-full right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 dropdown-hidden z-50">
                        <div class="dropdown-item" data-action="profile">Profile</div>
                        <div class="dropdown-item" data-action="more">More</div>
                        <div class="dropdown-item logout" data-action="logout">Logout</div>
                    </div>
                </div>

                <!-- Units Balance (Hidden on Small Screens) -->
                <div class="hidden md:flex justify-end mb-6">
                    <div class="bg-green-50 text-green-600 px-4 py-2 rounded-md">
                        Units balance: 10
                    </div>
                </div>

                <!-- Search Section -->
                <div class="mb-8 border border-gray-200 p-4 sm:p-6 rounded-lg shadow-sm bg-white">
                    <h1 class="text-xl sm:text-2xl font-bold text-green-900 mb-6">Search Questions</h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Select Exam Category:</label>
                            <select class="w-full border border-green-300 rounded-md px-3 py-2 focus:ring-green-500 focus:border-green-500">
                                <option>Select Exam Category</option>
                                <option value="WAEC">WAEC</option>
                                <option value="NECO">NECO</option>
                                <option value="Common Entrance Exam(2020)">Common Entrance Exam(2020)</option>
                                <option value="Math Olympiad for Primary School">Math Olympiad for Primary School</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Select Subject:</label>
                            <select class="w-full border border-green-300 rounded-md px-3 py-2 focus:ring-green-500 focus:border-green-500">
                                <option>Select subject</option>
                                <option value="mathematics">Mathematics</option>
                                <option value="english">English</option>
                                <option value="biology">Biology</option>
                                <option value="chemistry">Chemistry</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Select Exam Year:</label>
                            <select class="w-full border border-green-300 rounded-md px-3 py-2 focus:ring-green-500 focus:border-green-500">
                                <option>Select Exam Yearr</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                Search
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Past Questions Section -->
                <div>
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-green-900 mb-4 sm:mb-0">Trending Questions Bank</h2>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-green-600">Sort by:</span>
                            <select class="border border-green-300 rounded-md px-3 py-1 text-sm focus:ring-green-500 focus:border-green-500">
                                <option>Newest</option>
                            </select>
                        </div>
                    </div>

                    <!-- Question Cards -->
                    <div class="space-y-4">
                        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-green-100 hover:border-green-200 transition-colors">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <span class="text-green-600 font-semibold">GRE</span>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-green-900">English Language</h3>
                                        <p class="text-sm text-green-600">GRE English Language Test</p>
                                    </div>
                                </div>
                                <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                                    <!-- <div class="flex space-x-4">
                                        <div class="flex items-center space-x-1">
                                            <span class="text-green-600">118</span>
                                            <span class="text-sm text-green-500">mins</span>
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <span class="text-green-600">41</span>
                                            <span class="text-sm text-green-500">questions</span>
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <span class="text-green-600">82</span>
                                            <span class="text-sm text-green-500">marks</span>
                                        </div>
                                    </div> -->
                                    <div class="flex items-center space-x-4">
                                        <span class="text-red-500">Free</span>
                                        <button class="bg-green-600 text-white px-4 sm:px-6 py-2 rounded-md hover:bg-green-700 transition-colors">
                                            Practice
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-green-100 hover:border-green-200 transition-colors">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <span class="text-green-600 font-semibold">ACT</span>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-green-900">English Language</h3>
                                        <p class="text-sm text-green-600">ACT ENGLISH LANGUAGE TEST</p>
                                    </div>
                                </div>
                                <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">

                                    <div class="flex items-center space-x-4">
                                        <span class="text-red-500">Free</span>
                                        <button class="bg-green-600 text-white px-4 sm:px-6 py-2 rounded-md hover:bg-green-700 transition-colors">
                                            Practice
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-8">
                        <p>© <span>Copyright</span> <strong class="px-1 sitename">JETA-MLD-CBT</strong> <span>All Rights Reserved</span></p>
                        <div class="credits mt-2">
                            Designed by <a href="https://jetacoms.tech/" class="text-green-600 hover:text-green-700">JETA COMMUNICATIONS</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOM fully loaded'); // Debugging

            // Sidebar Toggle
            const toggleSidebar = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            if (!toggleSidebar || !sidebar || !overlay) {
                console.error('Sidebar elements not found');
                return;
            }

            if (window.innerWidth < 768) {
                sidebar.classList.add('sidebar-hidden');
            }

            toggleSidebar.addEventListener('click', (e) => {
                e.stopPropagation();
                sidebar.classList.toggle('sidebar-hidden');
                overlay.classList.toggle('overlay-hidden');
                console.log('Sidebar toggled'); // Debugging
            });

            document.addEventListener('click', (e) => {
                if (window.innerWidth < 768 && !sidebar.contains(e.target) && !toggleSidebar.contains(e.target)) {
                    sidebar.classList.add('sidebar-hidden');
                    overlay.classList.add('overlay-hidden');
                }
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.add('sidebar-hidden');
                overlay.classList.add('overlay-hidden');
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('sidebar-hidden');
                    overlay.classList.add('overlay-hidden');
                } else {
                    sidebar.classList.add('sidebar-hidden');
                }
            });

            // Profile Dropdown
            const profileToggle = document.getElementById('profileToggle');
            const profileDropdown = document.getElementById('profileDropdown');
            const dropdownItems = profileDropdown.querySelectorAll('.dropdown-item');
            const sidebarLogout = document.getElementById('sidebarLogout');

            if (!profileToggle || !profileDropdown || !sidebarLogout) {
                console.error('Dropdown elements not found');
                return;
            }

            let isDropdownOpen = false;

            profileToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                isDropdownOpen = !isDropdownOpen;
                profileDropdown.classList.toggle('dropdown-hidden', !isDropdownOpen);
                console.log('Dropdown toggled:', isDropdownOpen); // Debugging
            });

            profileToggle.addEventListener('mouseenter', () => {
                if (window.innerWidth >= 768 && !isDropdownOpen) {
                    profileDropdown.classList.remove('dropdown-hidden');
                    console.log('Dropdown shown on hover'); // Debugging
                }
            });

            profileToggle.addEventListener('mouseleave', () => {
                if (window.innerWidth >= 768 && !isDropdownOpen) {
                    profileDropdown.classList.add('dropdown-hidden');
                    console.log('Dropdown hidden on hover out'); // Debugging
                }
            });

            profileDropdown.addEventListener('mouseenter', () => {
                if (window.innerWidth >= 768) {
                    profileDropdown.classList.remove('dropdown-hidden');
                    console.log('Dropdown kept open on hover'); // Debugging
                }
            });

            profileDropdown.addEventListener('mouseleave', () => {
                if (window.innerWidth >= 768 && !isDropdownOpen) {
                    profileDropdown.classList.add('dropdown-hidden');
                    console.log('Dropdown hidden on dropdown hover out'); // Debugging
                }
            });

            document.addEventListener('click', (e) => {
                if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
                    isDropdownOpen = false;
                    profileDropdown.classList.add('dropdown-hidden');
                    console.log('Dropdown closed on outside click'); // Debugging
                }
            });

            dropdownItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const action = item.getAttribute('data-action');
                    switch (action) {
                        case 'profile':
                            console.log('Navigating to Profile');
                            break;
                        case 'more':
                            console.log('Showing More options');
                            break;
                        case 'logout':
                            console.log('Logging out from dropdown');
                            break;
                    }
                    isDropdownOpen = false;
                    profileDropdown.classList.add('dropdown-hidden');
                    console.log('Dropdown item clicked:', action); // Debugging
                });
            });

            sidebarLogout.addEventListener('click', (e) => {
                e.stopPropagation();
                console.log('Logging out from sidebar');
                if (window.innerWidth < 768) {
                    sidebar.classList.add('sidebar-hidden');
                    overlay.classList.add('overlay-hidden');
                }
            });
        });
    </script>
</body>
</html>