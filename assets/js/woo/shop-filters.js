// listen for click event in the main, & if target of click has data-link attr, do the shop filtering
document.querySelector('main').addEventListener('click', function(event) {
	if (event.target.hasAttribute('data-link'))
		shopFiltering();
});

function shopFiltering() {
	// on clicking filter, scroll to top & add loader class
	UIkit.scroll('', {
		offset: 90
	}).scrollTo('#PrimaryHeader');
	document.querySelector('.filters-container').classList.add('quickloader');
	// the data-link for fetching
	var data_link = event.target.getAttribute("data-link");
	// then a fetch request with the clicked data-llnk
	fetch(data_link).then(function(response) {
		// The API call was successful, on to what we do with the resuts
		return response.text();
	}).then(function(html) {
		// define our variables first
		var parser = new DOMParser();
		// the main container & it's child to be replaed
		var main_container = document.getElementById("ContentSection");
		var current_content = document.querySelector('.index-archive');
		// do stuff with the data/results
		var doc_obj = parser.parseFromString(html, 'text/html');
		var new_content = doc_obj.querySelector('.index-archive');
		main_container.replaceChild(new_content, current_content);
		// add new url to the browser address bar
		window.history.pushState({}, '', data_link);
		// redo some functions
		window.parent.themePagination();
		window.parent.ShopStyles();
		window.parent.ShopFilterScrollTo();
	}).catch(function(error) {
		// There was an error
		console.warn('Something went wrong.', error);
	});
}