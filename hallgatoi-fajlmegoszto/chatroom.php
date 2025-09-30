<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatszoba - Hallgatói Fájlmegosztó</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="subject-container">
        <nav class="subject-navbar">
            <div class="nav-left">
                <button class="btn btn-back" onclick="backToChatroomBrowser()">← Vissza a chatszobákhoz</button>
                <h1 id="chatroomTitle">Általános beszélgetés</h1>
            </div>
        </nav>
        
        <main class="subject-main">
            
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
    
    <script src="script.js"></script>
    <script>
        // Chatroom-specific functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Get chatroom info from URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const chatroomId = urlParams.get('chatroom') || 'general';
            const subject = urlParams.get('subject') || 'informatikai-alapok';
            
            // Mock chatroom data (in a real app, this would come from a database)
            const chatroomData = {
                'general': {
                    name: 'Általános beszélgetés',
                    description: 'Általános beszélgetés a tárgyról és házi feladatokról',
                    onlineCount: 3,
                    isFollowing: true
                },
                'homework-help': {
                    name: 'Házi feladat segítség',
                    description: 'Segítség kérése és adása a házi feladatokhoz',
                    onlineCount: 7,
                    isFollowing: false
                },
                'exam-prep': {
                    name: 'Vizsgafelkészülés',
                    description: 'Közös tanulás és vizsgafelkészülés',
                    onlineCount: 12,
                    isFollowing: true
                }
            };
            
            const subjectNames = {
                'informatikai-alapok': 'Informatikai alapok',
                'programozas-alapjai': 'Programozás alapjai',
                'adatbazisok': 'Adatbázisok'
            };
            
            const chatroom = chatroomData[chatroomId];
            const subjectName = subjectNames[subject];
            
            if (chatroom && subjectName) {
                document.getElementById('chatroomTitle').textContent = chatroom.name;
                document.getElementById('chatroomName').textContent = chatroom.name;
                document.getElementById('chatroomDescription').textContent = chatroom.description;
                document.getElementById('subjectInfo').textContent = subjectName;
                document.getElementById('onlineCount').textContent = chatroom.onlineCount + ' online';
                document.title = chatroom.name + ' - ' + subjectName + ' - Hallgatói Fájlmegosztó';
                
                // Update follow button
                updateFollowButton(chatroom.isFollowing);
                
                // Store current chatroom info for navigation
                localStorage.setItem('currentChatroom', chatroomId);
                localStorage.setItem('currentSubject', subject);
            }
        });
        
        function backToChatroomBrowser() {
            const subject = localStorage.getItem('currentSubject') || 'informatikai-alapok';
            window.location.href = 'subject.php?subject=' + subject + '#chatrooms';
        }
        
        function toggleFollow() {
            const followBtn = document.getElementById('followBtn');
            const followText = document.getElementById('followText');
            const isCurrentlyFollowing = followBtn.classList.contains('following');
            
            if (isCurrentlyFollowing) {
                followBtn.classList.remove('following');
                followText.textContent = 'Követés';
                showNotification('Chatszoba követése megszüntetve');
            } else {
                followBtn.classList.add('following');
                followText.textContent = 'Követve';
                showNotification('Chatszoba követése elindítva');
            }
        }
        
        function updateFollowButton(isFollowing) {
            const followBtn = document.getElementById('followBtn');
            const followText = document.getElementById('followText');
            
            if (isFollowing) {
                followBtn.classList.add('following');
                followText.textContent = 'Követve';
            } else {
                followBtn.classList.remove('following');
                followText.textContent = 'Követés';
            }
        }
        
        function showNotification(message) {
            // Simple notification function
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #10b981;
                color: white;
                padding: 12px 24px;
                border-radius: 8px;
                z-index: 1000;
                animation: slideIn 0.3s ease;
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
</body>
</html>