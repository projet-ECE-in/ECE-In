function addFriend(friendName) {
    alert('Vous avez ajouté ' + friendName + ' à vos amis.');
}

function filterFriends() {
    const searchInput = document.getElementById('friend-search').value.toLowerCase();
    const friends = document.querySelectorAll('.friend');
    friends.forEach(friend => {
        const friendName = friend.querySelector('.friend-info h3').textContent.toLowerCase();
        if (friendName.includes(searchInput)) {
            friend.style.display = '';
        } else {
            friend.style.display = 'none';
        }
    });
}

function filterSuggestions() {
    const searchInput = document.getElementById('suggestion-search').value.toLowerCase();
    const suggestions = document.querySelectorAll('.suggestion');
    suggestions.forEach(suggestion => {
        const suggestionName = suggestion.querySelector('.suggestion-info h3').textContent.toLowerCase();
        if (suggestionName.includes(searchInput)) {
            suggestion.style.display = '';
        } else {
            suggestion.style.display = 'none';
        }
    });
}