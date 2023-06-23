import './bootstrap';

const likeElements = document.querySelectorAll('.like');
const dislikeElements = document.querySelectorAll('.dislike');

likeElements.forEach(likeButton => {
    likeButton.addEventListener('click', async (event) => {
        event.preventDefault();
        const newsId = likeButton.dataset.value;
        let counterElement = likeButton.querySelector('span');
        let likeCounter = parseInt(counterElement.innerText);

        try {
            const response = await axios.post('/likes', {
                news_id: newsId,
                is_like: true,
            });
            counterElement.innerText = (likeCounter + 1).toString();
        } catch (error) {
            return [];
        }
    })
})

dislikeElements.forEach(likeButton => {
    likeButton.addEventListener('click', async (event) => {
        event.preventDefault();
        const newsId = likeButton.dataset.value;
        let counterElement = likeButton.querySelector('span');
        let likeCounter = parseInt(counterElement.innerText);

        try {
            const response = await axios.post('/likes', {
                news_id: newsId,
                is_like: false,
            });
            counterElement.innerText = (likeCounter + 1).toString();
        } catch (error) {
            return [];
        }
    })
})
