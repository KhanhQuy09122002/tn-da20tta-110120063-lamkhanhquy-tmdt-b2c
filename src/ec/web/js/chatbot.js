document.addEventListener('DOMContentLoaded', (event) => {
    const chatbotIcon = document.createElement('div');
    chatbotIcon.id = 'chatbotIcon';
    chatbotIcon.innerText = 'Chat';
    document.body.appendChild(chatbotIcon);

    const chatbotWindow = document.createElement('div');
    chatbotWindow.id = 'chatbotWindow';
    chatbotWindow.innerHTML = '<div id="chatMessages"></div><input type="text" id="chatInput" placeholder="Type your message...">';
    document.body.appendChild(chatbotWindow);

    chatbotIcon.addEventListener('click', () => {
        chatbotWindow.style.display = chatbotWindow.style.display === 'none' ? 'block' : 'none';
    });

    const chatInput = document.getElementById('chatInput');
    chatInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            sendMessage(chatInput.value);
            chatInput.value = '';
        }
    });

    function sendMessage(message) {
        const chatMessages = document.getElementById('chatMessages');
        const userMessage = document.createElement('div');
        userMessage.className = 'userMessage';
        userMessage.innerText = message;
        chatMessages.appendChild(userMessage);

        console.log('Sending message:', message);  // Log dữ liệu gửi đi
        fetch('/site/chatbot', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Received response:', data);  // Log phản hồi nhận được

            const botMessage = document.createElement('div');
            botMessage.className = 'botMessage';
            botMessage.innerText = data.response;
            chatMessages.appendChild(botMessage);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
