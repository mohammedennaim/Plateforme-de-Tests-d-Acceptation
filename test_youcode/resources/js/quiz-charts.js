document.addEventListener('DOMContentLoaded', function() {
    // Success Rate Chart
    const successRateCtx = document.getElementById('successRateChart').getContext('2d');
    new Chart(successRateCtx, {
        type: 'bar',
        data: {
            labels: quizSuccessRates.map(quiz => quiz.title),
            datasets: [{
                label: 'Taux de Réussite (%)',
                data: quizSuccessRates.map(quiz => quiz.attempts_avg_score),
                backgroundColor: 'rgba(99, 102, 241, 0.5)',
                borderColor: 'rgb(99, 102, 241)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });

    // Student Progress Chart
    const progressCtx = document.getElementById('studentProgressChart').getContext('2d');
    new Chart(progressCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Moyenne des scores (%)',
                data: studentProgress,
                fill: false,
                borderColor: 'rgb(34, 197, 94)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
});