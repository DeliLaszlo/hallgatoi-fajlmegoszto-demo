<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tárgy - Hallgatói Fájlmegosztó</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="subject-container">
        <nav class="subject-navbar">
            <div class="nav-left">
                <button class="btn btn-back" onclick="goToDashboard()">← Vissza a tárgyaimhoz</button>
                <h1 id="subjectTitle">Informatikai alapok</h1>
            </div>
            <div class="nav-tabs">
                <button class="nav-tab active" onclick="showSection('files')">Fájlok</button>
                <button class="nav-tab" onclick="showSection('requests')">Fájlkérelmek</button>
                <button class="nav-tab" onclick="showSection('chat')">Chatszoba</button>
            </div>
        </nav>
        
        <main class="subject-main">
            <!-- Files Section -->
            <div id="filesSection" class="section active">
                <div class="section-header">
                    <h2>Feltöltött fájlok</h2>
                    <div class="header-controls">
                        <div class="search-bar">
                            <input type="text" placeholder="Keresés a fájlok között..." oninput="searchFiles(this.value)">
                        </div>
                        <button class="btn btn-primary" onclick="showUploadFileModal()">Új fájl feltöltése</button>
                    </div>
                </div>
                
                <div class="files-grid">
                    <div class="file-item" onclick="showFileDetails('ea1-jegyzet.pdf')">
                        <div class="file-icon">📄</div>
                        <div class="file-info">
                            <h3>1. Előadás jegyzet</h3>
                            <p class="file-name">ea1-jegyzet.pdf</p>
                            <p class="file-meta">Feltöltő: Kiss János • 2024.09.15</p>
                        </div>
                        <div class="file-actions">
                            <div class="rating">
                                <span class="stars">★★★★☆</span>
                                <span class="rating-text">(4.2/5)</span>
                            </div>
                            <button class="btn btn-download">Letöltés</button>
                        </div>
                    </div>
                    
                    <div class="file-item" onclick="showFileDetails('gyak1-feladatok.docx')">
                        <div class="file-icon">📝</div>
                        <div class="file-info">
                            <h3>1. Gyakorlat feladatai</h3>
                            <p class="file-name">gyak1-feladatok.docx</p>
                            <p class="file-meta">Feltöltő: Nagy Péter • 2024.09.18</p>
                        </div>
                        <div class="file-actions">
                            <div class="rating">
                                <span class="stars">★★★★★</span>
                                <span class="rating-text">(4.8/5)</span>
                            </div>
                            <button class="btn btn-download">Letöltés</button>
                        </div>
                    </div>
                    
                    <div class="file-item" onclick="showFileDetails('zh1-megoldas.pdf')">
                        <div class="file-icon">📋</div>
                        <div class="file-info">
                            <h3>1. ZH megoldás</h3>
                            <p class="file-name">zh1-megoldas.pdf</p>
                            <p class="file-meta">Feltöltő: Kovács Anna • 2024.09.22</p>
                        </div>
                        <div class="file-actions">
                            <div class="rating">
                                <span class="stars">★★★☆☆</span>
                                <span class="rating-text">(3.6/5)</span>
                            </div>
                            <button class="btn btn-download">Letöltés</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Requests Section -->
            <div id="requestsSection" class="section">
                <div class="section-header">
                    <h2>Fájlkérelmek</h2>
                </div>
                
                <div class="requests-container">
                    <div class="request-item" onclick="fulfillRequest(this)">
                        <div class="request-info">
                            <h3>2. ZH megoldás kerestetik</h3>
                            <p class="request-description">Sziasztok! Van valakinek a második zárthelyi megoldása? Szeretném összehasonlítani az enyémmel.</p>
                            <p class="request-meta">Kérte: Szabó Márk • 2024.09.25</p>
                        </div>
                        <div class="request-status">
                            <span class="status-badge pending">Várakozó</span>
                        </div>
                    </div>
                    
                    <div class="request-item" onclick="fulfillRequest(this)">
                        <div class="request-info">
                            <h3>3. Előadás jegyzet</h3>
                            <p class="request-description">Hiányzott az óráról, kellene a jegyzet a 3. előadásból.</p>
                            <p class="request-meta">Kérte: Tóth Eszter • 2024.09.23</p>
                        </div>
                        <div class="request-status">
                            <span class="status-badge fulfilled">Teljesítve</span>
                        </div>
                    </div>
                    
                    <div class="add-request">
                        <h3>Új kérelem hozzáadása</h3>
                        <input type="text" id="newRequestTitle" placeholder="Kérelem címe..." style="width: 100%; margin-bottom: 12px; padding: 10px; border: 2px solid #e5e7eb; border-radius: 8px;">
                        <textarea id="newRequestText" placeholder="Írja le, milyen fájlra van szüksége..."></textarea>
                        <button class="btn btn-primary" onclick="addRequest()">Kérelem hozzáadása</button>
                    </div>
                </div>
            </div>
            
            <!-- Chat Section -->
            <div id="chatSection" class="section">
                <div class="section-header">
                    <h2>Chatszobák</h2>
                    <div class="header-controls">
                        <button class="btn btn-primary" onclick="showCreateChatroomModal()">Új chatszoba létrehozása</button>
                    </div>
                </div>
                
                <div class="files-grid" id="chatroomsList">
                    <div class="file-item" onclick="joinChatroom('general')">
                        <div class="file-info">
                            <h3>Általános beszélgetés</h3>
                            <p class="file-name">Általános beszélgetés a tárgyról és házi feladatokról</p>
                            <p class="file-meta">12 követő</p>
                        </div>
                        <div class="file-actions">
                            <button class="btn btn-secondary following" onclick="event.stopPropagation(); toggleChatroomFollow('general', this)">
                                ✓ Követve
                            </button>
                        </div>
                    </div>
                    
                    <div class="file-item" onclick="joinChatroom('homework-help')">
                        <div class="file-info">
                            <h3>Házi feladat segítség</h3>
                            <p class="file-name">Segítség kérése és adása a házi feladatokhoz</p>
                            <p class="file-meta">8 követő</p>
                        </div>
                        <div class="file-actions">
                            <button class="btn btn-secondary" onclick="event.stopPropagation(); toggleChatroomFollow('homework-help', this)">
                                + Követés
                            </button>
                        </div>
                    </div>
                    
                    <div class="file-item" onclick="joinChatroom('exam-prep')">
                        <div class="file-info">
                            <h3>Vizsgafelkészülés</h3>
                            <p class="file-name">Közös tanulás és vizsgafelkészülés</p>
                            <p class="file-meta">15 követő</p>
                        </div>
                        <div class="file-actions">
                            <button class="btn btn-secondary following" onclick="event.stopPropagation(); toggleChatroomFollow('exam-prep', this)">
                                ✓ Követve
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- File Details Modal -->
    <div id="fileDetailsModal" class="modal">
        <div class="modal-content large">
            <div class="modal-header">
                <h2 id="fileDetailsTitle">Fájl részletei</h2>
                <span class="close" onclick="closeFileDetailsModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="file-details-grid">
                    <div class="file-preview">
                        <div class="preview-placeholder">
                            <span class="preview-icon">📄</span>
                            <p>Fájl előnézet</p>
                        </div>
                    </div>
                    
                    <div class="file-metadata">
                        <h3>Információk</h3>
                        <table class="details-table">
                            <tr>
                                <td><strong>Fájlnév:</strong></td>
                                <td id="detailFileName">ea1-jegyzet.pdf</td>
                            </tr>
                            <tr>
                                <td><strong>Feltöltő:</strong></td>
                                <td id="detailUploader">Kiss János</td>
                            </tr>
                            <tr>
                                <td><strong>Feltöltés dátuma:</strong></td>
                                <td id="detailUploadDate">2024.09.15</td>
                            </tr>
                            <tr>
                                <td><strong>Fájlméret:</strong></td>
                                <td id="detailFileSize">2.4 MB</td>
                            </tr>
                            <tr>
                                <td><strong>Letöltések:</strong></td>
                                <td id="detailDownloads">47</td>
                            </tr>
                            <tr>
                                <td><strong>Értékelés:</strong></td>
                                <td id="detailRating">4.2/5 (12 értékelés)</td>
                            </tr>
                        </table>
                        
                        <div class="description">
                            <h4>Leírás</h4>
                            <p id="detailDescription">Az első előadás jegyzete, amely tartalmazza az informatikai alapfogalmakat és a számítógép felépítését.</p>
                        </div>
                        
                        <div class="rating-section">
                            <h4>Értékelés</h4>
                            <div class="star-rating">
                                <span class="star" onclick="rateFile(1)">☆</span>
                                <span class="star" onclick="rateFile(2)">☆</span>
                                <span class="star" onclick="rateFile(3)">☆</span>
                                <span class="star" onclick="rateFile(4)">☆</span>
                                <span class="star" onclick="rateFile(5)">☆</span>
                            </div>
                            <button class="btn btn-secondary btn-small" onclick="submitRating()" id="submitRatingBtn" style="margin-top: 10px; display: none;">Értékelés elküldése</button>
                        </div>
                        
                        <div class="modal-actions">
                            <button class="btn btn-primary" onclick="downloadFile()">Letöltés</button>
                            <button class="btn btn-secondary" onclick="closeFileDetailsModal()">Bezárás</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Upload File Modal -->
    <div id="uploadFileModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Új fájl feltöltése</h2>
                <span class="close" onclick="closeUploadFileModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form class="upload-form">
                    <div class="input-group">
                        <label for="fileTitle">Fájl címe:</label>
                        <input type="text" id="fileTitle" placeholder="pl. 3. Előadás jegyzet" required>
                    </div>
                    
                    <div class="input-group">
                        <label for="fileDescription">Leírás:</label>
                        <textarea id="fileDescription" placeholder="Rövid leírás a fájl tartalmáról..." rows="3"></textarea>
                    </div>
                    
                    <div class="input-group">
                        <label for="fileUpload">Fájl kiválasztása:</label>
                        <input type="file" id="fileUpload" accept=".pdf,.doc,.docx,.ppt,.pptx,.txt" required>
                        <small>Támogatott formátumok: PDF, Word, PowerPoint, TXT</small>
                    </div>
                    
                    <div class="modal-actions">
                        <button type="button" class="btn btn-primary" onclick="uploadFile()">Feltöltés</button>
                        <button type="button" class="btn btn-secondary" onclick="closeUploadFileModal()">Mégse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Create Chatroom Modal -->
    <div id="createChatroomModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Új chatszoba létrehozása</h2>
                <span class="close" onclick="closeCreateChatroomModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form class="upload-form">
                    <div class="input-group">
                        <label for="chatroomTitle">Chatszoba címe:</label>
                        <input type="text" id="chatroomTitle" placeholder="pl. Laboratórium 1 megbeszélés" required maxlength="50">
                    </div>
                    
                    <div class="input-group">
                        <label for="chatroomDescription">Rövid leírás:</label>
                        <textarea id="chatroomDescription" placeholder="Írja le röviden, miről szól ez a chatszoba..." rows="3" maxlength="200"></textarea>
                    </div>
                    
                    <div class="modal-actions">
                        <button type="button" class="btn btn-primary" onclick="createChatroom()">Chatszoba létrehozása</button>
                        <button type="button" class="btn btn-secondary" onclick="closeCreateChatroomModal()">Mégse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="script.js"></script>
    <script>


        // ===== CHATROOM FUNCTIONS =====
        function showCreateChatroomModal() {
            document.getElementById('createChatroomModal').style.display = 'block';
        }

        function closeCreateChatroomModal() {
            document.getElementById('createChatroomModal').style.display = 'none';
            document.getElementById('chatroomTitle').value = '';
            document.getElementById('chatroomDescription').value = '';
        }

        function joinChatroom(chatroomId) {
            const currentSubject = localStorage.getItem('currentSubject') || 'informatikai-alapok';
            window.location.href = `chatroom.php?chatroom=${chatroomId}&subject=${currentSubject}`;
        }

        function toggleChatroomFollow(chatroomId, button) {
            const isFollowing = button.classList.contains('following');
            
            if (isFollowing) {
                button.classList.remove('following');
                button.textContent = '+ Követés';
            } else {
                button.classList.add('following');
                button.textContent = '✓ Követve';
            }
        }

        function createChatroom() {
            const title = document.getElementById('chatroomTitle').value.trim();
            const description = document.getElementById('chatroomDescription').value.trim();
            
            if (!title) {
                alert('Kérem, adja meg a chatszoba címét!');
                return;
            }
            
            const chatroomId = title.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
            
            const chatroomsList = document.getElementById('chatroomsList');
            const newChatroomCard = document.createElement('div');
            newChatroomCard.className = 'file-item';
            newChatroomCard.onclick = function() { joinChatroom(chatroomId); };
            
            newChatroomCard.innerHTML = `
                <div class="file-info">
                    <h3>${title}</h3>
                    <p class="file-name">${description || 'Nincs leírás megadva'}</p>
                    <p class="file-meta">1 követő</p>
                </div>
                <div class="file-actions">
                    <button class="btn btn-secondary following" onclick="event.stopPropagation(); toggleChatroomFollow('${chatroomId}', this)">
                        ✓ Követve
                    </button>
                </div>
            `;
            
            chatroomsList.appendChild(newChatroomCard);
            closeCreateChatroomModal();
        }

        // Handle hash navigation to chatrooms
        function handleHashNavigation() {
            if (window.location.hash === '#chatrooms') {
                // Switch to chat section manually (replicating showSection logic)
                document.querySelectorAll('.section').forEach(section => {
                    section.classList.remove('active');
                });
                document.querySelectorAll('.nav-tab').forEach(tab => {
                    tab.classList.remove('active');
                });
                
                // Show chat section and activate chat tab
                const chatSection = document.getElementById('chatSection');
                const chatTab = document.querySelector('button[onclick="showSection(\'chat\')"]');
                
                if (chatSection && chatTab) {
                    chatSection.classList.add('active');
                    chatTab.classList.add('active');
                }
            }
        }

        // Make subject page dynamic based on URL or localStorage
        document.addEventListener('DOMContentLoaded', function() {
            const subjectData = {
                'informatikai-alapok': {
                    title: 'Informatikai alapok',
                    code: 'GKNB_INTM038',
                    files: 12,
                    requests: 3
                },
                'programozas-alapjai': {
                    title: 'Programozás alapjai',
                    code: 'GKNB_INTM020',
                    files: 8,
                    requests: 1
                },
                'adatbazisok': {
                    title: 'Adatbázisok',
                    code: 'GKNB_INTM030',
                    files: 15,
                    requests: 2
                }
            };
            
            // Get subject from URL or localStorage
            const urlParams = new URLSearchParams(window.location.search);
            let currentSubject = urlParams.get('subject') || localStorage.getItem('currentSubject') || 'informatikai-alapok';
            
            const subject = subjectData[currentSubject];
            if (subject) {
                document.getElementById('subjectTitle').textContent = subject.title;
                document.getElementById('subjectCode').textContent = subject.code;
                document.getElementById('fileCount').textContent = subject.files + ' fájl';
                document.getElementById('requestCount').textContent = subject.requests + ' kérelem';
                document.title = subject.title + ' - Hallgatói Fájlmegosztó';
            }
            
            // Handle hash navigation after page loads
            setTimeout(handleHashNavigation, 100); // Small delay to ensure DOM is ready
        });
        
        // Handle hash changes (e.g., when navigating back from chatroom)
        window.addEventListener('hashchange', handleHashNavigation);
        
        // Also handle when page loads with hash
        window.addEventListener('load', handleHashNavigation);
    </script>
    
    <style>
        /* Add bottom spacing to chatrooms list */
        #chatroomsList {
            padding-bottom: 2rem;
        }
    </style>
</body>
</html>