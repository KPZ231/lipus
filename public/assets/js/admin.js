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
        addPostForm.addEventListener('submit', handleAddPost);
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

            if (data.posts) {
                postsList.innerHTML = data.posts.map(post => `
                    <div class="post-item">
                        <img src="${post.image}" alt="${post.title}">
                        <div class="post-info">
                            <h3>${post.title}</h3>
                            <p class="category">${getCategoryName(post.category)}</p>
                            <p class="description">${post.description}</p>
                            <button onclick="deletePost('${post.id}')" class="btn-delete">
                                <i class="fas fa-trash"></i> Usuń
                            </button>
                        </div>
                    </div>
                `).join('');
            }
        } catch (error) {
            showMessage('Wystąpił błąd podczas ładowania postów.', true);
        }
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

async function handleAddPost(e) {
    e.preventDefault();
    const errorDiv = document.getElementById('postError');
    
    try {
        const formData = new FormData();
        formData.append('title', document.getElementById('title').value);
        formData.append('description', document.getElementById('description').value);
        formData.append('image', document.getElementById('image').files[0]);

        const response = await fetch('/admin/posts/add', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('adminToken')}`
            },
            body: formData
        });

        const data = await response.json();

        if (response.ok) {
            document.getElementById('addPostForm').reset();
            document.getElementById('imagePreview').innerHTML = '';
            loadPosts();
        } else {
            errorDiv.textContent = data.error || 'Błąd podczas dodawania posta';
            errorDiv.style.display = 'block';
        }
    } catch (error) {
        errorDiv.textContent = 'Wystąpił błąd podczas dodawania posta';
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