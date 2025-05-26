document.addEventListener('DOMContentLoaded', function() {
    // Login form handling
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }

    // Add post form handling
    const addPostForm = document.getElementById('addPostForm');
    if (addPostForm) {
        addPostForm.addEventListener('submit', handleAddPost);
        loadPosts();

        // Image preview
        const imageInput = document.getElementById('image');
        if (imageInput) {
            imageInput.addEventListener('change', handleImagePreview);
        }
    }
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

async function loadPosts() {
    const postsContainer = document.getElementById('postsList');
    if (!postsContainer) return;

    try {
        const response = await fetch('/admin/posts', {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('adminToken')}`
            }
        });

        const data = await response.json();

        if (response.ok) {
            postsContainer.innerHTML = data.posts.map(post => `
                <div class="post-card">
                    <img src="${post.image}" alt="${post.title}">
                    <div class="post-content">
                        <h3>${post.title}</h3>
                        <p>${post.description}</p>
                        <small>Dodano: ${new Date(post.created_at).toLocaleString()}</small>
                    </div>
                </div>
            `).join('');
        } else {
            postsContainer.innerHTML = '<p class="error-message">Nie udało się załadować postów</p>';
        }
    } catch (error) {
        postsContainer.innerHTML = '<p class="error-message">Wystąpił błąd podczas ładowania postów</p>';
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