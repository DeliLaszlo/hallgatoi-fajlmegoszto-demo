// ===== GLOBAL VARIABLES =====
let currentUser = null;
let currentSubject = null;
let currentRating = 0;

// Subject management
let availableSubjects = [
    {id: 'web-programozas', name: 'Web programozás', code: 'GKNB_INTM050'},
    {id: 'szoftvertechnologia', name: 'Szoftvertechnológia', code: 'GKNB_INTM045'},
    {id: 'halozatok', name: 'Hálózatok', code: 'GKNB_INTM040'},
    {id: 'algoritmusok', name: 'Algoritmusok és adatszerkezetek', code: 'GKNB_INTM025'},
    {id: 'operacios-rendszerek', name: 'Operációs rendszerek', code: 'GKNB_INTM035'},
    {id: 'matematika-1', name: 'Matematika I.', code: 'GKNB_MATM011'},
    {id: 'fizika', name: 'Fizika', code: 'GKNB_FIZM021'}
];

let selectedSubjects = ['informatikai-alapok', 'programozas-alapjai', 'adatbazisok'];

// Add default subjects to available list for proper management
let defaultSubjects = [
    {id: 'informatikai-alapok', name: 'Informatikai alapok', code: 'GKNB_INTM038'},
    {id: 'programozas-alapjai', name: 'Programozás alapjai', code: 'GKNB_INTM020'},
    {id: 'adatbazisok', name: 'Adatbázisok', code: 'GKNB_INTM030'}
];

// Combine all subjects
let allSubjects = [...defaultSubjects, ...availableSubjects];

// ===== INDEX PAGE FUNCTIONS =====

// Show different forms on index page
function showLoginForm() {
    hideAllForms();
    document.getElementById('loginForm').classList.add('active');
}

function showRegisterForm() {
    hideAllForms();
    document.getElementById('registerForm').classList.add('active');
}

function showForgotForm() {
    hideAllForms();
    document.getElementById('forgotForm').classList.add('active');
}

function hideAllForms() {
    document.querySelectorAll('.form-container').forEach(form => {
        form.classList.remove('active');
    });
}

// Login functionality
function login() {
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    
    if (!email || !password) {
        alert('Kérjük, töltse ki az összes mezőt!');
        return;
    }
    
    // Simulate login process
    if (password.length >= 6 && (email.includes('@') || email.length >= 3)) {
        // Extract username for demo
        currentUser = email.includes('@') ? email.split('@')[0] : email;
        alert('Sikeres bejelentkezés!');
        // Redirect to dashboard
        window.location.href = 'dashboard.php';
    } else {
        alert('Hibás felhasználónév/email vagy jelszó!');
    }
}

// Registration functionality
function register() {
    const username = document.getElementById('regUsername').value;
    const email = document.getElementById('regEmail').value;
    const password = document.getElementById('regPassword').value;
    const confirmPassword = document.getElementById('regConfirmPassword').value;
    
    if (!username || !email || !password || !confirmPassword) {
        alert('Kérjük, töltse ki az összes mezőt!');
        return;
    }
    
    if (password !== confirmPassword) {
        alert('A jelszavak nem egyeznek!');
        return;
    }
    
    if (password.length < 6) {
        alert('A jelszónak legalább 6 karakter hosszúnak kell lennie!');
        return;
    }
    
    if (!email.includes('@')) {
        alert('Érvénytelen email cím!');
        return;
    }
    
    // Simulate registration process
    alert('Sikeres regisztráció! Most bejelentkezhet a fiókjával.');
    showLoginForm();
}

// Reset password functionality
function resetPassword() {
    const email = document.getElementById('forgotEmail').value;
    
    if (!email) {
        alert('Kérjük, adja meg az email címét!');
        return;
    }
    
    if (!email.includes('@')) {
        alert('Érvénytelen email cím!');
        return;
    }
    
    // Simulate password reset process
    alert('Jelszó helyreállítási link elküldve a megadott email címre!');
    showLoginForm();
}

// ===== DASHBOARD PAGE FUNCTIONS =====

// Logout functionality
function logout() {
    if (confirm('Biztosan ki szeretne jelentkezni?')) {
        currentUser = null;
        window.location.href = 'index.php';
    }
}

// Open subject page
function openSubject(subjectId) {
    currentSubject = subjectId;
    // In a real app, this would pass the subject ID as a parameter
    window.location.href = `subject.php?subject=${subjectId}`;
}

// Show add subject modal
function showAddSubjectModal() {
    document.getElementById('addSubjectModal').style.display = 'block';
}

// Close add subject modal
function closeAddSubjectModal() {
    document.getElementById('addSubjectModal').style.display = 'none';
}

// Search subjects in modal
function searchSubjects() {
    const searchTerm = document.getElementById('subjectSearch').value.toLowerCase();
    const subjects = document.querySelectorAll('.available-subject');
    
    subjects.forEach(subject => {
        const title = subject.querySelector('h4').textContent.toLowerCase();
        const code = subject.querySelector('p').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || code.includes(searchTerm)) {
            subject.style.display = 'block';
        } else {
            subject.style.display = 'none';
        }
    });
}

// Select subject from modal
function selectSubject(subjectName, subjectCode, subjectId) {
    if (confirm(`Szeretné felvenni a(z) "${subjectName}" (${subjectCode}) tárgyat?`)) {
        // Add to selected subjects list FIRST
        selectedSubjects.push(subjectId);
        
        // Generate realistic stats for demo
        let fileCount, requestCount;
        
        // Give default subjects their original stats, others random
        if (subjectId === 'informatikai-alapok') {
            fileCount = 12; requestCount = 3;
        } else if (subjectId === 'programozas-alapjai') {
            fileCount = 8; requestCount = 1;
        } else if (subjectId === 'adatbazisok') {
            fileCount = 15; requestCount = 2;
        } else {
            fileCount = Math.floor(Math.random() * 18) + 5; // 5-22 files
            requestCount = Math.floor(Math.random() * 4) + 1; // 1-4 requests
        }
        
        // Create new subject card
        const subjectsGrid = document.querySelector('.subjects-grid');
        const addCard = document.querySelector('.add-subject-card');
        
        const newSubjectCard = document.createElement('div');
        newSubjectCard.className = 'subject-card';
        newSubjectCard.setAttribute('data-subject', subjectId);
        newSubjectCard.innerHTML = `
            <div class="subject-content" onclick="openSubject('${subjectId}')">
                <h3>${subjectName}</h3>
                <p class="subject-code">${subjectCode}</p>
                <div class="subject-stats">
                    <span class="file-count">${fileCount} fájl</span>
                    <span class="request-count">${requestCount} kérelem</span>
                </div>
            </div>
            <button class="delete-subject-btn" onclick="deleteSubject(event, '${subjectId}')">🗑️</button>
        `;
        
        // Insert before the add card
        subjectsGrid.insertBefore(newSubjectCard, addCard);
        
        // Update available subjects modal to remove the selected one
        updateAvailableSubjectsList();
        
        alert('Tárgy sikeresen felvéve!');
        closeAddSubjectModal();
    }
}

// Delete subject functionality
function deleteSubject(event, subjectId) {
    event.stopPropagation(); // Prevent opening subject
    
    if (confirm('Biztosan törölni szeretné ezt a tárgyat?')) {
        const subjectCard = document.querySelector(`[data-subject="${subjectId}"]`);
        if (subjectCard) {
            subjectCard.remove();
            
            // Remove from selected subjects
            const index = selectedSubjects.indexOf(subjectId);
            if (index > -1) {
                selectedSubjects.splice(index, 1);
            }
            
            // Update available subjects modal to show deleted subject again
            updateAvailableSubjectsList();
            
            alert('Tárgy sikeresen törölve!');
        }
    }
}

// Show dashboard sections
function showDashboardSection(sectionName) {
    // Hide all sections
    document.querySelectorAll('.dashboard-section').forEach(section => {
        section.classList.remove('active');
    });
    
    // Remove active class from all tabs
    document.querySelectorAll('.dashboard-header .nav-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Show selected section
    document.getElementById(`${sectionName}Section`).classList.add('active');
    
    // Add active class to clicked tab
    event.target.classList.add('active');
}

// Delete my file functionality
function deleteMyFile(event, fileName) {
    event.stopPropagation();
    
    if (confirm(`Biztosan törölni szeretné a "${fileName}" fájlt?`)) {
        const fileItem = event.target.closest('.my-file-item');
        if (fileItem) {
            fileItem.remove();
            alert('Fájl sikeresen törölve!');
        }
    }
}

// Go to file in subject page
function goToFileInSubject(subjectId, fileName) {
    // Navigate to subject page with file parameter
    window.location.href = `subject.php?subject=${subjectId}&file=${fileName}`;
}

// Update available subjects list based on selected subjects
function updateAvailableSubjectsList() {
    const availableContainer = document.getElementById('availableSubjects');
    if (!availableContainer) return;
    
    const searchInput = document.getElementById('subjectSearch');
    const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
    
    console.log('Selected subjects:', selectedSubjects); // Debug
    
    // Filter unselected subjects that match search
    const filteredSubjects = allSubjects.filter(subject => {
        const isNotSelected = !selectedSubjects.includes(subject.id);
        const matchesSearch = subject.name.toLowerCase().includes(searchTerm) || 
                             subject.code.toLowerCase().includes(searchTerm);
        return isNotSelected && matchesSearch;
    });
    
    console.log('Filtered subjects:', filteredSubjects); // Debug
    
    availableContainer.innerHTML = '';
    
    if (filteredSubjects.length === 0) {
        availableContainer.innerHTML = '<p class="no-results">Nincs talรกlat</p>';
        return;
    }
    
    filteredSubjects.forEach(subject => {
        const subjectDiv = document.createElement('div');
        subjectDiv.className = 'subject-item';
        subjectDiv.innerHTML = `
            <div class="subject-item-info">
                <h3>${subject.name}</h3>
                <p>${subject.code}</p>
            </div>
            <button class="btn btn-primary" onclick="selectSubject('${subject.name}', '${subject.code}', '${subject.id}')">
                Felvétel
            </button>
        `;
        availableContainer.appendChild(subjectDiv);
    });
}

// ===== SUBJECT PAGE FUNCTIONS =====

// Go back to dashboard
function goToDashboard() {
    window.location.href = 'dashboard.php';
}

// Show different sections on subject page
function showSection(sectionName) {
    // Hide all sections
    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });
    
    // Remove active class from all tabs
    document.querySelectorAll('.nav-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Show selected section
    document.getElementById(`${sectionName}Section`).classList.add('active');
    
    // Add active class to clicked tab
    event.target.classList.add('active');
}

// Search files functionality
function searchFiles(searchTerm) {
    const files = document.querySelectorAll('.file-item');
    const term = searchTerm.toLowerCase();
    
    files.forEach(file => {
        const title = file.querySelector('h3').textContent.toLowerCase();
        const fileName = file.querySelector('.file-name').textContent.toLowerCase();
        
        if (title.includes(term) || fileName.includes(term)) {
            file.style.display = 'flex';
        } else {
            file.style.display = 'none';
        }
    });
}

// Show file details modal
function showFileDetails(fileName) {
    // Sample file data - in a real app, this would come from database
    const fileData = {
        'ea1-jegyzet.pdf': {
            title: '1. Előadás jegyzet',
            uploader: 'Kiss János',
            uploadDate: '2024.09.15',
            fileSize: '2.4 MB',
            downloads: '47',
            rating: '4.2/5 (12 értékelés)',
            description: 'Az első előladás jegyzete, amely tartalmazza az informatikai alapfogalmakat és a számítógép felépítését.'
        },
        'gyak1-feladatok.docx': {
            title: '1. Gyakorlat feladatai',
            uploader: 'Nagy Péter',
            uploadDate: '2024.09.18',
            fileSize: '1.2 MB',
            downloads: '32',
            rating: '4.8/5 (8 értékelés)',
            description: 'Az első gyakorlat feladatai megoldásokkal és magyarázattal.'
        },
        'zh1-megoldas.pdf': {
            title: '1. ZH megoldás',
            uploader: 'Kovács Anna',
            uploadDate: '2024.09.22',
            fileSize: '3.1 MB',
            downloads: '28',
            rating: '3.6/5 (5 értékelés)',
            description: 'Az első zárthelyi dolgozat részletes megoldása és pontozása.'
        }
    };
    
    const file = fileData[fileName] || fileData['ea1-jegyzet.pdf'];
    
    // Fill modal with file data
    document.getElementById('fileDetailsTitle').textContent = file.title;
    document.getElementById('detailFileName').textContent = fileName;
    document.getElementById('detailUploader').textContent = file.uploader;
    document.getElementById('detailUploadDate').textContent = file.uploadDate;
    document.getElementById('detailFileSize').textContent = file.fileSize;
    document.getElementById('detailDownloads').textContent = file.downloads;
    document.getElementById('detailRating').textContent = file.rating;
    document.getElementById('detailDescription').textContent = file.description;
    
    // Reset star rating
    resetStarRating();
    
    // Show modal
    document.getElementById('fileDetailsModal').style.display = 'block';
}

// Close file details modal
function closeFileDetailsModal() {
    const modal = document.getElementById('fileDetailsModal');
    if (modal) {
        modal.style.display = 'none';
    }
    
    // ALWAYS reset everything on modal close
    currentRating = 0;
    window.ratingSubmitted = false;
    
    // Force reset all stars
    const stars = document.querySelectorAll('#fileDetailsModal .star');
    stars.forEach(star => {
        star.classList.remove('filled');
        star.textContent = '☆';
        star.style.color = '#e5e7eb';
    });
    
    const submitBtn = document.getElementById('submitRatingBtn');
    if (submitBtn) {
        submitBtn.style.display = 'none';
    }
}

// Rate file functionality
function rateFile(rating) {
    currentRating = rating;
    
    // Update ONLY the current modal's stars
    const modalStars = document.querySelectorAll('#fileDetailsModal .star');
    modalStars.forEach((star, index) => {
        if (index < rating) {
            star.classList.add('filled');
            star.textContent = '★';
            star.style.color = '#fbbf24';
        } else {
            star.classList.remove('filled');
            star.textContent = '☆';
            star.style.color = '#e5e7eb';
        }
    });
    
    // Show submit button
    const submitBtn = document.getElementById('submitRatingBtn');
    if (submitBtn) {
        submitBtn.style.display = 'inline-block';
    }
}

// Update star display
function updateStarDisplay() {
    const stars = document.querySelectorAll('.star');
    stars.forEach((star, index) => {
        if (index < currentRating) {
            star.classList.add('filled');
            star.textContent = '★';
            star.style.color = '#fbbf24';
        } else {
            star.classList.remove('filled');
            star.textContent = '☆';
            star.style.color = '#e5e7eb';
        }
    });
}

// Reset star rating
function resetStarRating() {
    currentRating = 0;
    const stars = document.querySelectorAll('#fileDetailsModal .star');
    stars.forEach(star => {
        star.classList.remove('filled');
        star.textContent = '☆';
        star.style.color = '#e5e7eb';
    });
    
    // Hide submit button
    const submitBtn = document.getElementById('submitRatingBtn');
    if (submitBtn) {
        submitBtn.style.display = 'none';
    }
}

// Submit rating
function submitRating() {
    if (currentRating === 0) {
        alert('Kérjük, válasszon ki egy értékelést!');
        return;
    }
    
    alert(`Köszönjük a ${currentRating} csillagos értékelést!`);
    
    // IMPORTANT: Keep stars visible, only hide submit button
    const submitBtn = document.getElementById('submitRatingBtn');
    if (submitBtn) {
        submitBtn.style.display = 'none';
    }
    
    // DON'T reset stars here - they stay visible until modal close
    
    // In a real app, this would send the rating to the server
    console.log(`Rating submitted: ${currentRating} stars`);
}

// Download file functionality
function downloadFile() {
    const fileName = document.getElementById('detailFileName').textContent;
    alert(`Letöltés indítva: ${fileName}`);
    // In a real app, this would trigger actual file download
}

// Add new request functionality
function addRequest() {
    const requestTitle = document.getElementById('newRequestTitle').value.trim();
    const requestText = document.getElementById('newRequestText').value.trim();
    
    if (!requestTitle) {
        alert('Kérjük, adjon meg egy címet a kérelemnek!');
        return;
    }
    
    if (!requestText) {
        alert('Kérjük, írja le a kérelmét!');
        return;
    }
    
    if (requestText.length < 10) {
        alert('A kérelem szövege túl rövid! Minimum 10 karakter szükséges.');
        return;
    }
    
    // Create new request element
    const requestsContainer = document.querySelector('.requests-container');
    const addRequestDiv = requestsContainer.querySelector('.add-request');
    
    const newRequest = document.createElement('div');
    newRequest.className = 'request-item';
    newRequest.onclick = () => fulfillRequest(newRequest);
    newRequest.innerHTML = `
        <div class="request-info">
            <h3>${requestTitle}</h3>
            <p class="request-description">${requestText}</p>
            <p class="request-meta">Kérte: Te • ${new Date().toLocaleDateString('hu-HU')}</p>
        </div>
        <div class="request-status">
            <span class="status-badge pending">Várakozó</span>
        </div>
    `;
    
    // Insert before the add request form
    requestsContainer.insertBefore(newRequest, addRequestDiv);
    
    // Clear the inputs
    document.getElementById('newRequestTitle').value = '';
    document.getElementById('newRequestText').value = '';
    
    alert('Kérelem sikeresen hozzáadva!');
}

// Fulfill request functionality
function fulfillRequest(requestElement) {
    const status = requestElement.querySelector('.status-badge');
    if (status.classList.contains('fulfilled')) {
        // If already fulfilled, show the fulfilled file
        const requestTitle = requestElement.querySelector('h3').textContent;
        let fileName = 'sample-file.pdf';
        
        // Map request titles to file names for demo
        if (requestTitle.includes('ZH') || requestTitle.includes('zárthelyi')) {
            fileName = 'zh-megoldas-teljes.pdf';
        } else if (requestTitle.includes('jegyzet')) {
            fileName = 'ea3-jegyzet.pdf';
        }
        
        showFulfilledRequestFile(fileName);
        return;
    }
    
    if (confirm('Szeretne fájlt feltölteni ehhez a kérelemhez?')) {
        // Store current request for later fulfillment
        window.currentFulfillmentRequest = requestElement;
        showUploadFileModal();
    }
}

// Show upload file modal
function showUploadFileModal() {
    document.getElementById('uploadFileModal').style.display = 'block';
}

// Close upload file modal
function closeUploadFileModal() {
    document.getElementById('uploadFileModal').style.display = 'none';
    // Clear form
    document.getElementById('fileTitle').value = '';
    document.getElementById('fileDescription').value = '';
    document.getElementById('fileUpload').value = '';
    const subjectSelect = document.getElementById('fileSubject');
    if (subjectSelect) {
        subjectSelect.value = '';
    }
}

// Upload file functionality
function uploadFile() {
    const title = document.getElementById('fileTitle').value.trim();
    const description = document.getElementById('fileDescription').value.trim();
    const fileInput = document.getElementById('fileUpload');
    const subjectSelect = document.getElementById('fileSubject');
    
    if (!title) {
        alert('Kérjük, adjon meg egy címet a fájlnak!');
        return;
    }
    
    if (!fileInput.files.length) {
        alert('Kérjük, válasszon ki egy fájlt!');
        return;
    }
    
    // If we're on dashboard, check subject selection
    if (subjectSelect && !subjectSelect.value) {
        alert('Kérjük, válasszon ki egy tárgyat!');
        return;
    }
    
    const fileName = fileInput.files[0].name;
    const fileSize = (fileInput.files[0].size / (1024 * 1024)).toFixed(1) + ' MB';
    
    // Simulate file upload process
    alert('Fájl feltöltése megkezdve...');
    
    setTimeout(() => {
        // If we're on the subject page, add to files list
        const filesGrid = document.querySelector('.files-grid');
        if (filesGrid) {
            const newFileItem = document.createElement('div');
            newFileItem.className = 'file-item';
            newFileItem.onclick = () => showFileDetails(fileName);
            
            const fileIcon = fileName.toLowerCase().includes('.pdf') ? '📄' : 
                            fileName.toLowerCase().includes('.doc') ? '📝' : '📋';
            
            newFileItem.innerHTML = `
                <div class="file-icon">${fileIcon}</div>
                <div class="file-info">
                    <h3>${title}</h3>
                    <p class="file-name">${fileName}</p>
                    <p class="file-meta">Feltöltő: Te • ${new Date().toLocaleDateString('hu-HU')}</p>
                </div>
                <div class="file-actions">
                    <div class="rating">
                        <span class="stars">☆☆☆☆☆</span>
                        <span class="rating-text">(Új)</span>
                    </div>
                    <button class="btn btn-download">Letöltés</button>
                </div>
            `;
            
            filesGrid.appendChild(newFileItem);
        }
        
        // If we're on dashboard My Files section, add there too
        const myFilesGrid = document.querySelector('.my-files-grid');
        if (myFilesGrid && subjectSelect) {
            const subjectText = subjectSelect.options[subjectSelect.selectedIndex].text;
            const newMyFile = document.createElement('div');
            newMyFile.className = 'my-file-item';
            
            const fileIcon = fileName.toLowerCase().includes('.pdf') ? '📄' : 
                            fileName.toLowerCase().includes('.doc') ? '📝' : '📋';
            
            newMyFile.innerHTML = `
                <div class="file-icon">${fileIcon}</div>
                <div class="file-info">
                    <h3>${title}</h3>
                    <p class="file-name">${fileName}</p>
                    <p class="file-meta">Feltöltve: ${new Date().toLocaleDateString('hu-HU')} • ${subjectText}</p>
                </div>
                <div class="file-actions">
                    <div class="rating">
                        <span class="stars">☆☆☆☆☆</span>
                        <span class="rating-text">(Új)</span>
                    </div>
                    <div class="download-count">
                        <span>0 letöltés</span>
                    </div>
                    <button class="btn btn-secondary btn-small" onclick="deleteMyFile(event, '${fileName}')">Törlés</button>
                </div>
            `;
            
            myFilesGrid.appendChild(newMyFile);
        }
        
        // If this was for fulfilling a request, mark it as fulfilled
        if (window.currentFulfillmentRequest) {
            const status = window.currentFulfillmentRequest.querySelector('.status-badge');
            status.textContent = 'Teljesítve';
            status.className = 'status-badge fulfilled';
            
            // Make the request clickable to show file details
            window.currentFulfillmentRequest.onclick = () => showFulfilledRequestFile(fileName);
            
            // Clear the reference
            window.currentFulfillmentRequest = null;
        }
        
        closeUploadFileModal();
        alert('Fájl sikeresen feltöltve!');
    }, 2000);
}

// ===== CHAT FUNCTIONALITY =====

// Send message functionality
function sendMessage() {
    const input = document.getElementById('chatInput');
    const messageText = input.value.trim();
    
    if (!messageText) {
        return;
    }
    
    // Create new message element
    const messagesContainer = document.getElementById('chatMessages');
    const newMessage = document.createElement('div');
    newMessage.className = 'message own';
    
    const now = new Date();
    const timeString = now.getHours().toString().padStart(2, '0') + ':' + 
                     now.getMinutes().toString().padStart(2, '0');
    
    newMessage.innerHTML = `
        <div class="message-author">Te</div>
        <div class="message-content">${messageText}</div>
        <div class="message-time">${timeString}</div>
    `;
    
    messagesContainer.appendChild(newMessage);
    
    // Scroll to bottom
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
    
    // Clear input
    input.value = '';
    
    // Simulate response after a delay (for demo purposes)
    setTimeout(() => {
        simulateResponse();
    }, 1000 + Math.random() * 2000);
}

// Delete my request functionality  
function deleteMyRequest(event, requestElement) {
    event.stopPropagation();
    
    if (confirm('Biztosan törölni szeretné ezt a kérelmet?')) {
        requestElement.remove();
        alert('Kérelem sikeresen törölve!');
    }
}

// Show my file details (dashboard version - no rating)
function showMyFileDetails(fileName, subject) {
    // Sample my file data
    const myFileData = {
        'ea2-jegyzet.pdf': {
            title: '2. Előadás jegyzet',
            subject: 'Informatikai alapok',
            uploadDate: '2024.09.20',
            fileSize: '2.1 MB',
            downloads: '23',
            rating: '4.9/5 (8 értékelés)',
            description: 'Az általam készített jegyzet a második előadás anyagából.'
        },
        'gyak3-megoldas.docx': {
            title: '3. Gyakorlat megoldás',
            subject: 'Programozás alapjai',
            uploadDate: '2024.09.22',
            fileSize: '1.8 MB',
            downloads: '18',
            rating: '4.1/5 (5 értékelés)',
            description: 'A harmadik gyakorlat feladatainak részletes megoldása.'
        }
    };
    
    const file = myFileData[fileName] || myFileData['ea2-jegyzet.pdf'];
    
    // Fill modal with file data
    document.getElementById('myFileDetailsTitle').textContent = file.title;
    document.getElementById('myDetailFileName').textContent = fileName;
    document.getElementById('myDetailSubject').textContent = file.subject;
    document.getElementById('myDetailUploadDate').textContent = file.uploadDate;
    document.getElementById('myDetailFileSize').textContent = file.fileSize;
    document.getElementById('myDetailDownloads').textContent = file.downloads;
    document.getElementById('myDetailRating').textContent = file.rating;
    document.getElementById('myDetailDescription').textContent = file.description;
    
    // Store current file for deletion
    window.currentMyFileName = fileName;
    
    // Show modal
    document.getElementById('myFileDetailsModal').style.display = 'block';
}

// Close my file details modal
function closeMyFileDetailsModal() {
    document.getElementById('myFileDetailsModal').style.display = 'none';
    window.currentMyFileName = null;
}

// Download my file
function downloadMyFile() {
    const fileName = window.currentMyFileName;
    alert(`Letöltés indítva: ${fileName}`);
}

// Delete my file from modal
function deleteMyFileFromModal() {
    if (!window.currentMyFileName) return;
    
    if (confirm(`Biztosan törölni szeretné a "${window.currentMyFileName}" fájlt?`)) {
        // Find and remove the file item from the dashboard
        const myFilesGrid = document.querySelector('.my-files-grid');
        if (myFilesGrid) {
            const fileItems = myFilesGrid.querySelectorAll('.my-file-item');
            fileItems.forEach(item => {
                const fileName = item.querySelector('.file-name').textContent;
                if (fileName === window.currentMyFileName) {
                    item.remove();
                }
            });
        }
        
        closeMyFileDetailsModal();
        alert('Fájl sikeresen törölve!');
    }
}

// Show fulfilled request file details
function showFulfilledRequestFile(fileName) {
    // Sample file data for fulfilled requests
    const fulfilledFiles = {
        'adatbazis-tervezes.pdf': {
            title: 'Adatbázis tervezés segédlet',
            uploader: 'Dr. Nagy Péter',
            uploadDate: '2024.09.21',
            fileSize: '5.2 MB',
            downloads: '67',
            rating: '4.7/5 (15 értékelés)',
            description: 'Részletes segédanyag az adatbázis tervezéshez, példákkal és gyakorlatokkal.'
        },
        'recursio-peldak.pdf': {
            title: 'Rekurzió gyakorló feladatok',
            uploader: 'Kovács András',
            uploadDate: '2024.09.19',
            fileSize: '3.8 MB',
            downloads: '89',
            rating: '4.5/5 (23 értékelés)',
            description: 'Haladó rekurzív algoritmusok és gyakorló feladatok megoldásokkal.'
        }
    };
    
    const file = fulfilledFiles[fileName] || fulfilledFiles['adatbazis-tervezes.pdf'];
    
    // Fill modal with file data
    document.getElementById('fileDetailsTitle').textContent = file.title;
    document.getElementById('detailFileName').textContent = fileName;
    document.getElementById('detailUploader').textContent = file.uploader;
    document.getElementById('detailUploadDate').textContent = file.uploadDate;
    document.getElementById('detailFileSize').textContent = file.fileSize;
    document.getElementById('detailDownloads').textContent = file.downloads;
    document.getElementById('detailRating').textContent = file.rating;
    document.getElementById('detailDescription').textContent = file.description;
    
    // DON'T auto-reset stars when opening modal
    // Only reset on explicit modal close
    
    // Add event listener to modal to reset on any interaction
    const modal = document.getElementById('fileDetailsModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                setTimeout(forceResetStars, 10);
            }
        });
    }
    
    // Show modal
    document.getElementById('fileDetailsModal').style.display = 'block';
    
    // Final aggressive reset after modal is fully shown
    setTimeout(forceResetStars, 500);
}

// Handle chat input keypress
function handleChatKeyPress(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
}

// Simulate chat response
function simulateResponse() {
    const responses = [
        'Érdekes kérdés! Meg fogom nézni.',
        'Igen, nekem is hasonló problémám volt.',
        'Talán a 3. előadás anyagában találsz választ.',
        'Köszi az info!',
        'Tudok segíteni, ha még kell.',
        'A tanár ezt magyarázta az órán.',
        'Én is erre lennék kíváncsi.',
        'Megpróbálom megoldani és visszaírok.'
    ];
    
    const names = ['Kiss János', 'Nagy Péter', 'Kovács Anna', 'Szabó Márk', 'Tóth Eszter'];
    
    const messagesContainer = document.getElementById('chatMessages');
    const newMessage = document.createElement('div');
    newMessage.className = 'message';
    
    const now = new Date();
    const timeString = now.getHours().toString().padStart(2, '0') + ':' + 
                     now.getMinutes().toString().padStart(2, '0');
    
    const randomResponse = responses[Math.floor(Math.random() * responses.length)];
    const randomName = names[Math.floor(Math.random() * names.length)];
    
    newMessage.innerHTML = `
        <div class="message-author">${randomName}</div>
        <div class="message-content">${randomResponse}</div>
        <div class="message-time">${timeString}</div>
    `;
    
    messagesContainer.appendChild(newMessage);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// ===== EVENT LISTENERS =====

// Close modals when clicking outside
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            // If it's the file details modal, use the proper close function
            if (modal.id === 'fileDetailsModal') {
                closeFileDetailsModal();
            } else {
                modal.style.display = 'none';
            }
        }
    });
}

// Close modals with ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const fileDetailsModal = document.getElementById('fileDetailsModal');
        if (fileDetailsModal && fileDetailsModal.style.display === 'block') {
            closeFileDetailsModal();
        }
        
        // Close other modals normally
        const otherModals = document.querySelectorAll('.modal:not(#fileDetailsModal)');
        otherModals.forEach(modal => {
            if (modal.style.display === 'block') {
                modal.style.display = 'none';
            }
        });
    }
});



// Fix fulfilled request file display on dashboard  
function showFulfilledRequestFile(fileName) {
    // Check if we're on dashboard page
    const isDashboard = document.getElementById('myFileDetailsModal');
    
    if (isDashboard) {
        // Use the fileDetailsModal from subject.php if available
        const fileDetailsModal = document.getElementById('fileDetailsModal');
        if (!fileDetailsModal) {
            alert('Fájl részletek megtekintése csak a tárgy oldalon érhető el.');
            return;
        }
    }
    
    // Sample file data for fulfilled requests
    const fulfilledFiles = {
        'adatbazis-tervezes.pdf': {
            title: 'Adatbázis tervezés segédlet',
            uploader: 'Dr. Nagy Péter',
            uploadDate: '2024.09.21',
            fileSize: '5.2 MB',
            downloads: '67',
            rating: '4.7/5 (15 értékelés)',
            description: 'Részletes segédanyag az adatbázis tervezéshez, példákkal és gyakorlatokkal.'
        },
        'recursio-peldak.pdf': {
            title: 'Rekurzió gyakorló feladatok',
            uploader: 'Kovács András',
            uploadDate: '2024.09.19',
            fileSize: '3.8 MB',
            downloads: '89',
            rating: '4.5/5 (23 értékelés)',
            description: 'Haladó rekurzív algoritmusok és gyakorló feladatok megoldásokkal.'
        }
    };
    
    const file = fulfilledFiles[fileName] || fulfilledFiles['adatbazis-tervezes.pdf'];
    
    // Fill modal with file data
    document.getElementById('fileDetailsTitle').textContent = file.title;
    document.getElementById('detailFileName').textContent = fileName;
    document.getElementById('detailUploader').textContent = file.uploader;
    document.getElementById('detailUploadDate').textContent = file.uploadDate;
    document.getElementById('detailFileSize').textContent = file.fileSize;
    document.getElementById('detailDownloads').textContent = file.downloads;
    document.getElementById('detailRating').textContent = file.rating;
    document.getElementById('detailDescription').textContent = file.description;
    
    // Reset star rating
    resetStarRating();
    
    // Show modal
    document.getElementById('fileDetailsModal').style.display = 'block';
}

// Initialize page when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effects to star rating
    const stars = document.querySelectorAll('.star');
    stars.forEach((star, index) => {
        star.addEventListener('mouseenter', function() {
            highlightStars(index + 1);
        });
        
        star.addEventListener('mouseleave', function() {
            updateStarDisplay();
        });
    });
    
    // Auto-scroll chat to bottom if exists
    const chatMessages = document.getElementById('chatMessages');
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Focus on first input if on index page
    const firstInput = document.querySelector('#loginForm input');
    if (firstInput) {
        firstInput.focus();
    }
    
    // Initialize available subjects list if on dashboard
    updateAvailableSubjectsList();
    
    // Add Enter key support for login forms
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        const inputs = loginForm.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    login();
                }
            });
        });
    }
    
    // Add Enter key support for registration form
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        const inputs = registerForm.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    register();
                }
            });
        });
    }
    
    // Add Enter key support for forgot password form
    const forgotForm = document.getElementById('forgotForm');
    if (forgotForm) {
        const input = forgotForm.querySelector('input');
        if (input) {
            input.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    resetPassword();
                }
            });
        }
    }
});

// Helper function to highlight stars on hover
function highlightStars(count) {
    const stars = document.querySelectorAll('.star');
    stars.forEach((star, index) => {
        if (index < count) {
            star.textContent = '★';
            star.style.color = '#fbbf24';
        } else {
            star.textContent = '☆';
            star.style.color = '#e5e7eb';
        }
    });
}

// ===== UTILITY FUNCTIONS =====

// Format date for display
function formatDate(date) {
    return date.toLocaleDateString('hu-HU', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    });
}

// Validate email format
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Generate random ID
function generateId() {
    return Date.now().toString(36) + Math.random().toString(36).substr(2);
}

// Show notification (for future use)
function showNotification(message, type = 'info') {
    // This could be enhanced with a proper notification system
    alert(message);
}

// Escape HTML to prevent XSS (for future use with real data)
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Fix fulfilled request file display on dashboard  
function showFulfilledRequestFile(fileName) {
    console.log('showFulfilledRequestFile called with:', fileName); // Debug
    
    // Sample file data for fulfilled requests
    const fulfilledFiles = {
        'adatbazis-tervezes.pdf': {
            title: 'Adatbázis tervezés segédlet',
            uploader: 'Dr. Nagy Péter',
            uploadDate: '2024.09.21',
            fileSize: '5.2 MB',
            downloads: '67',
            rating: '4.7/5 (15 értékelés)',
            description: 'Részletes segédanyag az adatbázis tervezéshez, példákkal és gyakorlatokkal.'
        },
        'recursio-peldak.pdf': {
            title: 'Rekurzió gyakorló feladatok',
            uploader: 'Kovács András',
            uploadDate: '2024.09.19',
            fileSize: '3.8 MB',
            downloads: '89',
            rating: '4.5/5 (23 értékelés)',
            description: 'Haladó rekurzív algoritmusok és gyakorló feladatok megoldásokkal.'
        }
    };
    
    const file = fulfilledFiles[fileName] || fulfilledFiles['adatbazis-tervezes.pdf'];
    
    // Check if fileDetailsModal exists 
    const fileDetailsModal = document.getElementById('fileDetailsModal');
    console.log('fileDetailsModal found:', !!fileDetailsModal); // Debug
    
    if (!fileDetailsModal) {
        console.log('Modal not found, showing alert'); // Debug
        alert('A fájl részletek modal nem található! Ellenőrizze, hogy a dashboard.php tartalmazza-e.');
        return;
    }
    
    // Fill modal with file data
    const titleEl = document.getElementById('fileDetailsTitle');
    const fileNameEl = document.getElementById('detailFileName');
    const uploaderEl = document.getElementById('detailUploader');
    const uploadDateEl = document.getElementById('detailUploadDate');
    const fileSizeEl = document.getElementById('detailFileSize');
    const downloadsEl = document.getElementById('detailDownloads');
    const ratingEl = document.getElementById('detailRating');
    const descriptionEl = document.getElementById('detailDescription');
    
    if (titleEl) titleEl.textContent = file.title;
    if (fileNameEl) fileNameEl.textContent = fileName;
    if (uploaderEl) uploaderEl.textContent = file.uploader;
    if (uploadDateEl) uploadDateEl.textContent = file.uploadDate;
    if (fileSizeEl) fileSizeEl.textContent = file.fileSize;
    if (downloadsEl) downloadsEl.textContent = file.downloads;
    if (ratingEl) ratingEl.textContent = file.rating;
    if (descriptionEl) descriptionEl.textContent = file.description;
    
    console.log('Showing modal'); // Debug
    // Show modal
    fileDetailsModal.style.display = 'block';
}

// Close file details modal (dashboard version)
function closeFileDetailsModal() {
    const fileDetailsModal = document.getElementById('fileDetailsModal');
    if (fileDetailsModal) {
        fileDetailsModal.style.display = 'none';
        
        // RESET stars only when closing modal with Bezárás button
        currentRating = 0;
        const modalStars = document.querySelectorAll('#fileDetailsModal .star');
        modalStars.forEach(star => {
            star.classList.remove('filled');
            star.textContent = '☆';
            star.style.color = '#e5e7eb';
        });
        
        const submitBtn = document.getElementById('submitRatingBtn');
        if (submitBtn) {
            submitBtn.style.display = 'none';
        }
    }
}

// Search subjects function
function searchSubjects() {
    updateAvailableSubjectsList();
}

// Rating functions for dashboard modal

function rateFile(rating) {
    currentRating = rating;
    const stars = document.querySelectorAll('.star');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.add('filled');
            star.textContent = '★';
        } else {
            star.classList.remove('filled');
            star.textContent = '☆';
        }
    });
    document.getElementById('submitRatingBtn').style.display = 'inline-block';
}

function resetStarRating() {
    currentRating = 0;
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
        star.classList.remove('filled');
        star.textContent = '☆';
    });
    const submitBtn = document.getElementById('submitRatingBtn');
    if (submitBtn) {
        submitBtn.style.display = 'none';
    }
}

function submitRating() {
    if (currentRating > 0) {
        alert(`Értékelés elküldve: ${currentRating} csillag`);
        
        // DON'T reset stars after submission - keep them visible!
        // Only hide the submit button
        document.getElementById('submitRatingBtn').style.display = 'none';
    }
}

function downloadFile() {
    alert('Fájl letöltése megkezdődött!');
}