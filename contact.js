// Contact Form
const feedbackElement = document.getElementById("feedback");
const submitButtonElement = document.getElementById("submit");
const nameInputElement = document.getElementById("name");
const emailInputElement = document.getElementById("email");
const phoneInputElement = document.getElementById("phone");
const queryInputElement = document.getElementById("query");

$("form").on("submit", (event) => {
  event.preventDefault();

  $.ajax({
    type: "post",
    url: "contact.php",
    data: $("form").serialize(),
    beforeSend: () => {
      submitButtonElement.disabled = true;
    },
    success: (response) => {
      const objResponse = JSON.parse(response);
      feedbackElement.innerText = objResponse.response;
      feedbackElement.hidden = false;

      if (objResponse.error) {
        submitButtonElement.disabled = false;
        return;
      }

      nameInputElement.value = "";
      emailInputElement.value = "";
      phoneInputElement.value = "";
      queryInputElement.value = "";
    },
  });
});
