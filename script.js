let player;

function getQuote() {
  const quoteText = document.getElementById('quoteText');
  quoteText.textContent = 'Fetching quote...';

  const quoteEndpoint = 'https://api.quotable.io/random';

  fetch(quoteEndpoint)
    .then(response => response.json())
    .then(data => {
      quoteText.textContent = `"${data.content}" - ${data.author}`;
    })
    .catch(error => {
      console.error('Error fetching quote:', error);
      quoteText.textContent = 'Failed to fetch quote.';
    });
}

function searchVideo() {
  const searchTerm = document.getElementById('searchTerm').value.trim();
  if (searchTerm === '') {
    alert('Please enter a search term');
    return;
  }

  const videoEndpoint = `https://www.googleapis.com/youtube/v3/search?part=snippet&q=${searchTerm}&type=video&key=YOUR_YOUTUBE_API_KEY`;

  fetch(videoEndpoint)
    .then(response => response.json())
    .then(data => {
      if (data.items && data.items.length > 0) {
        const videoId = data.items[0].id.videoId;
        loadVideo(videoId);
      } else {
        alert('No videos found for this search term');
      }
    })
    .catch(error => {
      console.error('Error fetching videos:', error);
      alert('Failed to fetch videos.');
    });
}

function loadVideo(videoId) {
  if (player) {
    player.loadVideoById(videoId);
  } else {
    player = new YT.Player('player', {
      height: '360',
      width: '640',
      videoId: videoId,
    });
  }
}
