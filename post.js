document.querySelector('.comment-submit').addEventListener('click', function() {
    const commentText = document.querySelector('.comment-input').value;
    if (commentText) {
      const commentElement = document.createElement('div');
      commentElement.textContent = commentText;
      document.querySelector('.comments-list').appendChild(commentElement);
      document.querySelector('.comment-input').value = ''; // Clear input
    }
  });
  
  // Like, dislike, comment, bookmark interactions
  document.querySelectorAll('.action-icon').forEach(icon => {
    icon.addEventListener('click', function() {
      // Handle interaction logic like increasing like count or bookmarking
      console.log(this.alt + ' clicked');
    });
  });
  