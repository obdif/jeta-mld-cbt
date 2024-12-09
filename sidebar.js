document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('toggleSidebar');
    const closeButton = document.getElementById('closeSidebar');
    const categories = document.querySelectorAll('.nav-category');
  
    // Toggle sidebar
    toggleButton.addEventListener('click', () => {
      sidebar.classList.add('active');
    });
  
    // Close sidebar
    closeButton.addEventListener('click', () => {
      sidebar.classList.remove('active');
    });
  
    // Close sidebar when clicking outside
    document.addEventListener('click', (e) => {
      if (!sidebar.contains(e.target) && !toggleButton.contains(e.target) && sidebar.classList.contains('active')) {
        sidebar.classList.remove('active');
      }
    });
  
    // Toggle categories
    categories.forEach(category => {
      const header = category.querySelector('.nav-category-header');
      header.addEventListener('click', () => {
        category.classList.toggle('collapsed');
      });
    });
  
    // Handle navigation item clicks
    const navItems = document.querySelectorAll('.nav-links li');
    navItems.forEach(item => {
      item.addEventListener('click', () => {
        // Remove active class from all items
        navItems.forEach(i => i.classList.remove('active'));
        // Add active class to clicked item
        item.classList.add('active');
        
        // Close sidebar on mobile after navigation
        if (window.innerWidth <= 768) {
          sidebar.classList.remove('active');
        }
      });
    });
  });