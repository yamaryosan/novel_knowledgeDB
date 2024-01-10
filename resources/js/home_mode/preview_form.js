import autosizing from "./textarea_autosizing";
import activateInput from "./activate_input";
import activateTextarea from "./activate_textarea";
import buttonRoute from "./button_route";

autosizing('summary_input');
autosizing('detail_input');
activateInput('title_container');
activateTextarea('summary_container');
activateTextarea('detail_container');

const backRoute = document.querySelector('.submit_form').dataset.backRoute;
const storeRoute = document.querySelector('.submit_form').dataset.storeRoute;
const updateRoute = document.querySelector('.submit_form').dataset.updateRoute;
buttonRoute('submit_form', 'back', backRoute, false);
buttonRoute('submit_form', 'submit', storeRoute, true);
buttonRoute('submit_form', 'update', updateRoute, true);
