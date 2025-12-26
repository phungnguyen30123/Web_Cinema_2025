<!-- AI Chatbot Widget -->
<div id="chatbot-widget" class="chatbot-widget">
    <!-- Chatbot Button -->
    <button id="chatbot-toggle" class="chatbot-toggle" title="Trợ lý AI">
        <i class="fa fa-comments"></i>
        <span class="chatbot-badge">AI</span>
    </button>

    <!-- Chatbot Window -->
    <div id="chatbot-window" class="chatbot-window">
        <div class="chatbot-header">
            <div class="chatbot-header-content">
                <div class="chatbot-avatar">
                    <i class="fa fa-robot"></i>
                </div>
                <div class="chatbot-info">
                    <h3>Trợ lý AI</h3>
                    <p class="chatbot-status">Đang hoạt động</p>
                </div>
            </div>
            <button id="chatbot-close" class="chatbot-close">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <div id="chatbot-messages" class="chatbot-messages">
            <div class="chatbot-message chatbot-message-bot">
                <div class="chatbot-avatar-small">
                    <i class="fa fa-robot"></i>
                </div>
                <div class="chatbot-message-content">
                    <p>Xin chào! Tôi là trợ lý AI của rạp phim. Tôi có thể giúp bạn:</p>
                    <ul style="margin: 5px 0; padding-left: 20px;">
                        <li>Tìm thông tin về phim</li>
                        <li>Hỏi về lịch chiếu</li>
                        <li>Tư vấn về giá vé</li>
                        <li>Hỗ trợ đặt vé</li>
                    </ul>
                    <p>Bạn cần hỗ trợ gì? 😊</p>
                </div>
            </div>
        </div>

        <div class="chatbot-input-area">
            <form id="chatbot-form" class="chatbot-form">
                <input 
                    type="text" 
                    id="chatbot-input" 
                    class="chatbot-input" 
                    placeholder="Nhập câu hỏi của bạn..."
                    autocomplete="off"
                >
                <button type="submit" class="chatbot-send" title="Gửi">
                    <i class="fa fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
/* Chatbot Widget Styles */
.chatbot-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    font-family: 'Roboto', sans-serif;
}

.chatbot-toggle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ffd564 0%, #fe505a 100%);
    border: none;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chatbot-toggle:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
}

.chatbot-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #4c4145;
    color: #fff;
    font-size: 10px;
    font-weight: bold;
    padding: 2px 6px;
    border-radius: 10px;
    border: 2px solid #fff;
}

.chatbot-window {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 380px;
    height: 500px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    display: none;
    flex-direction: column;
    overflow: hidden;
    animation: slideUp 0.3s ease;
}

.chatbot-window.active {
    display: flex;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chatbot-header {
    background: linear-gradient(135deg, #ffd564 0%, #fe505a 100%);
    color: #fff;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chatbot-header-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.chatbot-avatar {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.chatbot-info h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.chatbot-status {
    margin: 0;
    font-size: 12px;
    opacity: 0.9;
}

.chatbot-close {
    background: transparent;
    border: none;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    padding: 5px;
    transition: transform 0.2s;
}

.chatbot-close:hover {
    transform: rotate(90deg);
}

.chatbot-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    background: #f5f5f5;
}

.chatbot-message {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chatbot-message-user {
    flex-direction: row-reverse;
}

.chatbot-avatar-small {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ffd564 0%, #fe505a 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 14px;
    flex-shrink: 0;
}

.chatbot-message-user .chatbot-avatar-small {
    background: #4c4145;
}

.chatbot-message-content {
    max-width: 75%;
    padding: 12px 15px;
    border-radius: 15px;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    word-wrap: break-word;
}

.chatbot-message-user .chatbot-message-content {
    background: linear-gradient(135deg, #ffd564 0%, #fe505a 100%);
    color: #fff;
}

.chatbot-message-content p {
    margin: 0 0 5px 0;
    font-size: 14px;
    line-height: 1.5;
}

.chatbot-message-content p:last-child {
    margin-bottom: 0;
}

.chatbot-message-content ul {
    margin: 5px 0;
    padding-left: 20px;
}

.chatbot-message-content li {
    margin: 3px 0;
    font-size: 13px;
}

.chatbot-input-area {
    padding: 15px;
    background: #fff;
    border-top: 1px solid #dbdee1;
}

.chatbot-form {
    display: flex;
    gap: 10px;
}

.chatbot-input {
    flex: 1;
    padding: 12px 15px;
    border: 1px solid #dbdee1;
    border-radius: 25px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.3s;
}

.chatbot-input:focus {
    border-color: #fe505a;
}

.chatbot-send {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ffd564 0%, #fe505a 100%);
    border: none;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: transform 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chatbot-send:hover {
    transform: scale(1.1);
}

.chatbot-send:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* Scrollbar styling */
.chatbot-messages::-webkit-scrollbar {
    width: 6px;
}

.chatbot-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.chatbot-messages::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 3px;
}

.chatbot-messages::-webkit-scrollbar-thumb:hover {
    background: #999;
}

/* Responsive */
@media (max-width: 768px) {
    .chatbot-window {
        width: calc(100vw - 40px);
        height: calc(100vh - 120px);
        max-height: 500px;
        right: 20px;
        left: 20px;
    }
    
    .chatbot-toggle {
        width: 55px;
        height: 55px;
        font-size: 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbotWindow = document.getElementById('chatbot-window');
    const chatbotClose = document.getElementById('chatbot-close');
    const chatbotForm = document.getElementById('chatbot-form');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotMessages = document.getElementById('chatbot-messages');

    // Toggle chatbot window
    chatbotToggle.addEventListener('click', function() {
        chatbotWindow.classList.toggle('active');
        if (chatbotWindow.classList.contains('active')) {
            chatbotInput.focus();
        }
    });

    chatbotClose.addEventListener('click', function() {
        chatbotWindow.classList.remove('active');
    });

    // Auto scroll to bottom
    function scrollToBottom() {
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    // Add message to chat
    function addMessage(message, isUser) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'chatbot-message ' + (isUser ? 'chatbot-message-user' : 'chatbot-message-bot');
        
        const avatarDiv = document.createElement('div');
        avatarDiv.className = 'chatbot-avatar-small';
        avatarDiv.innerHTML = '<i class="fa ' + (isUser ? 'fa-user' : 'fa-robot') + '"></i>';
        
        const contentDiv = document.createElement('div');
        contentDiv.className = 'chatbot-message-content';
        
        // Format message (support line breaks)
        const formattedMessage = message.replace(/\n/g, '<br>');
        contentDiv.innerHTML = '<p>' + formattedMessage + '</p>';
        
        messageDiv.appendChild(avatarDiv);
        messageDiv.appendChild(contentDiv);
        chatbotMessages.appendChild(messageDiv);
        
        scrollToBottom();
    }

    // Handle form submission
    chatbotForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const message = chatbotInput.value.trim();
        if (!message) return;
        
        // Add user message
        addMessage(message, true);
        chatbotInput.value = '';
        
        // Disable input while processing
        chatbotInput.disabled = true;
        const sendButton = chatbotForm.querySelector('.chatbot-send');
        sendButton.disabled = true;
        
        // Show typing indicator
        const typingIndicator = document.createElement('div');
        typingIndicator.className = 'chatbot-message chatbot-message-bot';
        typingIndicator.id = 'typing-indicator';
        typingIndicator.innerHTML = `
            <div class="chatbot-avatar-small">
                <i class="fa fa-robot"></i>
            </div>
            <div class="chatbot-message-content">
                <p>Đang suy nghĩ...</p>
            </div>
        `;
        chatbotMessages.appendChild(typingIndicator);
        scrollToBottom();
        
        // Send request to server
        const formData = new FormData();
        formData.append('message', message);
        
        fetch('<?php echo base_url(); ?>index.php/Chatbot_controller/chat', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Remove typing indicator
            const indicator = document.getElementById('typing-indicator');
            if (indicator) {
                indicator.remove();
            }
            
            if (data.success) {
                addMessage(data.response, false);
            } else {
                addMessage('Xin lỗi, có lỗi xảy ra. Vui lòng thử lại sau.', false);
            }
        })
        .catch(error => {
            // Remove typing indicator
            const indicator = document.getElementById('typing-indicator');
            if (indicator) {
                indicator.remove();
            }
            
            addMessage('Xin lỗi, không thể kết nối đến server. Vui lòng thử lại sau.', false);
            console.error('Error:', error);
        })
        .finally(() => {
            // Re-enable input
            chatbotInput.disabled = false;
            sendButton.disabled = false;
            chatbotInput.focus();
        });
    });

    // Allow Enter to submit (but Shift+Enter for new line)
    chatbotInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatbotForm.dispatchEvent(new Event('submit'));
        }
    });
});
</script>

