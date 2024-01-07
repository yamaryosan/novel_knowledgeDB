import buttonRoute from "../home_mode/button_route";

const saveRoute = document.querySelector('.submit_form').dataset.saveRoute;
const submitRoute = document.querySelector('.submit_form').dataset.submitRoute;
buttonRoute('submit_form', 'save_btn', saveRoute);
buttonRoute('submit_form', 'submit_btn', submitRoute);
