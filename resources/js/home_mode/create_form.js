import autosizing from "./textarea_autosizing";
import activateInput from "./activate_input";
import activateTextarea from "./activate_textarea";
import buttonRoute from "./button_route";

autosizing('summary_input');
autosizing('detail_input');
activateInput('title_container');
activateTextarea('summary_container');
activateTextarea('detail_container');

const saveRoute = document.querySelector('.submit_form').dataset.saveRoute;
const submitRoute = document.querySelector('.submit_form').dataset.submitRoute;
buttonRoute('submit_form', 'temp_save_btn', saveRoute, false);
buttonRoute('submit_form', 'submit_btn', submitRoute, true);
