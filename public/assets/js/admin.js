document.addEventListener('DOMContentLoaded', function() {
    // Login form handling
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }

    // Display current date on dashboard
    const currentDateElement = document.querySelector('.current-date');
    if (currentDateElement) {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        currentDateElement.textContent = now.toLocaleDateString('pl-PL', options);
    }

    // Sidebar Navigation
    const sidebarLinks = document.querySelectorAll('.sidebar-menu a[data-section]');
    const tabContents = document.querySelectorAll('.tab-content');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.admin-sidebar');
    
    // Create overlay element for mobile
    const overlay = document.createElement('div');
    overlay.className = 'sidebar-overlay';
    document.body.appendChild(overlay);

    // Handle sidebar toggle on mobile
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        // Close sidebar when clicking overlay
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    }

    // Function to navigate to a section
    function navigateToSection(sectionId) {
        console.log('Navigating to section:', sectionId);
        
        // Find the section element
        const sectionElement = document.getElementById(sectionId);
        if (!sectionElement) {
            console.error('Section not found:', sectionId);
            return;
        }
        
        // Find the corresponding sidebar link
        const sidebarLink = document.querySelector(`.sidebar-menu a[data-section="${sectionId}"]`);
        
        // Remove active class from all links and contents
        sidebarLinks.forEach(link => link.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));
        
        // Add active class to the selected link and content
        if (sidebarLink) {
            sidebarLink.classList.add('active');
        }
        sectionElement.classList.add('active');
        
        // Close sidebar on mobile
        if (window.innerWidth < 992) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
        
        // If navigating to prices section, load prices
        if (sectionId === 'prices') {
            loadCurrentPrices();
        }
        
        // If navigating to existing posts, ensure posts are loaded
        if (sectionId === 'existing-posts') {
            loadPosts();
        }
    }

    // Handle sidebar navigation
    if (sidebarLinks.length > 0) {
        sidebarLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const sectionId = link.getAttribute('data-section');
                navigateToSection(sectionId);
            });
        });
        
        // Ensure dashboard is active on page load
        const activeSectionId = 'dashboard';
        navigateToSection(activeSectionId);
    }

    // Dashboard quick action buttons
    const actionButtons = document.querySelectorAll('.dashboard-btn[data-navigate]');
    if (actionButtons.length > 0) {
        actionButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const targetSection = button.getAttribute('data-navigate');
                console.log('Quick action button clicked:', targetSection);
                navigateToSection(targetSection);
            });
        });
    }

    // Regular Post Form
    const addRegularPostForm = document.getElementById('addRegularPostForm');
    if (addRegularPostForm) {
        addRegularPostForm.addEventListener('submit', handleRegularPostSubmit);
    }

    // Gallery Post Form
    const addGalleryPostForm = document.getElementById('addGalleryPostForm');
    const galleryImagePreview = document.getElementById('galleryImagePreview');
    if (addGalleryPostForm) {
        addGalleryPostForm.addEventListener('submit', handleGalleryPostSubmit);
        
        // Image preview for gallery
        const galleryImageInput = document.getElementById('galleryImage');
        if (galleryImageInput) {
            galleryImageInput.addEventListener('change', function(e) {
                handleImagePreview(e, 'galleryImagePreview');
            });
        }
    }

    // Prices Form
    const updatePricesForm = document.getElementById('updatePricesForm');
    if (updatePricesForm) {
        updatePricesForm.addEventListener('submit', handlePricesSubmit);
    }

    // Load dashboard data
    loadDashboardData();
    // Load posts for the All Posts section
    loadPosts();

    // Regular Post Form Submit Handler
    async function handleRegularPostSubmit(e) {
        e.preventDefault();
        
        // Create FormData object
        const formData = new FormData(this);
        
        // Handle checkbox (important flag)
        const importantCheckbox = document.getElementById('postImportant');
        formData.set('important', importantCheckbox.checked ? 'true' : 'false');
        
        // Handle event date and time (only include if it's not empty)
        const eventDateInput = document.getElementById('postEventDate');
        const eventTimeInput = document.getElementById('postEventTime');
        
        if (eventDateInput && eventDateInput.value) {
            formData.set('event_date', eventDateInput.value);
            
            // Include time if provided
            if (eventTimeInput && eventTimeInput.value) {
                formData.set('event_time', eventTimeInput.value);
            }
        }
        
        try {
            const response = await fetch('/admin/add-regular-post', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                this.reset();
                showMessage('Post został dodany pomyślnie!', false, 'regularPostError');
                // Odświeżenie danych na dashboardzie i w sekcji postów
                loadDashboardData();
                loadPosts();
                
                // Przekierowanie do sekcji z listą wszystkich postów
                setTimeout(() => {
                    navigateToSection('existing-posts');
                }, 1500);
            } else {
                showMessage(data.error || 'Wystąpił błąd podczas dodawania posta.', true, 'regularPostError');
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            showMessage('Wystąpił błąd podczas dodawania posta.', true, 'regularPostError');
        }
    }

    // Gallery Post Form Submit Handler
    async function handleGalleryPostSubmit(e) {
        e.preventDefault();
        
        // Create FormData object
        const formData = new FormData(this);
        
        try {
            const response = await fetch('/admin/add-gallery-post', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                this.reset();
                galleryImagePreview.innerHTML = '';
                showMessage('Zdjęcie zostało dodane do galerii pomyślnie!', false, 'galleryPostError');
                // Odświeżenie danych na dashboardzie i w sekcji postów
                loadDashboardData();
                loadPosts();
                
                // Przekierowanie do sekcji z listą wszystkich postów
                setTimeout(() => {
                    navigateToSection('existing-posts');
                }, 1500);
            } else {
                showMessage(data.error || 'Wystąpił błąd podczas dodawania zdjęcia do galerii.', true, 'galleryPostError');
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            showMessage('Wystąpił błąd podczas dodawania zdjęcia do galerii.', true, 'galleryPostError');
        }
    }

    // Prices Form Submit Handler
    async function handlePricesSubmit(e) {
        e.preventDefault();
        
        // Create FormData object
        const formData = new FormData(this);
        
        try {
            const response = await fetch('/admin/update-prices', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                showMessage('Cennik został zaktualizowany pomyślnie!', false, 'pricesError');
                loadDashboardData(); // Refresh dashboard prices
            } else {
                showMessage(data.error || 'Wystąpił błąd podczas aktualizacji cennika.', true, 'pricesError');
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            showMessage('Wystąpił błąd podczas aktualizacji cennika.', true, 'pricesError');
        }
    }

    // Load dashboard data
    async function loadDashboardData() {
        loadCurrentPricesForDashboard();
        loadRecentPosts();
    }

    // Load current prices for dashboard
    async function loadCurrentPricesForDashboard() {
        try {
            const response = await fetch('/admin/get-prices');
            const data = await response.json();

            if (data.success && data.prices) {
                // Update dashboard prices
                const dashboardPrice1Wedka = document.getElementById('dashboardPrice1Wedka');
                const dashboardPrice2Wedki = document.getElementById('dashboardPrice2Wedki');
                const dashboardPriceGrill = document.getElementById('dashboardPriceGrill');
                
                if (dashboardPrice1Wedka) dashboardPrice1Wedka.textContent = data.prices.price1Wedka;
                if (dashboardPrice2Wedki) dashboardPrice2Wedki.textContent = data.prices.price2Wedki;
                if (dashboardPriceGrill) dashboardPriceGrill.textContent = data.prices.priceGrill;
                
                // Also update form prices if the form exists
                const price1Wedka = document.getElementById('price1Wedka');
                const price2Wedki = document.getElementById('price2Wedki');
                const priceGrill = document.getElementById('priceGrill');
                
                if (price1Wedka) price1Wedka.value = data.prices.price1Wedka;
                if (price2Wedki) price2Wedki.value = data.prices.price2Wedki;
                if (priceGrill) priceGrill.value = data.prices.priceGrill;
            }
        } catch (error) {
            console.error('Error loading prices for dashboard:', error);
        }
    }

    // Load current prices
    async function loadCurrentPrices() {
        try {
            const response = await fetch('/admin/get-prices');
            const data = await response.json();

            if (data.success && data.prices) {
                const price1Wedka = document.getElementById('price1Wedka');
                const price2Wedki = document.getElementById('price2Wedki');
                const priceGrill = document.getElementById('priceGrill');
                
                if (price1Wedka) price1Wedka.value = data.prices.price1Wedka;
                if (price2Wedki) price2Wedki.value = data.prices.price2Wedki;
                if (priceGrill) priceGrill.value = data.prices.priceGrill;
            }
        } catch (error) {
            console.error('Error loading prices:', error);
            showMessage('Wystąpił błąd podczas ładowania cennika.', true, 'pricesError');
        }
    }

    // Load recent posts for dashboard
    async function loadRecentPosts() {
        const recentPostsContainer = document.getElementById('recentPosts');
        if (!recentPostsContainer) return;

        try {
            const response = await fetch('/admin/get-posts');
            const data = await response.json();

            if (data.posts && data.posts.length > 0) {
                // Count post types for stats
                const regularPosts = data.posts.filter(post => post.type === 'regular');
                const galleryPosts = data.posts.filter(post => post.type === 'gallery');
                
                // Update counters
                const regularPostsCount = document.getElementById('regularPostsCount');
                const galleryPostsCount = document.getElementById('galleryPostsCount');
                
                if (regularPostsCount) regularPostsCount.textContent = regularPosts.length;
                if (galleryPostsCount) galleryPostsCount.textContent = galleryPosts.length;
                
                // Show 5 most recent posts
                const recentPosts = data.posts.slice(0, 5);
                let html = '';
                
                recentPosts.forEach(post => {
                    if (post.type === 'regular') {
                        let eventDateHtml = '';
                        if (post.event_date) {
                            let eventDateText = formatDate(post.event_date, false);
                            
                            // Add time if available
                            if (post.event_time) {
                                eventDateText += ` o ${post.event_time}`;
                            }
                            
                            eventDateHtml = `<p class="event-date"><i class="fas fa-calendar-day"></i> Data wydarzenia: ${eventDateText}</p>`;
                        }
                        
                        html += `
                        <div class="recent-post-item">
                            <div class="recent-post-info">
                                <h4>${post.title}</h4>
                                <p><i class="fas fa-file-alt"></i> Post tekstowy | ${eventDateHtml}<i class="far fa-calendar-alt"></i> ${formatDate(post.created_at)}</p>
                            </div>
                        </div>
                        `;
                    } else if (post.type === 'gallery') {
                        const imagePath = post.image.startsWith('/') ? post.image : '/' + post.image;
                        html += `
                        <div class="recent-post-item">
                            <img src="${imagePath}" alt="${post.title}">
                            <div class="recent-post-info">
                                <h4>${post.title}</h4>
                                <p><i class="fas fa-images"></i> Post galerii | <i class="fas fa-tag"></i> ${getCategoryName(post.category)} | <i class="far fa-calendar-alt"></i> ${formatDate(post.created_at)}</p>
                            </div>
                        </div>
                        `;
                    }
                });
                
                recentPostsContainer.innerHTML = html;
            } else {
                recentPostsContainer.innerHTML = '<div class="no-posts"><i class="fas fa-info-circle"></i> Brak postów do wyświetlenia</div>';
                const regularPostsCount = document.getElementById('regularPostsCount');
                const galleryPostsCount = document.getElementById('galleryPostsCount');
                
                if (regularPostsCount) regularPostsCount.textContent = '0';
                if (galleryPostsCount) galleryPostsCount.textContent = '0';
            }
        } catch (error) {
            console.error('Error loading recent posts:', error);
            recentPostsContainer.innerHTML = '<div class="error-message error">Wystąpił błąd podczas ładowania postów</div>';
        }
    }

    // Load and display posts
    async function loadPosts() {
        const postsList = document.getElementById('postsList');
        if (!postsList) return;
        
        try {
            const response = await fetch('/admin/get-posts');
            const data = await response.json();

            if (data.posts && data.posts.length > 0) {
                // Filtrujemy posty według typu przed ich wyświetleniem
                const posts = data.posts;
                let html = '';
                
                posts.forEach(post => {
                    // Check if it's a regular or gallery post
                    if (post.type === 'regular') {
                        // Regular post display
                        const importantBadge = post.important ? 
                            '<span class="important-badge"><i class="fas fa-exclamation-circle"></i> Ważny</span>' : '';
                        
                        let eventDateHtml = '';
                        if (post.event_date) {
                            let eventDateText = formatDate(post.event_date, false);
                            
                            // Add time if available
                            if (post.event_time) {
                                eventDateText += ` o ${post.event_time}`;
                            }
                            
                            eventDateHtml = `<p class="event-date"><i class="fas fa-calendar-day"></i> Data wydarzenia: ${eventDateText}</p>`;
                        }
                        
                        html += `
                        <div class="post-item ${post.important ? 'important' : ''}">
                            <div class="post-info">
                                <h3>${post.title} ${importantBadge}</h3>
                                <p class="post-type"><i class="fas fa-file-alt"></i> Post tekstowy</p>
                                <p class="date"><i class="far fa-calendar-alt"></i> ${formatDate(post.created_at)}</p>
                                ${eventDateHtml}
                                <p class="content">${post.content}</p>
                                <button onclick="deletePost('${post.id}')" class="btn-delete">
                                    <i class="fas fa-trash"></i> Usuń
                                </button>
                            </div>
                        </div>
                        `;
                    } else if (post.type === 'gallery') {
                        // Gallery post display
                        // Ensure image path starts with a slash for absolute path
                        const imagePath = post.image.startsWith('/') ? post.image : '/' + post.image;
                        
                        html += `
                        <div class="post-item">
                            <img src="${imagePath}" alt="${post.title}">
                            <div class="post-info">
                                <h3>${post.title}</h3>
                                <p class="post-type"><i class="fas fa-images"></i> Post galerii</p>
                                <p class="category"><i class="fas fa-tag"></i> ${getCategoryName(post.category)}</p>
                                <p class="date"><i class="far fa-calendar-alt"></i> ${formatDate(post.created_at)}</p>
                                <p class="description">${post.description}</p>
                                <button onclick="deletePost('${post.id}')" class="btn-delete">
                                    <i class="fas fa-trash"></i> Usuń
                                </button>
                            </div>
                        </div>
                        `;
                    }
                });
                
                postsList.innerHTML = html;
                const noPosts = document.getElementById('noPosts');
                if (noPosts) noPosts.style.display = 'none';
            } else {
                postsList.innerHTML = '';
                const noPosts = document.getElementById('noPosts');
                if (noPosts) noPosts.style.display = 'block';
            }
        } catch (error) {
            console.error('Error loading posts:', error);
            showMessage('Wystąpił błąd podczas ładowania postów.', true);
        }
    }

    // Delete post functionality
    async function deletePost(postId) {
        if (!confirm('Czy na pewno chcesz usunąć ten post?')) {
            return;
        }

        try {
            const response = await fetch('/admin/delete-post', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: postId })
            });

            const data = await response.json();
            if (data.success) {
                loadPosts();
                loadDashboardData(); // Refresh dashboard
                showMessage('Post został usunięty pomyślnie!', false);
            } else {
                showMessage(data.error || 'Wystąpił błąd podczas usuwania posta.', true);
            }
        } catch (error) {
            showMessage('Wystąpił błąd podczas usuwania posta.', true);
        }
    }

    function formatDate(dateString, includeTime = true) {
        const date = new Date(dateString);
        const options = {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: includeTime ? '2-digit' : undefined,
            minute: includeTime ? '2-digit' : undefined
        };
        return date.toLocaleString('pl-PL', options);
    }

    function getCategoryName(category) {
        const categories = {
            'landscape': 'Krajobraz',
            'fish': 'Złowione ryby',
            'people': 'Wędkarze',
            'infrastructure': 'Infrastruktura'
        };
        return categories[category] || 'Inne';
    }

    function showMessage(message, isError = false, elementId = 'postError') {
        const errorElement = document.getElementById(elementId);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
            errorElement.className = `error-message ${isError ? 'error' : 'success'}`;
            setTimeout(() => {
                errorElement.style.display = 'none';
            }, 5000);
        }
    }

    // Make deletePost function available globally
    window.deletePost = deletePost;
});

async function handleLogin(e) {
    e.preventDefault();
    const errorDiv = document.getElementById('loginError');
    
    try {
        const formData = {
            username: document.getElementById('username').value,
            password: document.getElementById('password').value
        };

        const response = await fetch('/admin/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (response.ok) {
            localStorage.setItem('adminToken', data.token);
            window.location.href = '/admin/panel';
        } else {
            errorDiv.textContent = data.error || 'Błąd logowania';
            errorDiv.style.display = 'block';
        }
    } catch (error) {
        errorDiv.textContent = 'Wystąpił błąd podczas logowania';
        errorDiv.style.display = 'block';
    }
}

function handleImagePreview(e, previewId = 'imagePreview') {
    const preview = document.getElementById(previewId);
    const file = e.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Podgląd zdjęcia">`;
        }
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '';
    }
} 