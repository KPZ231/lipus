document.addEventListener('DOMContentLoaded', function() {
    // Login form handling
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }

    // Add post form handling
    const addPostForm = document.getElementById('addPostForm');
    const postsList = document.getElementById('postsList');
    const imagePreview = document.getElementById('imagePreview');
    const postError = document.getElementById('postError');
    if (addPostForm) {
        addPostForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Create FormData object
            const formData = new FormData(this);
            
            // Handle checkbox (important flag)
            const importantCheckbox = document.getElementById('important');
            formData.set('important', importantCheckbox.checked ? 'true' : 'false');
            
            // Debug form data
            console.log('Submitting form data:');
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            try {
                const response = await fetch('/admin/add-post', {
                    method: 'POST',
                    body: formData // FormData will automatically set the correct Content-Type
                });

                // Debug response
                console.log('Response status:', response.status);
                const data = await response.json();
                console.log('Response data:', data);

                if (data.success) {
                    addPostForm.reset();
                    imagePreview.innerHTML = '';
                    loadPosts();
                    showMessage('Post został dodany pomyślnie!', false);
                } else {
                    showMessage(data.error || 'Wystąpił błąd podczas dodawania posta.', true);
                }
            } catch (error) {
                console.error('Error submitting form:', error);
                showMessage('Wystąpił błąd podczas dodawania posta.', true);
            }
        });
        loadPosts();

        // Image preview
        const imageInput = document.getElementById('image');
        if (imageInput) {
            imageInput.addEventListener('change', handleImagePreview);
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
                showMessage('Post został usunięty pomyślnie!', false);
            } else {
                showMessage(data.error || 'Wystąpił błąd podczas usuwania posta.', true);
            }
        } catch (error) {
            showMessage('Wystąpił błąd podczas usuwania posta.', true);
        }
    }

    // Load and display posts
    async function loadPosts() {
        try {
            const response = await fetch('/admin/get-posts');
            const data = await response.json();

            if (data.posts && data.posts.length > 0) {
                postsList.innerHTML = data.posts.map(post => {
                    // Ensure image path starts with a slash for absolute path
                    const imagePath = post.image.startsWith('/') ? post.image : '/' + post.image;
                    const importantBadge = post.important ? 
                        '<span class="important-badge"><i class="fas fa-exclamation-circle"></i> Ważny</span>' : '';
                    
                    return `
                    <div class="post-item ${post.important ? 'important' : ''}">
                        <img src="${imagePath}" alt="${post.title}">
                        <div class="post-info">
                            <h3>${post.title} ${importantBadge}</h3>
                            <p class="category">${getCategoryName(post.category)}</p>
                            <p class="date"><i class="far fa-calendar-alt"></i> ${formatDate(post.created_at)}</p>
                            <p class="description">${post.description}</p>
                            <button onclick="deletePost('${post.id}')" class="btn-delete">
                                <i class="fas fa-trash"></i> Usuń
                            </button>
                        </div>
                    </div>
                `}).join('');
                document.getElementById('noPosts').style.display = 'none';
            } else {
                postsList.innerHTML = '';
                document.getElementById('noPosts').style.display = 'block';
            }
        } catch (error) {
            showMessage('Wystąpił błąd podczas ładowania postów.', true);
        }
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleString('pl-PL', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
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

    function showMessage(message, isError = false) {
        postError.textContent = message;
        postError.style.display = 'block';
        postError.className = `error-message ${isError ? 'error' : 'success'}`;
        setTimeout(() => {
            postError.style.display = 'none';
        }, 5000);
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

function handleImagePreview(e) {
    const preview = document.getElementById('imagePreview');
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