// the quickoad function, using fetch api
// function quickLoad(event) {
// 
//   var the_link_href = event.target.getAttribute("data-link");
//   document.querySelector('.content-container').classList.add('the-loader');
// 
//   // fetch request with the clicked llnk
//   fetch(the_link_href).then(function (response) {
// 
//     // The API call was successful!
//     return response.text();
// 
//   }).then(function (html) {
// 
//     // do stuff with the data/results
//     var parser = new DOMParser();
//     var doc_obj = parser.parseFromString(html, 'text/html');
//     var new_content = doc_obj.querySelector('.block-content_wrap');
//     var main_container = document.getElementById("MainContent");
//     var old_content = document.querySelector('.block-content_wrap');
//     main_container.replaceChild(new_content, old_content);
// 
//     // add new url to the browser address bar
//     window.history.pushState({}, '', the_link_href);
// 
//     // refire certain functions after quickload
//     jQuery(function($) {
//       // pagination
//       if ($(".uk-pagination").length) {
//         $('.archive-posts').infiniteScroll({
//           path: '.next',
//           append: '.item',
//           status: '.page-load-status',
//           hideNav: '.pagi',
//           history: false,
//         });
//       }
//     });
// 
//   }).catch(function (error) {
// 
//     // There was an error
//     console.warn('Something went wrong.', error);
// 
//   });
// }