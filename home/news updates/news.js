document.addEventListener('DOMContentLoaded', function () {
    fetchNews();
});

function fetchNews() {
    fetch('fetch_news.php')
        .then(response => response.json())
        .then(data => {
            let newsContainer = document.getElementById('news-container');
            newsContainer.innerHTML = '';
            data.forEach(news => {
                let newsCard = document.createElement('div');
                newsCard.classList.add('news-card');
                newsCard.innerHTML = `
                    <h3>${news.title}</h3>
                    <p>${news.content}</p>
                    <p><em>${news.date}</em></p>
                `;
                newsContainer.appendChild(newsCard);
            });
        });
}
