<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Hallgatói Fájlmegosztó</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="nav-left">
                <h1>Dashboard</h1>
            </div>
            <div class="nav-tabs">
                <button class="nav-tab active" onclick="showDashboardSection('subjects')">Tárgyaim</button>
                <button class="nav-tab" onclick="showDashboardSection('files')">Feltöltött fájljaim</button>
                <button class="nav-tab" onclick="showDashboardSection('requests')">Kérelmeim</button>
            </div>
            <button class="btn btn-logout" onclick="logout()">Kijelentkezés</button>
        </header>
        
        <main class="dashboard-main">
            <!-- Subjects Section -->
            <div id="subjectsSection" class="dashboard-section active">
                <div class="subjects-container">
                    <div class="subjects-grid">
                        <!-- Sample subjects - these would come from database -->
                        <div class="subject-card" data-subject="informatikai-alapok">
                            <div class="subject-content" onclick="openSubject('informatikai-alapok')">
                                <h3>Informatikai alapok</h3>
                                <p class="subject-code">GKNB_INTM038</p>
                                <div class="subject-stats">
                                    <span class="file-count">12 fájl</span>
                                    <span class="request-count">3 kérelem</span>
                                </div>
                            </div>
                            <button class="delete-subject-btn" onclick="deleteSubject(event, 'informatikai-alapok')">🗑️</button>
                        </div>
                        
                        <div class="subject-card" data-subject="programozas-alapjai">
                            <div class="subject-content" onclick="openSubject('programozas-alapjai')">
                                <h3>Programozás alapjai</h3>
                                <p class="subject-code">GKNB_INTM020</p>
                                <div class="subject-stats">
                                    <span class="file-count">8 fájl</span>
                                    <span class="request-count">1 kérelem</span>
                                </div>
                            </div>
                            <button class="delete-subject-btn" onclick="deleteSubject(event, 'programozas-alapjai')">🗑️</button>
                        </div>
                        
                        <div class="subject-card" data-subject="adatbazisok">
                            <div class="subject-content" onclick="openSubject('adatbazisok')">
                                <h3>Adatbázisok</h3>
                                <p class="subject-code">GKNB_INTM030</p>
                                <div class="subject-stats">
                                    <span class="file-count">15 fájl</span>
                                    <span class="request-count">2 kérelem</span>
                                </div>
                            </div>
                            <button class="delete-subject-btn" onclick="deleteSubject(event, 'adatbazisok')">🗑️</button>
                        </div>
                        
                        <div class="subject-card add-subject-card" onclick="showAddSubjectModal()">
                            <div class="add-subject-content">
                                <span class="add-icon">+</span>
                                <h3>Vegyen fel új tárgyat</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- My Files Section -->
            <div id="filesSection" class="dashboard-section">
                <div class="my-files-container">
                    <div class="section-header">
                        <h2>Feltöltött fájljaim</h2>
                    </div>
                    
                    <div class="my-files-grid">
                        <div class="my-file-item" onclick="showMyFileDetails('ea2-jegyzet.pdf', 'Informatikai alapok')">
                            <div class="file-icon">📄</div>
                            <div class="file-info">
                                <h3>2. Előadás jegyzet</h3>
                                <p class="file-name">ea2-jegyzet.pdf</p>
                                <p class="file-meta">Feltöltve: 2024.09.20 • Informatikai alapok</p>
                            </div>
                            <div class="file-actions">
                                <div class="rating">
                                    <span class="stars">★★★★★</span>
                                    <span class="rating-text">(4.9/5)</span>
                                </div>
                                <div class="download-count">
                                    <span>23 letöltés</span>
                                </div>
                                <button class="btn btn-secondary btn-small" onclick="deleteMyFile(event, 'ea2-jegyzet.pdf')">Törlés</button>
                            </div>
                        </div>
                        
                        <div class="my-file-item" onclick="showMyFileDetails('gyak3-megoldas.docx', 'Programozás alapjai')">
                            <div class="file-icon">📝</div>
                            <div class="file-info">
                                <h3>3. Gyakorlat megoldás</h3>
                                <p class="file-name">gyak3-megoldas.docx</p>
                                <p class="file-meta">Feltöltve: 2024.09.22 • Programozás alapjai</p>
                            </div>
                            <div class="file-actions">
                                <div class="rating">
                                    <span class="stars">★★★★☆</span>
                                    <span class="rating-text">(4.1/5)</span>
                                </div>
                                <div class="download-count">
                                    <span>18 letöltés</span>
                                </div>
                                <button class="btn btn-secondary btn-small" onclick="deleteMyFile(event, 'gyak3-megoldas.docx')">Törlés</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- My Requests Section -->
            <div id="requestsSection" class="dashboard-section">
                <div class="my-requests-container">
                    <div class="section-header">
                        <h2>Kérelmeim</h2>
                    </div>
                    
                    <div class="my-requests-grid">
                        <div class="my-request-item pending">
                            <div class="request-info">
                                <h3>4. ZH megoldások</h3>
                                <p class="request-description">Keresem a 4. zárthelyi megoldását, különösen a 2. és 3. feladatot.</p>
                                <p class="request-meta">Kérve: 2024.09.24 • Informatikai alapok</p>
                            </div>
                            <div class="request-actions">
                                <span class="status-badge pending">Várakozó</span>
                                <button class="btn btn-secondary btn-small" onclick="deleteMyRequest(event, this.parentElement.parentElement)">Törlés</button>
                            </div>
                        </div>
                        
                        <div class="my-request-item fulfilled" onclick="showFulfilledRequestFile('adatbazis-tervezes.pdf')">
                            <div class="request-info">
                                <h3>Adatbázis tervezés segédlet</h3>
                                <p class="request-description">Kellene valami jó segédanyag az adatbázis tervezéshez az EA anyagon kívül.</p>
                                <p class="request-meta">Kérve: 2024.09.20 • Adatbázisok</p>
                            </div>
                            <div class="request-actions">
                                <span class="status-badge fulfilled">Teljesítve</span>
                                <button class="btn btn-secondary btn-small" onclick="deleteMyRequest(event, this.parentElement.parentElement)">Törlés</button>
                            </div>
                        </div>
                        
                        <div class="my-request-item fulfilled" onclick="showFulfilledRequestFile('recursio-peldak.pdf')">
                            <div class="request-info">
                                <h3>Rekurzió gyakorló feladatok</h3>
                                <p class="request-description">Extra gyakorló feladatokat keresek rekurzióhoz, az óraiakhoz képest bonyolultabbakat.</p>
                                <p class="request-meta">Kérve: 2024.09.18 • Programozás alapjai</p>
                            </div>
                            <div class="request-actions">
                                <span class="status-badge fulfilled">Teljesítve</span>
                                <button class="btn btn-secondary btn-small" onclick="deleteMyRequest(event, this.parentElement.parentElement)">Törlés</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Add Subject Modal -->
    <div id="addSubjectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Új tárgy felvétele</h2>
                <span class="close" onclick="closeAddSubjectModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="search-container">
                    <input type="text" id="subjectSearch" placeholder="Keresse meg a tárgyat..." oninput="searchSubjects()">
                </div>
                <div class="subjects-list" id="availableSubjects">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- My File Details Modal (no rating, only delete) -->
    <div id="myFileDetailsModal" class="modal">
        <div class="modal-content large">
            <div class="modal-header">
                <h2 id="myFileDetailsTitle">Fájl részletei</h2>
                <span class="close" onclick="closeMyFileDetailsModal()">&times;</span>
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
                                <td id="myDetailFileName">ea2-jegyzet.pdf</td>
                            </tr>
                            <tr>
                                <td><strong>Tárgy:</strong></td>
                                <td id="myDetailSubject">Informatikai alapok</td>
                            </tr>
                            <tr>
                                <td><strong>Feltöltés dátuma:</strong></td>
                                <td id="myDetailUploadDate">2024.09.20</td>
                            </tr>
                            <tr>
                                <td><strong>Fájlméret:</strong></td>
                                <td id="myDetailFileSize">2.1 MB</td>
                            </tr>
                            <tr>
                                <td><strong>Letöltések:</strong></td>
                                <td id="myDetailDownloads">23</td>
                            </tr>
                            <tr>
                                <td><strong>Értékelés:</strong></td>
                                <td id="myDetailRating">4.9/5 (8 értékelés)</td>
                            </tr>
                        </table>
                        
                        <div class="description">
                            <h4>Leírás</h4>
                            <p id="myDetailDescription">Az általam készített jegyzet a második előadás anyagából.</p>
                        </div>
                        
                        <div class="modal-actions">
                            <button class="btn btn-primary" onclick="downloadMyFile()">Letöltés</button>
                            <button class="btn btn-danger" onclick="deleteMyFileFromModal()">Fájl törlése</button>
                            <button class="btn btn-secondary" onclick="closeMyFileDetailsModal()">Bezárás</button>
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
                        <label for="fileSubject">Tárgy kiválasztása:</label>
                        <select id="fileSubject" required>
                            <option value="">Válasszon tárgyat...</option>
                            <option value="informatikai-alapok">Informatikai alapok</option>
                            <option value="programozas-alapjai">Programozás alapjai</option>
                            <option value="adatbazisok">Adatbázisok</option>
                        </select>
                    </div>
                    
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
    
    <!-- File Details Modal for fulfilled requests -->
    <div id="fileDetailsModal" class="modal">
        <div class="modal-content large">
            <div class="modal-header">
                <h2 id="fileDetailsTitle">Fájl részletei</h2>
                <span class="close" onclick="closeFileDetailsModal()">&times;</span>
            </div>
            <div class="modal-body file-details-body">
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
                            <td id="detailFileName">example.pdf</td>
                        </tr>
                        <tr>
                            <td><strong>Feltöltő:</strong></td>
                            <td id="detailUploader">Felhasználó</td>
                        </tr>
                        <tr>
                            <td><strong>Feltöltés dátuma:</strong></td>
                            <td id="detailUploadDate">2024.09.20</td>
                        </tr>
                        <tr>
                            <td><strong>Fájlméret:</strong></td>
                            <td id="detailFileSize">1.0 MB</td>
                        </tr>
                        <tr>
                            <td><strong>Letöltések:</strong></td>
                            <td id="detailDownloads">0</td>
                        </tr>
                        <tr>
                            <td><strong>Értékelés:</strong></td>
                            <td id="detailRating">Nincs értékelés</td>
                        </tr>
                    </table>
                    
                    <div class="description">
                        <h4>Leírás</h4>
                        <p id="detailDescription">Nincs leírás.</p>
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
    
    <script src="script.js"></script>
</body>
</html>