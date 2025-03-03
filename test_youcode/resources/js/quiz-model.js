function openModal(quiz = null) {
    const modal = document.getElementById('quizModal');
    const form = document.getElementById('quizForm');
    const title = document.getElementById('modalTitle');

    if (quiz) {
        title.textContent = 'Modifier Quiz';
        form.action = `/quizzes/${quiz.id}`;
        form.method = 'POST';
        form.innerHTML += '<input type="hidden" name="_method" value="PUT">';
        
        // Fill form with quiz data
        form.elements.title.value = quiz.title;
        form.elements.description.value = quiz.description;
        form.elements.duration.value = quiz.duration;
        form.elements.passing_score.value = quiz.passing_score;
    } else {
        title.textContent = 'Nouveau Quiz';
        form.action = '/quizzes';
        form.method = 'POST';
    }

    modal.classList.remove('hidden');
}

function closeModal() {
    const modal = document.getElementById('quizModal');
    modal.classList.add('hidden');
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('quizModal');
    if (event.target === modal) {
        closeModal();
    }
}