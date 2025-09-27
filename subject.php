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
                    <h2>Chatszoba</h2>
                    <div class="online-count">
                        <span class="online-indicator"></span>
                        <span>3 online</span>
                    </div>
                </div>
                
                <div class="chat-container">
                    <div class="chat-messages" id="chatMessages">
                        <div class="message">
                            <div class="message-author">Kiss János</div>
                            <div class="message-content">Sziasztok! Van valakinek ötlete az első ZH 3. feladatához?</div>
                            <div class="message-time">14:32</div>
                        </div>
                        
                        <div class="message">
                            <div class="message-author">Nagy Péter</div>
                            <div class="message-content">Igen, azt rekurzióval kell megoldani. Ha akarod, tudok segíteni.</div>
                            <div class="message-time">14:35</div>
                        </div>
                        
                        <div class="message own">
                            <div class="message-author">Te</div>
                            <div class="message-content">Én is érdeklődnék a megoldás iránt!</div>
                            <div class="message-time">14:38</div>
                        </div>
                    </div>
                    
                    <div class="chat-input-container">
                        <input type="text" id="chatInput" placeholder="Írj egy üzenetet..." onkeypress="handleChatKeyPress(event)">
                        <button class="btn btn-primary" onclick="sendMessage()">Küldés</button>
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
    
    <script src="script.js"></script>
    <script>
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
        });
    </script>
</body>
</html>