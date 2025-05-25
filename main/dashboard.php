<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Adminpanel - Dashboard</title>
  <style>
    /* Reset and base */
    *, *::before, *::after {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
        Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      background: linear-gradient(135deg, #243b55 0%, #141e30 100%);
      color: #eff3f7;
      min-height: 100vh;
      padding: 2rem 1rem 3rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      user-select: none;
    }
    h1 {
      font-weight: 900;
      font-size: 2.8rem;
      margin-bottom: 2.5rem;
      text-shadow: 0 2px 8px rgba(0,0,0,0.8);
    }
    .dashboard-container {
      background: rgba(255 255 255 / 0.08);
      backdrop-filter: blur(12px);
      border-radius: 14px;
      border: 1.5px solid rgba(255 255 255 / 0.15);
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.35);
      width: 100%;
      max-width: 900px;
      padding: 2.5rem 2.5rem 3rem;
      box-sizing: border-box;
      color: #e0e7ff;
      user-select: text;
    }
    .section {
      margin-bottom: 3rem;
    }
    .section h2 {
      font-weight: 800;
      font-size: 1.9rem;
      color: #bbe1ff;
      margin-bottom: 1.5rem;
      border-bottom: 2px solid #66a9ff;
      padding-bottom: 0.3rem;
      user-select: text;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 1.4rem;
      color: #cbd5e1;
    }
    label {
      font-weight: 700;
      font-size: 1.05rem;
      margin-bottom: 0.4rem;
      color: #a0aec0;
      user-select: text;
    }
    input[type="text"],
    textarea,
    input[type="file"] {
      font-size: 1rem;
      border: none;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      outline: none;
      background-color: rgba(255,255,255,0.12);
      color: #eff3f7;
      box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
      resize: vertical;
      user-select: text;
    }
    input[type="text"]:focus,
    textarea:focus,
    input[type="file"]:focus {
      background-color: rgba(255,255,255,0.25);
      box-shadow: 0 0 14px 3px #66a9ff;
      color: #ffffff;
    }
    textarea {
      min-height: 90px;
    }
    button {
      background-color: #0078d7;
      border: none;
      color: white;
      padding: 0.85rem 0;
      font-size: 1.1rem;
      border-radius: 12px;
      font-weight: 900;
      cursor: pointer;
      box-shadow: 0 8px 20px rgba(0, 120, 215, 0.6);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      user-select: none;
      max-width: 220px;
      align-self: flex-start;
      margin-top: 0.3rem;
    }
    button:hover,
    button:focus {
      background-color: #005ea2;
      box-shadow: 0 12px 28px rgba(0, 94, 162, 0.85);
      outline: none;
    }
    /* Posts list */
    .posts-list {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      max-height: 320px;
      overflow-y: auto;
      border-radius: 10px;
      padding-right: 10px;
      user-select: text;
    }
    .post-item {
      background: rgba(255 255 255 / 0.12);
      border-radius: 10px;
      padding: 1rem 1.2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #e0e7ff;
      box-shadow: inset 0 0 6px rgba(0,0,0,0.25);
      font-weight: 600;
      font-size: 1rem;
      user-select: text;
    }
    .post-item:hover {
      background: rgba(255 255 255 / 0.2);
      cursor: pointer;
    }
    .post-title {
      flex-grow: 1;
      padding-right: 1rem;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .post-actions button {
      background-color: transparent;
      border: none;
      color: #bbe1ff;
      font-weight: 700;
      cursor: pointer;
      margin-left: 0.8rem;
      font-size: 0.95rem;
      padding: 0.3rem 0.6rem;
      border-radius: 6px;
      transition: background-color 0.3s ease;
      user-select: none;
    }
    .post-actions button:hover,
    .post-actions button:focus {
      background-color: #005ea2;
      outline: none;
      color: #d3e9ff;
    }
    /* Scrollbar styling for .posts-list */
    .posts-list::-webkit-scrollbar {
      width: 8px;
    }
    .posts-list::-webkit-scrollbar-track {
      background: rgba(255 255 255 / 0.05);
      border-radius: 10px;
    }
    .posts-list::-webkit-scrollbar-thumb {
      background: #66a9ff;
      border-radius: 10px;
    }

    /* Image preview styling */
    .img-preview {
      margin-top: 10px;
      max-height: 140px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
      object-fit: contain;
      user-select: none;
    }

    /* Responsive */
    @media (max-width: 600px) {
      .dashboard-container {
        padding: 2rem 1.5rem 2.5rem;
      }
      h1 {
        font-size: 2.2rem;
        margin-bottom: 2rem;
      }
      button {
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <main class="dashboard-container" aria-label="Adminpanel Dashboard">
    <h1>Adminpanel</h1>

    <!-- Neue Beiträge erstellen -->
    <section class="section" aria-labelledby="createPostTitle">
      <h2 id="createPostTitle">Neuen Blogpost erstellen</h2>
      <form id="createPostForm" enctype="multipart/form-data" aria-describedby="formNote">
        <label for="newPostTitle">Titel</label>
        <input type="text" id="newPostTitle" name="title" placeholder="Titel des Beitrags" required autocomplete="off" />

        <label for="imageUpload">Beitragsbild hochladen</label>
        <input type="file" id="imageUpload" name="image" accept="image/*" />

        <img id="imgPreview" class="img-preview" src="#" alt="Bild Vorschau" style="display:none;" />

        <label for="newPostContent">Inhalt</label>
        <textarea id="newPostContent" name="content" placeholder="Inhalt des Beitrags" required></textarea>

        <button type="submit">Beitrag erstellen</button>
        <div id="formNote" style="margin-top:8px; font-size:0.9rem; color:#a0aec0;">Titel, Inhalt und optional ein Bild sind möglich.</div>
      </form>
    </section>

    <!-- Bestehende Beiträge -->
    <section class="section" aria-labelledby="managePostsTitle">
      <h2 id="managePostsTitle">Beiträge bearbeiten oder löschen</h2>
      <div class="posts-list" id="postsList" tabindex="0" aria-live="polite" aria-label="Liste der Blogbeiträge">
        <!-- Posts werden hier dynamisch eingefügt -->
      </div>
    </section>
  </main>

  <script>
    // Simulierte Blogposts mit IDs und Bild-URL
    let posts = [
      { id: 1, title: "Neue JavaScript Funktionen 2024", content: "Lerne die neuesten Features von JavaScript und wie du sie im Alltag anwendest.", image: "" },
      { id: 2, title: "Sicherheitspraktiken für Webentwickler", content: "Wichtige Tipps, um deine Webanwendungen vor Angriffen zu schützen.", image: "" },
      { id: 3, title: "Cloud Infrastruktur verstehen", content: "Grundlagen und Best Practices für eine zuverlässige Cloud-Architektur.", image: "" },
    ];

    const postsList = document.getElementById('postsList');
    const createPostForm = document.getElementById('createPostForm');
    const newPostTitle = document.getElementById('newPostTitle');
    const newPostContent = document.getElementById('newPostContent');
    const imageUpload = document.getElementById('imageUpload');
    const imgPreview = document.getElementById('imgPreview');

    // Bildvorschau Funktion
    imageUpload.addEventListener('change', () => {
      const file = imageUpload.files[0];
      if(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          imgPreview.src = e.target.result;
          imgPreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        imgPreview.src = '#';
        imgPreview.style.display = 'none';
      }
    });

    // Hilfsmethode zum Erstellen eines Post-Items DOM Elements mit Bild
    function createPostItem(post) {
      const item = document.createElement('div');
      item.className = 'post-item';
      item.setAttribute('data-id', post.id);

      const title = document.createElement('div');
      title.className = 'post-title';
      title.title = post.title;

      // If image available show thumbnail
      if(post.image) {
        const thumb = document.createElement('img');
        thumb.src = post.image;
        thumb.alt = `Beitragsbild: ${post.title}`;
        thumb.style.height = '40px';
        thumb.style.width = 'auto';
        thumb.style.objectFit = 'contain';
        thumb.style.borderRadius = '6px';
        thumb.style.marginRight = '0.8rem';
        thumb.style.flexShrink = '0';
        title.style.display = 'flex';
        title.style.alignItems = 'center';
        title.appendChild(thumb);
      }

      const titleText = document.createElement('span');
      titleText.textContent = post.title;
      title.appendChild(titleText);

      const actions = document.createElement('div');
      actions.className = 'post-actions';

      const editBtn = document.createElement('button');
      editBtn.type = 'button';
      editBtn.textContent = 'Bearbeiten';
      editBtn.title = `Beitrag "${post.title}" bearbeiten`;
      editBtn.addEventListener('click', () => openEditPost(post.id));

      const deleteBtn = document.createElement('button');
      deleteBtn.type = 'button';
      deleteBtn.textContent = 'Löschen';
      deleteBtn.title = `Beitrag "${post.title}" löschen`;
      deleteBtn.addEventListener('click', () => deletePost(post.id));

      actions.appendChild(editBtn);
      actions.appendChild(deleteBtn);

      item.appendChild(title);
      item.appendChild(actions);

      return item;
    }

    // Posts Liste rendern
    function renderPosts() {
      postsList.innerHTML = '';
      if(posts.length === 0) {
        const emptyMessage = document.createElement('p');
        emptyMessage.style.color = '#a0aec0';
        emptyMessage.textContent = 'Keine Blogbeiträge vorhanden.';
        postsList.appendChild(emptyMessage);
        return;
      }
      posts.forEach(post => {
        const item = createPostItem(post);
        postsList.appendChild(item);
      });
    }

    // Neuen Beitrag erstellen
    createPostForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const titleVal = newPostTitle.value.trim();
      const contentVal = newPostContent.value.trim();

      if (!titleVal || !contentVal) {
        alert('Bitte fülle Titel und Inhalt aus.');
        return;
      }

      let imageData = "";
      if (imageUpload.files.length > 0) {
        // Umwandlung in Base64 für Demo (lokale Nutzung)
        const file = imageUpload.files[0];
        const reader = new FileReader();
        reader.onload = () => {
          imageData = reader.result;
          addPost(titleVal, contentVal, imageData);
        };
        reader.readAsDataURL(file);
      } else {
        addPost(titleVal, contentVal, "");
      }
    });

    function addPost(title, content, imageData) {
      const maxId = posts.reduce((max, p) => p.id > max ? p.id : max, 0);
      const newPost = {
        id: maxId + 1,
        title: title,
        content: content,
        image: imageData
      };
      posts.push(newPost);
      renderPosts();
      createPostForm.reset();
      imgPreview.style.display = 'none';
      alert(`Beitrag "${newPost.title}" wurde erstellt.`);
    }

    // Beitrag löschen
    function deletePost(postId) {
      if(confirm('Möchtest du diesen Beitrag wirklich löschen?')) {
        posts = posts.filter(p => p.id !== postId);
        renderPosts();
      }
    }

    // Beitrag bearbeiten (Popup mit Bild)
    function openEditPost(postId) {
      const post = posts.find(p => p.id === postId);
      if(!post) return;

      const modalBg = document.createElement('div');
      modalBg.style.position = 'fixed';
      modalBg.style.top = '0';
      modalBg.style.left = '0';
      modalBg.style.width = '100vw';
      modalBg.style.height = '100vh';
      modalBg.style.backgroundColor = 'rgba(0,0,0,0.75)';
      modalBg.style.display = 'flex';
      modalBg.style.justifyContent = 'center';
      modalBg.style.alignItems = 'center';
      modalBg.style.zIndex = '10000';

      const modal = document.createElement('section');
      modal.style.background = 'rgba(255 255 255 / 0.08)';
      modal.style.backdropFilter = 'blur(12px)';
      modal.style.borderRadius = '14px';
      modal.style.border = '1.5px solid rgba(255 255 255 / 0.15)';
      modal.style.boxShadow = '0 16px 40px rgba(0, 0, 0, 0.7)';
      modal.style.padding = '2rem 2.5rem 2.5rem';
      modal.style.color = '#e0e7ff';
      modal.style.width = '90%';
      modal.style.maxWidth = '520px';
      modal.style.display = 'flex';
      modal.style.flexDirection = 'column';

      const title = document.createElement('h2');
      title.textContent = `Beitrag bearbeiten: "${post.title}"`;
      title.style.marginBottom = '1.5rem';
      title.style.userSelect = 'text';

      const labelTitle = document.createElement('label');
      labelTitle.setAttribute('for', 'editPostTitle');
      labelTitle.textContent = 'Titel';

      const inputTitle = document.createElement('input');
      inputTitle.type = 'text';
      inputTitle.id = 'editPostTitle';
      inputTitle.value = post.title;
      inputTitle.style.padding = '0.75rem 1rem';
      inputTitle.style.borderRadius = '8px';
      inputTitle.style.border = 'none';
      inputTitle.style.fontSize = '1rem';
      inputTitle.style.marginBottom = '1rem';
      inputTitle.style.backgroundColor = 'rgba(255,255,255,0.15)';
      inputTitle.style.color = '#eff3f7';
      inputTitle.style.outline = 'none';
      inputTitle.style.boxShadow = 'inset 0 0 6px rgba(0,0,0,0.3)';

      const labelImage = document.createElement('label');
      labelImage.setAttribute('for', 'editPostImage');
      labelImage.textContent = 'Beitragsbild ändern';

      const imageInput = document.createElement('input');
      imageInput.type = 'file';
      imageInput.id = 'editPostImage';
      imageInput.accept = 'image/*';
      imageInput.style.marginBottom = '1rem';

      const currentImage = document.createElement('img');
      currentImage.alt = 'Aktuelles Beitragsbild';
      currentImage.className = 'img-preview';
      currentImage.style.marginBottom = '1rem';
      if(post.image) {
        currentImage.src = post.image;
        currentImage.style.display = 'block';
      } else {
        currentImage.style.display = 'none';
      }

      imageInput.addEventListener('change', () => {
        const file = imageInput.files[0];
        if(file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            currentImage.src = e.target.result;
            currentImage.style.display = 'block';
          };
          reader.readAsDataURL(file);
        } else {
          if(post.image) {
            currentImage.src = post.image;
          } else {
            currentImage.style.display = 'none';
            currentImage.src = '';
          }
        }
      });

      const labelContent = document.createElement('label');
      labelContent.setAttribute('for', 'editPostContent');
      labelContent.textContent = 'Inhalt';

      const textareaContent = document.createElement('textarea');
      textareaContent.id = 'editPostContent';
      textareaContent.value = post.content;
      textareaContent.style.minHeight = '120px';
      textareaContent.style.padding = '0.75rem 1rem';
      textareaContent.style.borderRadius = '8px';
      textareaContent.style.border = 'none';
      textareaContent.style.fontSize = '1rem';
      textareaContent.style.backgroundColor = 'rgba(255,255,255,0.15)';
      textareaContent.style.color = '#eff3f7';
      textareaContent.style.outline = 'none';
      textareaContent.style.boxShadow = 'inset 0 0 6px rgba(0,0,0,0.3)';
      textareaContent.style.marginBottom = '1.5rem';

      const btnSave = document.createElement('button');
      btnSave.type = 'button';
      btnSave.textContent = 'Speichern';
      btnSave.style.backgroundColor = '#0078d7';
      btnSave.style.color = 'white';
      btnSave.style.border = 'none';
      btnSave.style.borderRadius = '12px';
      btnSave.style.padding = '0.85rem 0';
      btnSave.style.fontSize = '1.1rem';
      btnSave.style.fontWeight = '900';
      btnSave.style.cursor = 'pointer';
      btnSave.style.boxShadow = '0 8px 20px rgba(0, 120, 215, 0.6)';
      btnSave.style.transition = 'background-color 0.3s ease, box-shadow 0.3s ease';
      btnSave.style.userSelect = 'none';
      btnSave.style.marginBottom = '1rem';

      btnSave.addEventListener('mouseenter', () => {
        btnSave.style.backgroundColor = '#005ea2';
        btnSave.style.boxShadow = '0 12px 28px rgba(0, 94, 162, 0.85)';
      });
      btnSave.addEventListener('mouseleave', () => {
        btnSave.style.backgroundColor = '#0078d7';
        btnSave.style.boxShadow = '0 8px 20px rgba(0, 120, 215, 0.6)';
      });

      btnSave.addEventListener('click', () => {
        const updatedTitle = inputTitle.value.trim();
        const updatedContent = textareaContent.value.trim();
        if(!updatedTitle || !updatedContent) {
          alert('Bitte fülle Titel und Inhalt aus.');
          return;
        }
        // Update post image if changed
        if (imageInput.files.length > 0) {
          const file = imageInput.files[0];
          const reader = new FileReader();
          reader.onload = () => {
            post.image = reader.result;
            savePostData(post, updatedTitle, updatedContent);
          };
          reader.readAsDataURL(file);
        } else {
          savePostData(post, updatedTitle, updatedContent);
        }
      });

      function savePostData(post, title, content) {
        post.title = title;
        post.content = content;
        renderPosts();
        document.body.removeChild(modalBg);
        alert(`Beitrag "${title}" wurde aktualisiert.`);
      }

      const btnCancel = document.createElement('button');
      btnCancel.type = 'button';
      btnCancel.textContent = 'Abbrechen';
      btnCancel.style.backgroundColor = '#b71c1c';
      btnCancel.style.color = 'white';
      btnCancel.style.border = 'none';
      btnCancel.style.borderRadius = '12px';
      btnCancel.style.padding = '0.85rem 0';
      btnCancel.style.fontSize = '1.1rem';
      btnCancel.style.fontWeight = '900';
      btnCancel.style.cursor = 'pointer';
      btnCancel.style.boxShadow = '0 8px 20px rgba(183, 28, 28, 0.7)';
      btnCancel.style.transition = 'background-color 0.3s ease, box-shadow 0.3s ease';
      btnCancel.style.userSelect = 'none';

      btnCancel.addEventListener('mouseenter', () => {
        btnCancel.style.backgroundColor = '#7a1212';
        btnCancel.style.boxShadow = '0 12px 28px rgba(122, 18, 18, 0.85)';
      });
      btnCancel.addEventListener('mouseleave', () => {
        btnCancel.style.backgroundColor = '#b71c1c';
        btnCancel.style.boxShadow = '0 8px 20px rgba(183, 28, 28, 0.7)';
      });

      btnCancel.addEventListener('click', () => {
        document.body.removeChild(modalBg);
      });

      modal.appendChild(title);
      modal.appendChild(labelTitle);
      modal.appendChild(inputTitle);
      modal.appendChild(labelImage);
      modal.appendChild(imageInput);
      modal.appendChild(currentImage);
      modal.appendChild(labelContent);
      modal.appendChild(textareaContent);
      modal.appendChild(btnSave);
      modal.appendChild(btnCancel);
      modalBg.appendChild(modal);
      document.body.appendChild(modalBg);

      // Focus inside modal
      inputTitle.focus();

      // Close modal on background click
      modalBg.addEventListener('click', (e) => {
        if(e.target === modalBg) {
          document.body.removeChild(modalBg);
        }
      });

      // Trap tab key inside modal
      modalBg.addEventListener('keydown', (e) => {
        const focusableEls = modal.querySelectorAll('input,textarea,button');
        const firstEl = focusableEls[0];
        const lastEl = focusableEls[focusableEls.length -1];
        if(e.key === 'Tab') {
          if(e.shiftKey) { // shift + tab
            if(document.activeElement === firstEl) {
              e.preventDefault();
              lastEl.focus();
            }
          } else { // tab
            if(document.activeElement === lastEl) {
              e.preventDefault();
              firstEl.focus();
            }
          }
        }
        if(e.key === 'Escape') {
          e.preventDefault();
          document.body.removeChild(modalBg);
        }
      });
    }

    renderPosts();
  </script>
</body>
</html>

