document.addEventListener('DOMContentLoaded', function() {
    const commentForm = document.getElementById('comment-form');
    const commentList = document.getElementById('comments');

    commentForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const comment = document.getElementById('comment').value;

        // Create new comment element
        const newComment = document.createElement('div');
        newComment.classList.add('comment');
        newComment.innerHTML = `
            <strong>${name}</strong>: ${comment}
        `;

        // Append the new comment to the comment list
        commentList.appendChild(newComment);

        // Reset form fields
        commentForm.reset();
    });
});