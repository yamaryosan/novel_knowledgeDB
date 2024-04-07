import autosizing from "../home_mode/textarea_autosizing";
import activateInput from "../home_mode/activate_input";
import activateTextarea from "../home_mode/activate_textarea";
import buttonRoute from "../home_mode/button_route";

autosizing('summary_input');
autosizing('detail_input');
activateInput('title_container');
// activateTextarea('summary_container');
// activateTextarea('detail_container');

const saveRoute = document.querySelector('.submit_form').dataset.saveRoute;
const submitRoute = document.querySelector('.submit_form').dataset.submitRoute;
buttonRoute('submit_form', 'save_btn', saveRoute, false);
buttonRoute('submit_form', 'submit_btn', submitRoute, true);
