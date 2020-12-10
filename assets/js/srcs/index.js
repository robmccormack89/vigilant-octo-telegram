// import uikit
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

// loads the Icon plugin
UIkit.use(Icons);

// The following line makes it finally work (i use this when i want to be able load uikit in the head rather than body)
window.UIkit = UIkit;